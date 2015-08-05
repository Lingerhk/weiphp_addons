<?php

namespace Addons\Schedule;
use Common\Controller\Addon;

/**
 * 课业信息插件
 * @author s0nnet
 */

    class ScheduleAddon extends Addon{

        public $info = array(
            'name'=>'Schedule',
            'title'=>'课业信息',
            'description'=>'这里是相关的课业信息',
            'status'=>1,
            'author'=>'s0nnet',
            'version'=>'0.1',
            'has_adminlist'=>1,
            'type'=>1         
        );

	public function install() {
		$install_sql = './Addons/Schedule/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/Schedule/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }