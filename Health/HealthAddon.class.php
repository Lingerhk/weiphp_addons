<?php

namespace Addons\Health;
use Common\Controller\Addon;

/**
 * 健康数据插件
 * @author s0nnet
 */

    class HealthAddon extends Addon{

        public $info = array(
            'name'=>'Health',
            'title'=>'健康数据',
            'description'=>'这是一个临时描述',
            'status'=>1,
            'author'=>'s0nnet',
            'version'=>'0.1',
            'has_adminlist'=>1,
            'type'=>1         
        );

	public function install() {
		$install_sql = './Addons/Health/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/Health/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }