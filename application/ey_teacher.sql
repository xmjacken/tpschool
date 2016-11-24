/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100113
Source Host           : localhost:3306
Source Database       : tpschool

Target Server Type    : MYSQL
Target Server Version : 100113
File Encoding         : 65001

Date: 2016-11-24 09:15:55
*/

SET FOREIGN_KEY_CHECKS=0;

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ey_teacher
-- ----------------------------
INSERT INTO `ey_teacher` VALUES ('1', '张三', '0', 'zhangsan', 'zhangsan@mail.com', '123123', '123213');
INSERT INTO `ey_teacher` VALUES ('2', '李四', '0', 'lisi', 'lisi@ey.club', '123213', '1232');
SET FOREIGN_KEY_CHECKS=1;
