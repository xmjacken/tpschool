/*
Navicat MySQL Data Transfer

Source Server         : local_mysql
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tpschool

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2016-12-16 14:49:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ey_course
-- ----------------------------
DROP TABLE IF EXISTS `ey_course`;
CREATE TABLE `ey_course` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ey_course
-- ----------------------------
INSERT INTO `ey_course` VALUES ('1', 'thinkphp5实例', '0', '0');
INSERT INTO `ey_course` VALUES ('2', 'angularjs实例', '0', '0');
INSERT INTO `ey_course` VALUES ('3', '思想品德', '2016', '1481859344');
INSERT INTO `ey_course` VALUES ('4', '体育', '2016', '1481861984');
INSERT INTO `ey_course` VALUES ('5', '美术', '2016', '1481863553');

-- ----------------------------
-- Table structure for ey_klass
-- ----------------------------
DROP TABLE IF EXISTS `ey_klass`;
CREATE TABLE `ey_klass` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '名称',
  `teacher_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '教师ID',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ey_klass
-- ----------------------------
INSERT INTO `ey_klass` VALUES ('1', '实验1班', '9', '0', '1466493790');
INSERT INTO `ey_klass` VALUES ('2', '实验2班', '2', '0', '0');
INSERT INTO `ey_klass` VALUES ('3', '实验3班', '1', '0', '0');
INSERT INTO `ey_klass` VALUES ('4', '实验4班', '2', '0', '0');

-- ----------------------------
-- Table structure for ey_klass_course
-- ----------------------------
DROP TABLE IF EXISTS `ey_klass_course`;
CREATE TABLE `ey_klass_course` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `klass_id` int(11) unsigned NOT NULL,
  `course_id` int(11) unsigned NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ey_klass_course
-- ----------------------------
INSERT INTO `ey_klass_course` VALUES ('2', '1', '2', '0', '0');
INSERT INTO `ey_klass_course` VALUES ('4', '2', '2', '0', '0');
INSERT INTO `ey_klass_course` VALUES ('6', '4', '2', '0', '0');
INSERT INTO `ey_klass_course` VALUES ('8', '6', '2', '0', '0');
INSERT INTO `ey_klass_course` VALUES ('9', '1', '3', '0', '0');
INSERT INTO `ey_klass_course` VALUES ('10', '2', '3', '0', '0');
INSERT INTO `ey_klass_course` VALUES ('11', '1', '4', '0', '0');
INSERT INTO `ey_klass_course` VALUES ('12', '2', '4', '0', '0');
INSERT INTO `ey_klass_course` VALUES ('13', '1', '3', '1481859344', '1481859344');
INSERT INTO `ey_klass_course` VALUES ('14', '3', '3', '1481859344', '1481859344');
INSERT INTO `ey_klass_course` VALUES ('15', '1', '4', '0', '0');
INSERT INTO `ey_klass_course` VALUES ('16', '2', '4', '0', '0');
INSERT INTO `ey_klass_course` VALUES ('17', '3', '4', '0', '0');
INSERT INTO `ey_klass_course` VALUES ('18', '4', '4', '0', '0');
INSERT INTO `ey_klass_course` VALUES ('19', '4', '5', '0', '0');

-- ----------------------------
-- Table structure for ey_student
-- ----------------------------
DROP TABLE IF EXISTS `ey_student`;
CREATE TABLE `ey_student` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '姓名',
  `num` varchar(40) NOT NULL DEFAULT '',
  `sex` tinyint(2) NOT NULL DEFAULT '0',
  `klass_id` int(11) NOT NULL DEFAULT '0',
  `email` varchar(40) NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ey_student
-- ----------------------------
INSERT INTO `ey_student` VALUES ('1', '徐琳杰', '111', '0', '1', 'xulinjie@yunzhiclub.com', '0', '0');
INSERT INTO `ey_student` VALUES ('2', '魏静云', '112', '1', '2', 'weijingyun@yunzhiclub.com', '0', '0');
INSERT INTO `ey_student` VALUES ('3', '刘茜', '113', '0', '2', 'liuxi@yunzhiclub.com', '0', '0');
INSERT INTO `ey_student` VALUES ('4', '李甜', '114', '1', '1', 'litian@yunzhiclub.com', '0', '0');
INSERT INTO `ey_student` VALUES ('5', '李翠彬', '115', '1', '3', 'licuibin@yunzhiclub.com', '0', '0');
INSERT INTO `ey_student` VALUES ('6', '孔瑞平', '116', '0', '4', 'kongruiping@yunzhiclub.com', '1970', '1481849255');
INSERT INTO `ey_student` VALUES ('7', '张学友', '117', '0', '3', 'xyzhang@163.com', '1970', '1481849268');

-- ----------------------------
-- Table structure for ey_teacher
-- ----------------------------
DROP TABLE IF EXISTS `ey_teacher`;
CREATE TABLE `ey_teacher` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT '' COMMENT '姓名',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0男，1女',
  `username` varchar(16) NOT NULL COMMENT '用户名',
  `email` varchar(30) DEFAULT '' COMMENT '邮箱',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `password` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ey_teacher
-- ----------------------------
INSERT INTO `ey_teacher` VALUES ('1', '张三abc', '1', 'zhangsan', 'zhangsan@eyoung.com', '123123', '1480063123', 'b968f5e8ea0ff6083a17c811f98208dd3f790ff8');
INSERT INTO `ey_teacher` VALUES ('2', '李四D', '1', 'lisi', 'lisi@ey.club', '123213', '1480043593', 'b968f5e8ea0ff6083a17c811f98208dd3f790ff8');
INSERT INTO `ey_teacher` VALUES ('3', '王五B', '0', 'wangwu', 'wangwu@ey.com', '1480037323', '1480043004', 'b968f5e8ea0ff6083a17c811f98208dd3f790ff8');
INSERT INTO `ey_teacher` VALUES ('4', '赵六C', '0', 'zhaoliu', 'zhaoliu@ey.com', '1480043631', '1480043691', 'b968f5e8ea0ff6083a17c811f98208dd3f790ff8');
INSERT INTO `ey_teacher` VALUES ('6', '陈八', '0', 'chenba', 'chenba@ey.com', '1480043857', '1480043857', 'b968f5e8ea0ff6083a17c811f98208dd3f790ff8');
INSERT INTO `ey_teacher` VALUES ('7', '小李', '1', 'xiaoli', 'xiaoli@eyoung.com', '1480044939', '1480065898', 'c461663e91bdd9faf28e492f917548ee8e67848c');
INSERT INTO `ey_teacher` VALUES ('10', '吴工', '0', 'wugong', 'wugong@ey.com', '1480065926', '1480065926', 'b968f5e8ea0ff6083a17c811f98208dd3f790ff8');
INSERT INTO `ey_teacher` VALUES ('11', '管理员', '0', 'admin', 'admin@eysoft.com', '1481849781', '1481850449', 'e275c6f1471834ddafaa0de4eb430a0400294396');
SET FOREIGN_KEY_CHECKS=1;
