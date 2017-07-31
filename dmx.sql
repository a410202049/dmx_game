/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : dmx

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-07-31 22:20:26
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
INSERT INTO `t_dealer` VALUES ('admin', 'f0c5e35537259eb3dd20e444f26d37bd', '0', '1000', '2017-07-31 21:32:53');

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_proxy
-- ----------------------------

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_trade
-- ----------------------------
