/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : dmx

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-08-17 22:38:52
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
INSERT INTO `t_account` VALUES ('1', '11', '1', '1', '1', '1', '2017-08-02 10:54:10', '3893');

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
  `leve` int(11) DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_dealer
-- ----------------------------
INSERT INTO `t_dealer` VALUES ('admin', 'f0c5e35537259eb3dd20e444f26d37bd', '0', '0', '1', '777', '0', '2017-07-31 21:32:53');
INSERT INTO `t_dealer` VALUES ('test', 'f0c5e35537259eb3dd20e444f26d37bd', '1', 'admin', '1', '1490', '10', '2017-08-02 18:15:16');
INSERT INTO `t_dealer` VALUES ('test1', '8d836359e6d10e53de195bd36639a42b', '1', 'test', '1', '1000023', '1', '2017-08-04 10:50:08');
INSERT INTO `t_dealer` VALUES ('hahh', '8d836359e6d10e53de195bd36639a42b', '1', 'test', '0', '0', '1', '2017-08-15 11:08:38');
INSERT INTO `t_dealer` VALUES ('1111', '8d836359e6d10e53de195bd36639a42b', '1', 'admin', '1', '0', '1', '2017-08-15 12:39:15');
INSERT INTO `t_dealer` VALUES ('111', '8d836359e6d10e53de195bd36639a42b', '1', 'test', '1', '0', '1', '2017-08-15 13:49:23');
INSERT INTO `t_dealer` VALUES ('q', '8d836359e6d10e53de195bd36639a42b', '0', 'test', '1', '0', '0', '2017-08-17 21:52:00');
INSERT INTO `t_dealer` VALUES ('w', '8d836359e6d10e53de195bd36639a42b', '0', 'test', '1', '0', '0', '2017-08-17 21:52:11');
INSERT INTO `t_dealer` VALUES ('e', '8d836359e6d10e53de195bd36639a42b', '0', 'test', '1', '0', '0', '2017-08-17 21:52:30');
INSERT INTO `t_dealer` VALUES ('r', '8d836359e6d10e53de195bd36639a42b', '0', 'test', '1', '0', '0', '2017-08-17 21:52:39');
INSERT INTO `t_dealer` VALUES ('t', '8d836359e6d10e53de195bd36639a42b', '0', 'test', '1', '0', '0', '2017-08-17 21:52:49');
INSERT INTO `t_dealer` VALUES ('y', '8d836359e6d10e53de195bd36639a42b', '1', 'test', '1', '0', '1', '2017-08-17 21:53:03');
INSERT INTO `t_dealer` VALUES ('u', '8d836359e6d10e53de195bd36639a42b', '0', 'test', '1', '0', '0', '2017-08-17 21:53:12');
INSERT INTO `t_dealer` VALUES ('i', '8d836359e6d10e53de195bd36639a42b', '1', 'test', '1', '0', '1', '2017-08-17 21:53:33');
INSERT INTO `t_dealer` VALUES ('p', '8d836359e6d10e53de195bd36639a42b', '0', 'test', '0', '0', '0', '2017-08-17 21:53:47');
INSERT INTO `t_dealer` VALUES ('a', '8d836359e6d10e53de195bd36639a42b', '1', 'test', '1', '0', '1', '2017-08-17 21:54:00');
INSERT INTO `t_dealer` VALUES ('s', '8d836359e6d10e53de195bd36639a42b', '1', 'test', '0', '0', '1', '2017-08-17 21:54:11');
INSERT INTO `t_dealer` VALUES ('1', '8d836359e6d10e53de195bd36639a42b', '1', 'test', '1', '0', '1', '2017-08-17 22:05:39');
INSERT INTO `t_dealer` VALUES ('123', '8d836359e6d10e53de195bd36639a42b', '1', 'test', '1', '0', '1', '2017-08-17 22:17:51');
INSERT INTO `t_dealer` VALUES ('333', '8d836359e6d10e53de195bd36639a42b', '1', 'test', '1', '0', '10', '2017-08-17 22:23:50');

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
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

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
INSERT INTO `t_proxy` VALUES ('19', 'test', '123', 'admin', '2017-08-17 20:55:55');
INSERT INTO `t_proxy` VALUES ('20', 'test1', '10', 'test', '2017-08-17 21:01:15');
INSERT INTO `t_proxy` VALUES ('21', 'test1', '13', 'test', '2017-08-17 21:01:34');
INSERT INTO `t_proxy` VALUES ('22', 'test1', '12', 'test', '2017-08-17 21:07:08');
INSERT INTO `t_proxy` VALUES ('23', 'test1', '88', 'test', '2017-08-17 21:15:31');
INSERT INTO `t_proxy` VALUES ('24', 'test1', '1', 'test', '2017-08-17 21:34:58');
INSERT INTO `t_proxy` VALUES ('25', 'test1', '1', 'test', '2017-08-17 21:35:05');
INSERT INTO `t_proxy` VALUES ('26', 'test1', '1', 'test', '2017-08-17 21:35:11');
INSERT INTO `t_proxy` VALUES ('27', 'test1', '1', 'test', '2017-08-17 21:35:17');
INSERT INTO `t_proxy` VALUES ('28', 'test1', '1', 'test', '2017-08-17 21:35:23');
INSERT INTO `t_proxy` VALUES ('29', 'test1', '1', 'test', '2017-08-17 21:35:29');
INSERT INTO `t_proxy` VALUES ('30', 'test1', '1', 'test', '2017-08-17 21:35:34');
INSERT INTO `t_proxy` VALUES ('31', 'test1', '1', 'test', '2017-08-17 21:35:40');
INSERT INTO `t_proxy` VALUES ('32', 'test1', '1', 'test', '2017-08-17 21:36:01');
INSERT INTO `t_proxy` VALUES ('33', 'test1', '1', 'test', '2017-08-17 21:36:06');

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
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_trade
-- ----------------------------
INSERT INTO `t_trade` VALUES ('26', '1', '10', 'test', '2017-08-04 16:52:42');
INSERT INTO `t_trade` VALUES ('27', '1', '100', 'test', '2017-08-04 16:53:31');
INSERT INTO `t_trade` VALUES ('28', '1', '100', 'admin', '2017-08-04 16:55:14');
INSERT INTO `t_trade` VALUES ('29', '1', '999', 'admin', '2017-08-04 16:57:45');
INSERT INTO `t_trade` VALUES ('30', '1', '111', 'admin', '2017-08-17 19:44:51');
INSERT INTO `t_trade` VALUES ('31', '1', '123', 'admin', '2017-08-17 19:45:26');
INSERT INTO `t_trade` VALUES ('32', '1', '123', 'admin', '2017-08-17 19:46:20');
INSERT INTO `t_trade` VALUES ('33', '1', '123', 'admin', '2017-08-17 19:46:32');
INSERT INTO `t_trade` VALUES ('34', '1', '123', 'admin', '2017-08-17 19:46:59');
INSERT INTO `t_trade` VALUES ('35', '1', '123', 'admin', '2017-08-17 19:47:37');
INSERT INTO `t_trade` VALUES ('36', '1', '67', 'test', '2017-08-17 19:49:10');
INSERT INTO `t_trade` VALUES ('37', '1', '1111', 'admin', '2017-08-17 20:11:30');
INSERT INTO `t_trade` VALUES ('38', '1', '111', 'admin', '2017-08-17 20:11:37');
INSERT INTO `t_trade` VALUES ('39', '1', '111', 'admin', '2017-08-17 20:11:47');
INSERT INTO `t_trade` VALUES ('40', '1', '212', 'admin', '2017-08-17 20:11:59');
INSERT INTO `t_trade` VALUES ('41', '1', '111', 'admin', '2017-08-17 20:18:26');
INSERT INTO `t_trade` VALUES ('42', '1', '123', 'admin', '2017-08-17 20:18:33');
INSERT INTO `t_trade` VALUES ('43', '1', '111', 'admin', '2017-08-17 20:18:42');
