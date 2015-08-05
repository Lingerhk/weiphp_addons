CREATE TABLE IF NOT EXISTS `wp_reguserid` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
`userid`  int(10) NOT NULL  DEFAULT 0 COMMENT '考勤号',
`p_phone`  varchar(100) NOT NULL  DEFAULT 0 COMMENT '家长手机号',
`pri_key`  varchar(20) NOT NULL  DEFAULT 0 COMMENT '密钥',
`ctime`  varchar(30) NOT NULL  COMMENT '添加时间',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci CHECKSUM=0 ROW_FORMAT=DYNAMIC DELAY_KEY_WRITE=0;
INSERT INTO `wp_reguserid` (`id`,`userid`,`p_phone`,`pri_key`,`ctime`) VALUES ('61','123456','18829292929','McEJEX','2015-08-02 15:10:04');
INSERT INTO `wp_reguserid` (`id`,`userid`,`p_phone`,`pri_key`,`ctime`) VALUES ('62','112233','18800008888','h1zOcs','2015-08-02 21:17:43');
INSERT INTO `wp_reguserid` (`id`,`userid`,`p_phone`,`pri_key`,`ctime`) VALUES ('63','222666','18829290957','tuA5D7','2015-08-05 10:25:43');
INSERT INTO `wp_model` (`name`,`title`,`extend`,`relation`,`need_pk`,`field_sort`,`field_group`,`attribute_list`,`template_list`,`template_add`,`template_edit`,`list_grid`,`list_row`,`search_key`,`search_list`,`create_time`,`update_time`,`status`,`engine_type`) VALUES ('reguserid','考勤ID卡编号','0','','1','{"1":["userid","p_phone","pri_key","ctime"]}','1:基础','','','','','userid:考勤卡编号\r\np_phone:家长手机号\r\npri_key:密钥\r\nctime:添加时间\r\nids:操作:[EDIT]|发短信,[DELETE]|删除','10','userid','','1437395184','1437524602','1','MyISAM');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('userid','考勤号','int(10) NOT NULL','num','0','','1','','0','0','1','1437395413','1437395413','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('p_phone','家长手机号','varchar(100) NOT NULL','string','0','','1','','0','0','1','1437399645','1437399645','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('pri_key','密钥','varchar(20) NOT NULL','string','0','','1','','0','1','1','1437399717','1437399717','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('ctime','添加时间','varchar(30) NOT NULL','string','','','1','','0','0','1','1437473050','1437472751','','3','','regex','','3','function');
UPDATE `wp_attribute` SET model_id= (SELECT MAX(id) FROM `wp_model`) WHERE model_id=0;