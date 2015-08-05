<?php

namespace Addons\EnviDatas;
use Common\Controller\Addon;

/**
 * 环境数据插件
 * @author s0nnet
 */

    class EnviDatasAddon extends Addon{

        public $info = array(
            'name'=>'EnviDatas',
            'title'=>'环境数据',
            'description'=>'此处可以录入相关环境数据',
            'status'=>1,
            'author'=>'s0nnet',
            'version'=>'0.1',
            'has_adminlist'=>1,
            'type'=>1         
        );

	public function install() {
		$install_sql = './Addons/EnviDatas/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/EnviDatas/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }