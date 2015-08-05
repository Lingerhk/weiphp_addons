<?php

namespace Addons\RegUid;
use Common\Controller\Addon;

/**
 * ID卡片注册插件
 * @author s0nnet
 */

    class RegUidAddon extends Addon{

        public $info = array(
            'name'=>'RegUid',
            'title'=>'ID卡片注册',
            'description'=>'管理源录入ID考勤编号',
            'status'=>1,
            'author'=>'s0nnet',
            'version'=>'0.1',
            'has_adminlist'=>1,
            'type'=>1         
        );

	public function install() {
		$install_sql = './Addons/RegUid/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/RegUid/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }
