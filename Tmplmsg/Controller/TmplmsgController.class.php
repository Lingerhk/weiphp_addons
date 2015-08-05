<?php

namespace Addons\Tmplmsg\Controller;
use Home\Controller\AddonsController;

class TmplmsgController extends AddonsController{

	Public function _initialize() {
		
		$controller = strtolower ( _ACTION );
		
		$res ['title'] = '考勤信息表';
		$res ['url'] = addons_url ( 'Tmplmsg://Tmplmsg/lists' );
		$res ['class'] = $controller == 'lists' ? 'current' : '';
		$nav [] = $res;
		
		$res ['title'] = '手动推送接口';
		$res ['url'] = addons_url ( 'Tmplmsg://Tmplmsg/test' );
		$res ['class'] = $controller == 'test' ? 'current' : '';
		$nav [] = $res;
				
		$this->assign ( 'nav', $nav );
	}

	public function lists() {
	
		$this->assign ( 'add_button', false );
		$model = $this->getModel ();
		parent::common_lists ( $model );
	}
	

	// 后台手动推送测试	
	public function test() {
		if(IS_POST){
			$this->sendtempmsg(I('post.openid'), I('post.template_id'), I('post.url'), I('post.data'), $topcolor='#FF0000');
		}else{
			$this->display();
		}
	}

	//单点推送考勤消息.注意：该函数中token 已经写死！！！
	public function kq_msg() {

		if(IS_POST){
			
			$group = I('group');
			$userid = I('userid');
			$checktime = I('checktime');

			//由时间判断考勤状态: 到校、离校
			$todate = date('Y-m-d');
			$totime = "02:00:00";
			$starttime = $todate." ".$totime;
			$cctime = strtotime($starttime);

			$kq_count = M ('tmplmsg')->where("ctime>'$cctime'")->count();
			$kq_status = $kq_count%2 == 0 ? $kq_status="到校" : $kq_status="离校";

			//由userid查找openid
			$userinfo = M ('wx_userlist')->where("userid='$userid'")->find();
			if(!empty($userinfo)) {
				$c_name = $userinfo['c_name'];
				$p_name = $userinfo['p_name'];
				$openid = $userinfo['openid'];
				
				$template_id ='xxxxxxxxxxxxxxxxxxxxxxxxxx'; //模板消息的模板ID
                       	 	$topcolor = '#FF0000';
				$token_id = 'xxxxxxxxxxxx';

 	                      	$jsondata = '{ 
                                	"first":{"value":"'.$c_name.'小朋友已于'.$checktime.$kq_status.',请放心！"},
                                	"keyword1":{"value":"'.$c_name.'","color":"#173177"},
                                	"keyword2":{"value":"abc123"},
                                	"keyword3":{"value":"'.$checktime.'","color":"#173177"},
                               	 	"keyword4":{"value":"'.$kq_status.'","color":"#173177"}
                        	}';


				// "remark":{"value":"底部文体部分，已省去"}
			
				$json = $this->get_access_token();
			
				if (isset($json ['access_token'])){ 
					//print_r($json);	
					$xml = '{"touser":"'.$openid.'","template_id":"'.$template_id.'","topcolor":"'.$topcolor.'","data":'.$jsondata.'}';
                        		$res = $this->curlPost('https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$json['access_token'],$xml);
                        		$res = json_decode($res, true);
						
					if($res['errcode']==0){

						// 记录日志
                        			if ($res ['errcode'] == 0) {
                                			addWeixinLog ( $xml, 'post' );
                      		  		}
						$senddata = array(
                                			'openid' => $openid,
                                			'template_id' => $template_id,
                                			'message' => $jsondata,
							'MsgID' => $res['msgid'],
                                			'sendstatus' => $res['errcode']==0 ? 0 : 1,
							'Status' => $res['errcode']==0 ? 0 : 2,
                                			'token' => $token_id,
                                			'ctime' => $cctime,
                                			'group' => $group,
                                               		'c_name' => $c_name,
                                               		'p_name' => $p_name,
                                			'kq_status' => $kq_status
                        			);
                        			M ('tmplmsg')->add ( $senddata );
					}
              		  	}else{	
					echo "get access token error!";
				}
			}
		}else{
                        $this->display();
		}

		
	}
	
	//发送模板消息
	public function sendtempmsg($openid, $template_id, $url, $data, $topcolor='#FF0000') {
	
		$json = $this->get_access_token();
		if ($json ['errcode'] == 0) {
			$xml = '{"touser":"'.$openid.'","template_id":"'.$template_id.'","url":"'.$url.'","topcolor":"'.$topcolor.'","data":'.$data.'}';
			$res = $this->curlPost('https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$json['access_token'],$xml);
			$res = json_decode($res, true);
			// 记录日志
			if ($res ['errcode'] == 0) {
				addWeixinLog ( $xml, 'post' );
			}
			$senddata = array(
				'openid' => $openid,
				'template_id' => $template_id,
				'MsgID' => $res['msgid'],
				'message' => $data,
				'sendstatus' => $res['errcode']==0 ? 0 : 1,
				'token' => get_token(),
				'ctime' => time(),
				'group' => 'None',
				'c_name' => 'None',
				'p_name' => 'None',
				'kq_status' => '自定义'
			);
			M ('tmplmsg')->add ( $senddata );
			return $res;
		}else{
			return $json;
		}
		
	}
	
	//获取access_token
	public function get_access_token(){
	
		$map ['token'] = 'xxxxxxxxxxxxxxx';
		$info = M ( 'member_public' )->where ( $map )->find ();
		$url_get = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $info ['appid'] . '&secret=' . $info ['secret'];
		$data = json_decode($this->curlGet($url_get), true);
		
		//Debug 错误时微信会返回错误码(errcode)等信息
		return $data;
	}
	
	public function curlPost($url, $data){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		$errorno=curl_errno($ch);
		return $tmpInfo;
	}
	
    public function curlGet($url){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$temp = curl_exec($ch);
		return $temp;
	}
}
