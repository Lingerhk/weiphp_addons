<?php

namespace Addons\FoodInfos;
use Common\Controller\Addon;

/**
 * 营养数据插件
 * @author s0nnet
 */

    class FoodInfosAddon extends Addon{

        public $info = array(
            'name'=>'FoodInfos',
            'title'=>'营养数据',
            'description'=>'这是一个临时描述',
            'status'=>1,
            'author'=>'s0nnet',
            'version'=>'0.1',
            'has_adminlist'=>1,
            'type'=>1         
        );

	public function install() {
		$install_sql = './Addons/FoodInfos/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/FoodInfos/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }
