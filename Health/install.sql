CREATE TABLE IF NOT EXISTS `wp_headata` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
`userid`  varchar(50) NOT NULL  COMMENT '学生ID',
`c_name`  varchar(50) NOT NULL  COMMENT '学生姓名',
`cTime`  varchar(20) NOT NULL  COMMENT '时间',
`hdata`  text NOT NULL  COMMENT '健康数据',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci CHECKSUM=0 ROW_FORMAT=DYNAMIC DELAY_KEY_WRITE=0;
INSERT INTO `wp_headata` (`id`,`userid`,`c_name`,`cTime`,`hdata`) VALUES ('3','123456','需求','2015-08-03 12:08:45','跑步：1245M\r\n睡眠时间：8.8h\r\n测人而：122g');
INSERT INTO `wp_headata` (`id`,`userid`,`c_name`,`cTime`,`hdata`) VALUES ('2','123456','需求','2015-08-03 12:08:55','跑步：1345M\r\n睡眠：7.8h');
INSERT INTO `wp_model` (`name`,`title`,`extend`,`relation`,`need_pk`,`field_sort`,`field_group`,`attribute_list`,`template_list`,`template_add`,`template_edit`,`list_grid`,`list_row`,`search_key`,`search_list`,`create_time`,`update_time`,`status`,`engine_type`) VALUES ('headata','健康数据部分','0','','1','{"1":["userid","c_name","cTime","hdata"]}','1:基础','','','','','userid:学生ID\r\nc_name:学生姓名\r\nhdata:营养数据\r\ncTime:添加时间\r\nids:操作:[EDIT]|编辑,[DELETE]|删除','10','','','1438562953','1438563562','1','MyISAM');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('userid','学生ID','varchar(50) NOT NULL','string','','','1','','0','0','1','1438563035','1438563035','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('c_name','学生姓名','varchar(50) NOT NULL','string','','','1','','0','0','1','1438563203','1438563203','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('cTime','时间','varchar(20) NOT NULL','string','','','4','','0','0','1','1438563653','1438563258','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('hdata','健康数据','text NOT NULL','textarea','','','1','','0','0','1','1438563316','1438563316','','3','','regex','','3','function');
UPDATE `wp_attribute` SET model_id= (SELECT MAX(id) FROM `wp_model`) WHERE model_id=0;