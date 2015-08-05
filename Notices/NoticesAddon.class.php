<?php

namespace Addons\Notices;
use Common\Controller\Addon;

/**
 * 信息通知插件
 * @author s0nnet
 */

    class NoticesAddon extends Addon{

        public $info = array(
            'name'=>'Notices',
            'title'=>'信息通知',
            'description'=>'校方相关是信息通知',
            'status'=>1,
            'author'=>'s0nnet',
            'version'=>'0.1',
            'has_adminlist'=>1,
            'type'=>1         
        );

	public function install() {
		$install_sql = './Addons/Notices/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/Notices/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }
