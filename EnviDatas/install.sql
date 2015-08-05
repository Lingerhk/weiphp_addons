CREATE TABLE IF NOT EXISTS `wp_environment` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
`title`  varchar(100) NOT NULL  COMMENT '标题',
`value`  varchar(50) NOT NULL  COMMENT '数据值',
`content`  text NOT NULL  COMMENT '正文说明',
`ctime`  varchar(50) NOT NULL  COMMENT '添加时间',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci CHECKSUM=0 ROW_FORMAT=DYNAMIC DELAY_KEY_WRITE=0;
INSERT INTO `wp_environment` (`id`,`title`,`value`,`content`,`ctime`) VALUES ('1','室内MP2.5','234','附加说明的设置，管理员可以根据具体的数据分析给合理的出行建议服务','2015-08-04 15:04:34');
INSERT INTO `wp_model` (`name`,`title`,`extend`,`relation`,`need_pk`,`field_sort`,`field_group`,`attribute_list`,`template_list`,`template_add`,`template_edit`,`list_grid`,`list_row`,`search_key`,`search_list`,`create_time`,`update_time`,`status`,`engine_type`) VALUES ('environment','环境数据','0','','1','{"1":["title","value","content","ctime"]}','1:基础','','','','','title:数据名称\r\nvalue:对应数值\r\ncontent:正文说明\r\nctime:添加时间\r\nids:操作:[EDIT]|编辑,[DELETE]|删除','10','','','1438671241','1438671780','1','MyISAM');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('title','标题','varchar(100) NOT NULL','string','','','1','','0','0','1','1438671313','1438671313','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('value','数据值','varchar(50) NOT NULL','string','','','1','','0','0','1','1438671347','1438671347','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('content','正文说明','text NOT NULL','textarea','','','1','','0','0','1','1438671406','1438671406','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('ctime','添加时间','varchar(50) NOT NULL','string','','','3','','0','0','1','1438673401','1438671487','','3','','regex','','3','function');
UPDATE `wp_attribute` SET model_id= (SELECT MAX(id) FROM `wp_model`) WHERE model_id=0;