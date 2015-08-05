<?php
return array(
	'autoin'=>array(//配置在表单中的键名 ,这个会是config[random]
		'title'=>'是否开启Execl自动导入：',//表单的文字
		'type'=>'radio',		 //表单的类型：text、textarea、checkbox、radio、select等
		'options'=>array(		 //select 和radion、checkbox的子选项
			'1'=>'开启',		 //值=>文字
			'0'=>'关闭',
		),
		'value'=>'1'			 //表单的默认值
	),
	
	'shown'=>array(
		'title'=>'用户显示的数据数目：',
		'type'=>'select',
		'options'=>array(
			'1'=>'前1条',
			'3'=>'前3条',
			'7'=>'前7条'
		),
		'value'=>'3',
		'tip'=>'若每天录入，则对应获取前多少天的数据。'
	),
	
	'foodnums'=>array(
		'title'=>'Execl中的营养种类：',
		'type'=>'select',
		'options'=>array(
			'2'=>'选择2种',
			'3'=>'选择3种',
			'4'=>'选择4种',
			'5'=>'选择5种',
			'6'=>'选择6种',
			'7'=>'选择7种',
			'8'=>'选择8种',
			'9'=>'选择9种'
		),
		'value'=>'3',
		'tip'=>'指定营养种类数目，以防Execl导入出错！'
	),
	
	'foodnames'=>array(
		'title'=>'营养种类的名称和单位：',
		'type'=>'textarea',
		'value'=>'蛋白质\r\n维生素',
		'tip'=>'与上面数目一致，一行一种，填写格式参考上面红色提示！'
	),

	'finfos'=>array(
		'title'=>'底部相关显示的说明：',
		'type'=>'textarea',
		'value'=>'没有请留空！',
		'tip'=>'此内容将显示在微信前端页面底部显示'
	),

	'UploadURL'=>array(
		'title'=>'上传附件的路径：',
		'type'=>'text',
		'value'=>'/var/www/wp/Uploads/Execlfile',
		'tip'=>'填写绝对路径，请勿随意修改！'
	),
);		
