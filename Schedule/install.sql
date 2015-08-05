CREATE TABLE IF NOT EXISTS `wp_course_infos` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
`class`  varchar(20) NOT NULL  COMMENT '班级',
`lesson`  text NOT NULL  COMMENT '课程',
`week`  char(10) NOT NULL  COMMENT '星期',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci CHECKSUM=0 ROW_FORMAT=DYNAMIC DELAY_KEY_WRITE=0;
INSERT INTO `wp_course_infos` (`id`,`class`,`lesson`,`week`) VALUES ('1','abc123','第一节:音 乐\r\n第二节:语 文\r\n第三节:数 学','1');
INSERT INTO `wp_course_infos` (`id`,`class`,`lesson`,`week`) VALUES ('2','abc123','第一节:音 乐\r\n第二节:英 语\r\n第三节:高 数\r\n第四节:数 学','2');
INSERT INTO `wp_course_infos` (`id`,`class`,`lesson`,`week`) VALUES ('3','abc122','第一节:高 数\r\n第二节:政 治\r\n第三节:化 学','5');
INSERT INTO `wp_model` (`name`,`title`,`extend`,`relation`,`need_pk`,`field_sort`,`field_group`,`attribute_list`,`template_list`,`template_add`,`template_edit`,`list_grid`,`list_row`,`search_key`,`search_list`,`create_time`,`update_time`,`status`,`engine_type`) VALUES ('course_infos','课程信息表','0','','1','{"1":["class","lesson","week"]}','1:基础','','','','','week:星期\r\nclass:班级\r\nlesson:课程\r\nids:操作:[EDIT]|编辑,[DELETE]|删除','10','','','1438674096','1438676627','1','MyISAM');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('class','班级','varchar(20) NOT NULL','string','','','1','','0','1','1','1438676493','1438676350','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('lesson','课程','text NOT NULL','textarea','','','1','','0','1','1','1438676485','1438676420','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('week','星期','char(10) NOT NULL','radio','','','1','1:周一\r\n2:周二\r\n3:周三\r\n4:周四\r\n5:周五\r\n6:周六\r\n7:周日','0','1','1','1438676470','1438676470','','3','','regex','','3','function');
UPDATE `wp_attribute` SET model_id= (SELECT MAX(id) FROM `wp_model`) WHERE model_id=0;