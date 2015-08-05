<?php

namespace Addons\Notices\Controller;
use Home\Controller\AddonsController;

class NoticesController extends AddonsController{

	Public function _initialize() {

                $controller = strtolower (_ACTION);
                $res['title'] = '通知消息列表';
                $res['url'] = addons_url ('Notices://Notices/lists');
                $res['class'] = $controller == 'lists' ? 'current' : '';
                $nav[] = $res;

                $res['title'] = '添加通知消息';
                $res['url'] = addons_url ('Notices://Notices/add');
                $res['class'] = $controller == 'add' ? 'current' : '';
                $nav[] = $res;

                $res['title'] = '相关配置';
                $res['url'] = addons_url ('Notices://Notices/config');
                $res['class'] = $controller == 'config' ? 'current' : '';
                $nav[] = $res;

                $this->assign('nav', $nav);
        }

	// 通用插件的列表方法
        public function lists() {

                $normal_tips = '微信的家长须知模块：<br/>管理员将家长须知的信息录入数据库，待家长发出请求是返回给家长进行查看阅读。<br>';
                $this->assign ( 'normal_tips', $normal_tips );

                $model = $this->getModel('notemsg');
                parent::common_lists ( $model );
        }
	
	// 通用插件的添加方法
        public function add() {

		$normal_tips = '微信的家长须知功能模块的添加功能：<br/>管理员通过此模块将家长须知的信息信息录入数据库，其中包括：<br>1.“家长须知”的标题；<br/>2.“家长须知”的具体内容;<br/>3.特提醒或者对于此条信息的补充写入‘附加说明’中。<br>';
                $this->assign ( 'normal_tips', $normal_tips );
		
		if(IS_POST){
			$data['title']=I('title');
			$data['content']=I('content');
			$data['extra']=I('extra');			
	             	$data['ctime']= date('Y-m-d H:i:s');
			M('notemsg')->add($data);
			$this->success('添加成功，返回继续添加！');
		}else{
			$model = $this->getModel('notemsg');
			parent::common_add($model);
		}
        }
	
	// 通用插件的删除方法
        public function del() {
                $model = $this->getModel('notemsg');
                parent::common_del ( $model );
        }

        // 通用插件的编辑方法
        public function edit() {

                $model = $this->getModel('notemsg');
                parent::common_edit ( $model );
        }
	public function show(){

		$config = getAddonConfig('Notices');
		$isWeixinBrowser = isWeixinBrowser();
		if($isWeixinBrowser){
			if($config['power']){				
				$result = M ('notemsg')->select();
                		$this->assign('infolist',$result);
                		$this->display();
			}else{
				$this->error('抱歉，消息通知已关闭！');
			}
		}else{
	
			$this->error('请使用微信访问！');
		}	
			
	}
}
