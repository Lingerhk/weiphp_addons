CREATE TABLE IF NOT EXISTS `wp_fooddata` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
`userid`  varchar(50) NOT NULL  COMMENT '学生ID',
`c_name`  varchar(50) NOT NULL  COMMENT '学生姓名',
`cTime`  varchar(20) NOT NULL  COMMENT '时间',
`fdata`  text NOT NULL  COMMENT '营养数值',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci CHECKSUM=0 ROW_FORMAT=DYNAMIC DELAY_KEY_WRITE=0;
INSERT INTO `wp_fooddata` (`id`,`userid`,`c_name`,`cTime`,`fdata`) VALUES ('56','123456','放弃','2015-08-02 16:08:33','蛋白质：5432KD\r\n维生素：0.89μg\r\n的胡：703mg\r\n的胡阿：6523mg');
INSERT INTO `wp_fooddata` (`id`,`userid`,`c_name`,`cTime`,`fdata`) VALUES ('57','123456','放弃','2015-08-02 20:08:00','蛋白质：5432KD\r\n维生素B：0.89μg\r\n淀粉：703mg\r\n水分：6523mg');
INSERT INTO `wp_fooddata` (`id`,`userid`,`c_name`,`cTime`,`fdata`) VALUES ('55','123456','放弃','2015-07-30 22:07:12','蛋白质：2345KD\r\n维生素C：0.23μg\r\n维生素D：123mg\r\n淀粉：1345mg');
INSERT INTO `wp_fooddata` (`id`,`userid`,`c_name`,`cTime`,`fdata`) VALUES ('59','112233','留格','2015-08-02 21:08:09','蛋白质：2345KD\r\n维生素A：0.23μg\r\n维生素C：0.34μg');
INSERT INTO `wp_fooddata` (`id`,`userid`,`c_name`,`cTime`,`fdata`) VALUES ('60','123456','放弃','2015-08-03 11:08:25','蛋白质：2345KD\r\n维生素：0.23μg\r\n我恶搞：123ji');
INSERT INTO `wp_model` (`name`,`title`,`extend`,`relation`,`need_pk`,`field_sort`,`field_group`,`attribute_list`,`template_list`,`template_add`,`template_edit`,`list_grid`,`list_row`,`search_key`,`search_list`,`create_time`,`update_time`,`status`,`engine_type`) VALUES ('fooddata','营养数据部分','0','','1','{"1":["userid","c_name","fdata"]}','1:基础','','','','','userid:学生ID\r\nc_name:学生姓名\r\nfdata:营养数据\r\ncTime:添加时间\r\nids:操作:[EDIT]|编辑,[DELETE]|删除','10','','','1437911717','1438065050','1','MyISAM');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('userid','学生ID','varchar(50) NOT NULL','string','','','1','','0','0','1','1438563061','1437911864','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('c_name','学生姓名','varchar(50) NOT NULL','string','','','1','','0','0','1','1437911912','1437911912','','3','','regex','','3','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('cTime','时间','varchar(20) NOT NULL','string','','','4','','0','0','1','1438265465','1437912204','','3','','regex','','1','function');
INSERT INTO `wp_attribute` (`name`,`title`,`field`,`type`,`value`,`remark`,`is_show`,`extra`,`model_id`,`is_must`,`status`,`update_time`,`create_time`,`validate_rule`,`validate_time`,`error_info`,`validate_type`,`auto_rule`,`auto_time`,`auto_type`) VALUES ('fdata','营养数值','text NOT NULL','textarea','','','1','','0','0','1','1437919080','1437919080','','3','','regex','','3','function');
UPDATE `wp_attribute` SET model_id= (SELECT MAX(id) FROM `wp_model`) WHERE model_id=0;