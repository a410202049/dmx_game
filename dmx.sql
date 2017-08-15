/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50636
Source Host           : localhost:3306
Source Database       : dmx

Target Server Type    : MYSQL
Target Server Version : 50636
File Encoding         : 65001

Date: 2017-08-15 13:58:37
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
INSERT INTO `t_account` VALUES ('1', '11', '1', '1', '1', '1', '2017-08-02 10:54:10', '1210');

-- ----------------------------
-- Table structure for `t_dealer`
-- ----------------------------
DROP TABLE IF EXISTS `t_dealer`;
CREATE TABLE `t_dealer` (
  `id` varchar(20) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `type` int(11) NOT NULL,
  `pid` varchar(20) DEFAULT '0',
  `status` int(11) DEFAULT '1' COMMENT '状态',
  `diamond` int(11) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_dealer
-- ----------------------------
INSERT INTO `t_dealer` VALUES ('admin', 'f0c5e35537259eb3dd20e444f26d37bd', '0', '0', '1', '777', '2017-07-31 21:32:53');
INSERT INTO `t_dealer` VALUES ('test', 'f0c5e35537259eb3dd20e444f26d37bd', '1', 'admin', '1', '1567', '2017-08-02 18:15:16');
INSERT INTO `t_dealer` VALUES ('test1', '8d836359e6d10e53de195bd36639a42b', '1', 'test', '1', '999890', '2017-08-04 10:50:08');
INSERT INTO `t_dealer` VALUES ('hahh', '8d836359e6d10e53de195bd36639a42b', '1', 'test', '0', '0', '2017-08-15 11:08:38');
INSERT INTO `t_dealer` VALUES ('1111', '8d836359e6d10e53de195bd36639a42b', '1', 'admin', '1', '0', '2017-08-15 12:39:15');
INSERT INTO `t_dealer` VALUES ('111', '8d836359e6d10e53de195bd36639a42b', '1', 'test', '1', '0', '2017-08-15 13:49:23');

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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_proxy
-- ----------------------------
INSERT INTO `t_proxy` VALUES ('11', 'test', '222', 'admin', '2017-08-02 18:16:00');
INSERT INTO `t_proxy` VALUES ('12', 'test', '1', 'admin', '2017-08-02 18:16:46');
INSERT INTO `t_proxy` VALUES ('13', 'test', '111', 'admin', '2017-08-04 16:54:17');
INSERT INTO `t_proxy` VALUES ('14', 'test', '111', 'admin', '2017-08-04 16:54:36');
INSERT INTO `t_proxy` VALUES ('15', 'test', '999', 'admin', '2017-08-04 16:56:01');
INSERT INTO `t_proxy` VALUES ('16', 'test', '11', 'admin', '2017-08-04 17:05:34');
INSERT INTO `t_proxy` VALUES ('17', 'test', '111', 'admin', '2017-08-04 17:05:38');
INSERT INTO `t_proxy` VALUES ('18', 'test', '111', 'admin', '2017-08-04 17:05:42');

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
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_trade
-- ----------------------------
INSERT INTO `t_trade` VALUES ('26', '1', '10', 'test', '2017-08-04 16:52:42');
INSERT INTO `t_trade` VALUES ('27', '1', '100', 'test', '2017-08-04 16:53:31');
INSERT INTO `t_trade` VALUES ('28', '1', '100', 'admin', '2017-08-04 16:55:14');
INSERT INTO `t_trade` VALUES ('29', '1', '999', 'admin', '2017-08-04 16:57:45');
