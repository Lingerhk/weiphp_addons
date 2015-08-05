<?php
        	
namespace Addons\EnviDatas\Model;
use Home\Model\WeixinModel;
        	
/**
 * EnviDatas的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	function reply($dataArr, $keywordArr = array()) {
		$config = getAddonConfig ( 'EnviDatas' ); // 获取后台插件的配置参数
	
		$param['token']=get_token();
		$param['openid']=get_openid();
		$url=addons_url('EnviDatas://EnviDatas/show',$param);
		
		$articles[0]=array(
			'Title'=>'环境数据',
			'Description' => '欢迎关注德泰教育，请点击进去查看环境信息',
                        'PicUrl' => 'http://weiphp.cn/Public/Home/images/logo.jpg',
			'Url'=>$url
		);
		$res=$this->replyNews( $articles );

	} 

	// 关注公众号事件
	public function subscribe() {
		return true;
	}
	
	// 取消关注公众号事件
	public function unsubscribe() {
		return true;
	}
	
	// 扫描带参数二维码事件
	public function scan() {
		return true;
	}
	
	// 上报地理位置事件
	public function location() {
		return true;
	}
	
	// 自定义菜单事件
	public function click() {
		return true;
	}	
}
        	
