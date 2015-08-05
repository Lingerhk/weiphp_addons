<?php

namespace Addons\RegUid\Controller;
use Home\Controller\AddonsController;

class RegUidController extends AddonsController{

	Public function _initialize() {
		
		$controller = strtolower ( _ACTION );
		
		$res ['title'] = '考勤录入表';
		$res ['url'] = addons_url ( 'RegUid://RegUid/lists' );
		$res ['class'] = $controller == 'lists' ? 'current' : '';
		$nav [] = $res;
		
		$res ['title'] = '添加考勤ID卡';
		$res ['url'] = addons_url ( 'RegUid://RegUid/test' );
		$res ['class'] = $controller == 'test' ? 'current' : '';
		$nav [] = $res;
				
		$this->assign ( 'nav', $nav );
	}
	
	// 通用插件的列表方法
	public function lists() {
	
		$this->assign ( 'add_button', false );

		$model = $this->getModel('reguserid');
		parent::common_lists ( $model );
	}

        // 通用插件的删除模型
        public function del() {
                parent::common_del ( $this->getModel('reguserid') );
        }

	// 发短信模型
        public function edit() {
                $model = $this->getModel('reguserid');
                $id = I ( 'id' );
	        
		$list = M ('reguserid')->where ("id = $id")->field('p_phone,pri_key')->find();

		header('content-type:text/html;charset=utf-8');
		$sendUrl = 'http://v.juhe.cn/sms/send'; //短信接口的URL
 
		$smsConf = array(
    			'key' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
    			'mobile' => $list['p_phone'],
    			'tpl_id' => '4568',
    			'tpl_value' =>'#code#='.$list['pri_key']
		);

		$content = $this->curlGet($sendUrl,$smsConf); //请求发送短信
 
		if($content){
		        $result = json_decode($content,true);
    			$error_code = $result['error_code'];
    			if($error_code == 0){
        			$this->success("短信发送成功！");
			}else{
        			$msg = $result['reason'];
        			$this->error("短信发送失败(".$error_code.")：".$msg);
    			}
	        }else{
    			$this->error("请求发送短信失败");
		}
	}
	
	//发送HTTP的GET请求
	public function curlGet($url, $params=false){
    		$httpInfo = array();
    		$ch = curl_init();
 
    		curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
    		curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)' );
    		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
    		curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
    		curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        	curl_setopt( $ch , CURLOPT_POST , true );
        	curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
        	curl_setopt( $ch , CURLOPT_URL , $url );
    		$response = curl_exec( $ch );
    		if ($response === FALSE) {
        		return false;
    		}
    		$httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
    		$httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
    		curl_close( $ch );
    		return $response;
	}


	//添加考勤ID卡
	public function test() {
		if(IS_POST){
			$data['userid'] = I('post.userid');
			$data['p_phone'] = I('post.phone');

			if($data['userid']=='') { 
				$data['userid'] = 'None';
			}
			if($data['p_phone']=='') {
				$data['p_phone'] = 'None';
			}

			$data['pri_key'] = get_rand_char(); //默认随机生成6位字符
			$data['ctime'] = date('Y-m-d H:i:s'); 
			
			M ('reguserid')->add ($data);
			
			$this->success('添加成功，正返回继续添加！');
		}else{
			$this->display();
		}
	}	
}
