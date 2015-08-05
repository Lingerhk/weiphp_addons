<?php

namespace Addons\Schedule\Controller;
use Home\Controller\AddonsController;

class ScheduleController extends AddonsController{

	Public function _initialize() {

                $controller = strtolower (_ACTION);
                $res['title'] = '课程信息列表';
                $res['url'] = addons_url('Schedule://Schedule/lists');
                $res['class'] = $controller == 'lists' ? 'current' : '';
                $nav[] = $res;

                $res['title'] = '添加课程信息';
                $res['url'] = addons_url ('Schedule://Schedule/add');
                $res['class'] = $controller == 'add' ? 'current' : '';
                $nav[] = $res;

                $res['title'] = '相关配置';
                $res['url'] = addons_url ('Schedule://Schedule/config');
                $res['class'] = $controller == 'config' ? 'current' : '';
                $nav[] = $res;

                $this->assign('nav', $nav);
        }
        // 通用插件的列表方法
        public function lists() {

		 $normal_tips = '微信的环境数据功能模块：此模块用于管理员对园内的课程信息进行管理，包括课程信息的录入，修改和删除；<br/>录入课程信息时请注意：<br/>1.选择星期；2.填写星期；3.添加课程<br>示例:<br/>第一节:音乐(或者8:00~9:00:音乐)<br/>第二节:语文(或者9:00~10:00:语文)<br/>第三节:数学(或者10:00~11:00:数学)<br/>';
                $this->assign ( 'normal_tips', $normal_tips );	
		$model=$this->getModel('course_infos');
		parent::common_lists($model);
        }
	
	// 通用插件的添加方法
        public function add() {
		 $normal_tips = '微信的课程信息功能模块录入课程信息时请注意：<br/>1.选择星期；2.填写班级；3.添加课程<br>示例:<br/>第一节:音乐(或者8:00~9:00:音乐)<br/>第二节:语文(或者9:00~10:00:语文)<br/>第三节:数学(或者10:00~11:00:数学)<br/>';
                $this->assign ( 'normal_tips', $normal_tips );

                $config = getAddonConfig('Schedule');
	
		$model=$this->getModel('course_infos');
		parent::common_add($model);
        }

        // 通用插件的删除方法
        public function del() {
                $model = $this->getModel('course_infos');
                parent::common_del ( $model );
        }

        // 通用插件的编辑方法
        public function edit() {

                $model = $this->getModel('course_infos');
                parent::common_edit ( $model );
       }

        // 显示当天课程
        public function show() {
		//$config = getAddonConfig('Schedule');
		
		$isWeixinBrowser = isWeixinBrowser();
		if($isWeixinBrowser){
			$openid = get_openid();
			$classid = M('wx_userlist')->where("openid='$openid'")->getField('classid');
		
			if(!empty($classid)){
				$today = date("w");
				$re = M('course_infos')->where("class='$classid' and week='$today'")->select();
				if(!empty($re)){
					$course = $this->getlesson($re);
					//$this->assign('infos',$config['infos']);
					$this->assign('week', U('showweek'));
					$this->assign('all', U('showall'));
                                        $this->assign('lists',$course);
                                        $this->display();
				}else{
					$this->error('尚未录入相关班级或者星期的数据！');
				}
			}else{
				$this->showall();
			}
		}else{
			$this->error('请使用微信访问！');
		}
	}

	//显示本周课程
	public function showweek(){
		//$config = getAddonConfig('Schedule');

                $isWeixinBrowser = isWeixinBrowser();
                if($isWeixinBrowser){
                        $openid = get_openid();
                        $classid = M('wx_userlist')->where("openid='$openid'")->getField('classid');
			
                        if(!empty($classid)){
                                $re = M('course_infos')->where("class='$classid'")->order('week asc')->select();
                                if(!empty($re)){
                                        $course = $this->getlesson($re);
                                        //$this->assign('infos',$config['infos']);
                                        $this->assign('today', U('show'));
                                        $this->assign('all', U('showall'));
                                        $this->assign('lists',$course);
                                        $this->display();
                                }else{
                                        $this->error('目前尚未录入相关班级的数据！');
                                }
                        }else{
                                $this->showall();
                        }
                }else{
                        $this->error('请使用微信访问！');
                }
	}
	
	//显示全园课程
	public function showall(){
		//$config = getAddonConfig('Schedule');

                $isWeixinBrowser = 1;
                if($isWeixinBrowser){

			$re = M('course_infos')->order('class,week asc')->select();
			$course = $this->getlesson($re);
		
			//$this->assign('infos',$config['infos']);
                        $this->assign('lists',$course);
                        $this->display('showall');
	
                }else{
                        $this->error('请使用微信访问！');
         	}

	}
	
	//解析lesson字符串
	public function getlesson($re){
		for($i = 0; $i < count($re); $i ++){
                	$t = 0;
                	$list = array();
                        for($j = 0; $j < strlen($re[$i]['lesson']); $j ++){
                        	if($re[$i]['lesson']{$j} == "\r"){
                                	$n = substr($re[$i]['lesson'], $t, $j-$t);
                                        $t = $j + 1;
                                        array_push($list, $n);
                                }
                        }
                        $re[$i]['lesson'] = $list;
                }

		return $re;
	}
}
