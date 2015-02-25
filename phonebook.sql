/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50622
 Source Host           : localhost
 Source Database       : phonebook

 Target Server Type    : MySQL
 Target Server Version : 50622
 File Encoding         : utf-8

 Date: 02/25/2015 19:35:48 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `contacts`
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `notes` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`contact_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `contacts`
-- ----------------------------
BEGIN;
INSERT INTO `contacts` VALUES ('2', '1', 'Yanina Yushkevič', '+375291263903', 'My bride', '2015-02-25 14:35:12', null), ('3', '1', 'Baćka', '+375297566725', 'Father', '2015-02-25 14:36:19', null), ('4', '1', 'Alhierd Bacharevič', '+375297615203', 'My brother', '2015-02-25 14:36:58', null), ('5', '1', 'ByFly Support', '123', 'Support of my ISP', '2015-02-25 14:58:19', null), ('7', '1', 'Ilja Bacharevič', '+375297724728', 'My telephone number', '2015-02-25 15:14:04', '2015-02-25 15:14:13'), ('11', '1', 'Police office', '102', '', '2015-02-25 15:40:10', '2015-02-25 15:41:56'), ('12', '1', 'Fire Department', '101', 'Call in case of fire', '2015-02-25 15:41:09', null), ('13', '1', 'Ambulance', '103', null, '2015-02-25 15:41:26', null), ('14', '1', 'Vitaly Babkin', '+375 (29) 559-70-48', 'Friend', '2015-02-25 15:43:42', null), ('15', '1', 'Baričeūskaja Julija', '+375 (29) 251-66-95', 'Friend from University', '2015-02-25 15:44:12', null), ('16', '1', 'Alexander Bystry', '+375 (29) 614-95-84', 'Friend, web-design, HTML-coder', '2015-02-25 15:44:51', null), ('17', '1', 'Body Jazz', '+375 (17) 203-87-57', 'Beauty salon in Minsk', '2015-02-25 15:45:21', '2015-02-25 19:30:57'), ('24', '2', 'Test', 'test', 'tes', '2015-02-25 19:34:31', null);
COMMIT;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_surname` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Records of `users`
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES ('1', 'test@test.com', 'f4cdebb74fa6900535fa1f3bfe2d72fb', 'Ilya', 'Bakharevich', 'admin', '1', '2015-02-25 10:17:37'), ('2', 'ilya@bakharevich.by', 'f4cdebb74fa6900535fa1f3bfe2d72fb', 'Ilya', 'Bakharevich', 'user', '1', '2015-02-25 19:34:03');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
