CREATE TABLE IF NOT EXISTS `wp_notemsg` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
`title`  varchar(100) NOT NULL  COMMENT '消息标题',
`content`  text NOT NULL  COMMENT '消息内容',
`extra`  text NOT NULL  COMMENT '附加说明',
`ctime`  varchar(20) NOT NULL  COMMENT '添加时间',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci CHECKSUM=0 ROW_FORMAT=DYNAMIC DELAY_KEY_WRITE=0;
INSERT INTO `wp_notemsg` (`id`,`title`,`content`,`extra`,`ctime`) VALUES ('1','报名须知','功能已经很丰富了，可以口授邮件，也可以添加提醒，还能够查询天气和机票。在这里还能调出小冰，无聊的时候和小冰说说话也是个不错的选择。','美中不足的是只能用必应搜索，不能更改。','2015-08-03 21:30:15');
INSERT INTO `wp_notemsg` (`id`,`title`,`content`,`extra`,`ctime`) VALUES ('2','考勤通知','刚刚使用了一下，真的让我很不爽，连接断了四次，好不容易连上一个客服还把我晾在这里','下后面的情况，他们的回答速度平均在两分钟以上，而且他还要走了我的姓名','2015-08-03 21:55:13');
INSERT INTO `wp_model` (`name`,`title`,`extend`,`relation`,`need_pk`,`field_sort`,`field_group`,`attribute_list`,`template_list`,`template_add`,`template_edit`,`list_grid`,`list_row`,`search_key`,`search_list`,`create_time`,`update_time`,`status`,`engine_type`) VALUES ('notemsg','通知消息','0','','1','{"1":["title","content","extra"]}','1:基础','','','','','title:标题\r\ncontent:内容\r\nextra:附加说明\r\nctime:添加时间\r\nids:操作:[EDIT]|编辑,[DELETE]|删除','10','','','1438599484','1438608236','1','MyISAM');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('title','消息标题','varchar(100) NOT NULL','string','','','1','','0','0','1','1438608370','1438599555','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('content','消息内容','text NOT NULL','textarea','','','1','','0','0','1','1438608383','1438601522','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('extra','附加说明','text NOT NULL','textarea','','','1','','0','0','1','1438608132','1438601556','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('ctime','添加时间','varchar(20) NOT NULL','string','','','3','','0','0','1','1438601650','1438601650','','3','','regex','','3','function');
UPDATE `wp_attribute` SET model_id= (SELECT MAX(id) FROM `wp_model`) WHERE model_id=0;