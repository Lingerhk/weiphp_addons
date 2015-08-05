<?php

namespace Addons\UserList;
use Common\Controller\Addon;

/**
 * 用户列表插件
 * @author s0nnet
 */

    class UserListAddon extends Addon{

        public $info = array(
            'name'=>'UserList',
            'title'=>'注册用户列表',
            'description'=>'这是一个临时描述',
            'status'=>1,
            'author'=>'s0nnet',
            'version'=>'0.1',
            'has_adminlist'=>1,
            'type'=>1         
        );

	public function install() {
		$install_sql = './Addons/UserList/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/UserList/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }
