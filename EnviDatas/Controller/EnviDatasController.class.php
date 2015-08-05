<?php

namespace Addons\EnviDatas\Controller;
use Home\Controller\AddonsController;

class EnviDatasController extends AddonsController{

	Public function _initialize() {

                $controller = strtolower (_ACTION);
                $res['title'] = '环境数据列表';
                $res['url'] = addons_url ('EnviDatas://EnviDatas/lists');
                $res['class'] = $controller == 'lists' ? 'current' : '';
                $nav[] = $res;

                $res['title'] = '添加环境数据';
                $res['url'] = addons_url ('EnviDatas://EnviDatas/add');
                $res['class'] = $controller == 'add' ? 'current' : '';
                $nav[] = $res;

                $res['title'] = '相关配置';
                $res['url'] = addons_url ('EnviDatas://EnviDatas/config');
                $res['class'] = $controller == 'config' ? 'current' : '';
                $nav[] = $res;

                $this->assign('nav',$nav);
        }
        // 通用插件的列表方法
        public function lists() {

		$normal_tips = '微信的环境数据功能模块：<br>可以让管理员选择每次加入何种类型的环境数据。例如：温度,湿度，天气，PM2.5等
各种类型环境数据；<br>根据环境监控设备获取的数据填入具体的参数，向家长反映出孩子活动环境的具体信息。管理员可以根据具>体的数据分析给合理的出行建议.<br>';
                $this->assign ( 'normal_tips', $normal_tips );
		$model=$this->getModel('environment');

		parent::common_lists($model);
        }
	
	// 通用插件的添加方法
        public function add() {
		$normal_tips = '微信的环境数据功能模块：<br>可以让管理员选择每次加入何种类型的环境数据。例如：温度,湿度，天气，PM2.5等各种类型环境数据；<br>根据环境监控设备获取的数据填入具体的参数，向家长反映出孩子活动环境的具体信息。管理员可以根据具体的数据分析给合理的出行建议.<br>';
                $this->assign ( 'normal_tips', $normal_tips );

                $config = getAddonConfig('environment');
			
		if(IS_POST){
			$data['title']=I('title');
			$data['value']=I('value');
			$data['content']=I('content');
			$data['ctime']=date('Y-m-d H:i:s');
			M('environment')->add($data);
			$this->success('添加成功，返回继续添加！');
		}else{
			$model=$this->getModel('environment');
			parent::common_add($model);
		}
		
        }

        // 通用插件的删除方法
        public function del() {

                $model = $this->getModel('environment');
                parent::common_del ( $model );
        }

        // 通用插件的编辑方法
        public function edit() {

                $model = $this->getModel('environment');
                parent::common_edit ( $model );
        }

        // 通用插件的显示方法
        public function show() {
		$result = M('environment')->select();
                $this->assign('infolist',$result);
		$this->display();
        }
}
