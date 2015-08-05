<?php

namespace Addons\UserList\Controller;
use Home\Controller\AddonsController;

class UserListController extends AddonsController{
	
	Public function _initialize() {
	
		$controller = strtolower (_ACTION);
		$res['title'] = '微信用户列表';
		$res['url'] = addons_url ('UserList://UserList/lists');
		$res['class'] = $controller == 'lists' ? 'current' : '';
		$nav[] = $res;


		$res['title'] = '相关配置';
		$res['url'] = addons_url ('UserList://UserList/config');
		$res['class'] = $controller == 'config' ? 'current' : '';
		$nav[] = $res;
	
		$this->assign('nav', $nav);
	}

        // 通用插件的列表方法
        public function lists() {

                $this->assign ( 'add_button', false );

                $model = $this->getModel('wx_userlist');
                parent::common_lists ( $model );
        }

        // 通用插件的删除模型
        public function del() {
                parent::common_del ( $this->getModel('wx_userlist') );
        }
	
	// 配置中心
	public function config() {
		$normal_tips = '此处填写相关提示信息。。。';
		$this->assign('normal_tips', $normal_tips);

		parent::config();
	}

	//用户绑定
	public function useradd() {
		$config = getAddonConfig('UserList');
		$this -> assign($config);
		
		$data['uid'] = $this -> mid;
		$user = M ('member')->where($data)->find();
				



        	$isWeixinBrowser = isWeixinBrowser ();

		if($isWeixinBrowser) {
			if(IS_POST){  //获取POST表单的数据
				$data['openid'] = get_openid();
				$data['c_name'] = I ('c_name');
				$data['phone'] = I ('phone');
				$data['p_name'] = I ('p_name');
				$data['classid'] = I ('classid');
				$data['relation'] = I ('relation');
			
				$prikey = I ('pri_key');
			
				$user_id = M ('reguserid')->where("pri_key='$prikey'")->getField('userid');
				if(!empty($user_id)){
					
					$re = M ('wx_userlist')->where("userid='$user_id' and status=2")->find();
					if(empty($re)) {
				
						$data['status'] = 2;
						$data['userid'] = $user_id;
				
						$result = M ('wx_userlist')->add($data);
						if($result) {
							$this->success('您已绑定成功！');
						}else {
							$this->error('未知错误，请稍后操作！');
						}
					}else{
						$this->error('该密钥已绑定用户！');
					}
				}else{
					$this->error('您输入的密钥不正确!',0);

				}
			}
		}else {
			$this->error('请使用微信访问！');
		}
		
		$this->display();
	}
}
