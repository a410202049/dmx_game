/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50636
Source Host           : localhost:3306
Source Database       : dmx

Target Server Type    : MYSQL
Target Server Version : 50636
File Encoding         : 65001

Date: 2017-08-02 19:46:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `t_account`
-- ----------------------------
DROP TABLE IF EXISTS `t_account`;
CREATE TABLE `t_account` (
  `accid` varchar(50) NOT NULL,
  `nick_name` varchar(255) NOT NULL,
  `headimgurl` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `valid` int(11) NOT NULL DEFAULT '1',
  `account_type` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `diamond` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`accid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_account
-- ----------------------------
INSERT INTO `t_account` VALUES ('1', '11', '1', '1', '1', '1', '2017-08-02 10:54:10', '223');

-- ----------------------------
-- Table structure for `t_dealer`
-- ----------------------------
DROP TABLE IF EXISTS `t_dealer`;
CREATE TABLE `t_dealer` (
  `id` varchar(20) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `type` int(11) NOT NULL,
  `diamond` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_dealer
-- ----------------------------
INSERT INTO `t_dealer` VALUES ('admin', 'f0c5e35537259eb3dd20e444f26d37bd', '0', '777', '2017-07-31 21:32:53');
INSERT INTO `t_dealer` VALUES ('test', 'f0c5e35537259eb3dd20e444f26d37bd', '1', '223', '2017-08-02 18:15:16');

-- ----------------------------
-- Table structure for `t_proxy`
-- ----------------------------
DROP TABLE IF EXISTS `t_proxy`;
CREATE TABLE `t_proxy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proxy_id` varchar(20) NOT NULL,
  `diamond` int(11) NOT NULL,
  `dealer_id` varchar(20) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_proxy
-- ----------------------------
INSERT INTO `t_proxy` VALUES ('11', 'test', '222', 'admin', '2017-08-02 18:16:00');
INSERT INTO `t_proxy` VALUES ('12', 'test', '1', 'admin', '2017-08-02 18:16:46');

-- ----------------------------
-- Table structure for `t_trade`
-- ----------------------------
DROP TABLE IF EXISTS `t_trade`;
CREATE TABLE `t_trade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accid` varchar(20) NOT NULL,
  `diamond` int(11) NOT NULL,
  `dealer_id` varchar(20) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_trade
-- ----------------------------
INSERT INTO `t_trade` VALUES ('11', '1', '22', 'admin', '2017-08-01 13:44:59');
INSERT INTO `t_trade` VALUES ('12', '1', '22', 'admin', '2017-08-02 14:08:20');
INSERT INTO `t_trade` VALUES ('13', '1', '22', 'admin', '2017-08-02 14:12:02');
INSERT INTO `t_trade` VALUES ('14', '1', '11', 'admin', '2017-08-02 14:13:15');
INSERT INTO `t_trade` VALUES ('15', '1', '1', 'admin', '2017-08-02 14:13:20');
INSERT INTO `t_trade` VALUES ('16', '1', '12', 'admin', '2017-08-02 14:13:30');
INSERT INTO `t_trade` VALUES ('17', '1', '1', 'admin', '2017-08-02 14:13:38');
INSERT INTO `t_trade` VALUES ('18', '1', '12', 'admin', '2017-08-02 14:14:31');
INSERT INTO `t_trade` VALUES ('19', '1', '11', 'admin', '2017-08-02 14:29:16');
INSERT INTO `t_trade` VALUES ('20', '1', '12', 'admin', '2017-08-02 14:29:38');
INSERT INTO `t_trade` VALUES ('21', '1', '100', 'admin', '2017-08-02 14:29:49');
INSERT INTO `t_trade` VALUES ('22', '1', '100', 'admin', '2017-08-02 14:29:58');
