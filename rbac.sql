/*
 Navicat Premium Data Transfer

 Source Server         : 本地mariadb
 Source Server Type    : MariaDB
 Source Server Version : 100130
 Source Host           : localhost:3306
 Source Schema         : rbac

 Target Server Type    : MariaDB
 Target Server Version : 100130
 File Encoding         : 65001

 Date: 21/03/2018 18:39:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for access
-- ----------------------------
DROP TABLE IF EXISTS `access`;
CREATE TABLE `access`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '' COMMENT '标题',
  `urls` varchar(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '' COMMENT '对应界面的url 用json存储',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 有效 0无效',
  `updated_time` timestamp(0) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后一次更新时间',
  `created_time` timestamp(0) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '权限表' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '' COMMENT '角色名称',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1表示有效 0表示无效',
  `updated_time` timestamp(0) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后一次更新时间',
  `created_time` timestamp(0) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '角色表' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for role_access
-- ----------------------------
DROP TABLE IF EXISTS `role_access`;
CREATE TABLE `role_access`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT 0 COMMENT '对应角色表中的id',
  `access_id` int(11) NOT NULL DEFAULT 0 COMMENT '对应权限表中的id',
  `updated_time` timestamp(0) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后一次更新时间',
  `created_time` timestamp(0) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '角色 权限关系表' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0' COMMENT '用户名',
  `email` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT '用户邮箱',
  `is_admin` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态1表示是管理员 0表示不是管理员',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态1表示是有效 0表示无效',
  `updated_time` timestamp(0) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后一次更新时间',
  `created_time` timestamp(0) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '用户表' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for user_role
-- ----------------------------
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT 0 COMMENT '对应user表的id字段',
  `role_id` int(11) NOT NULL DEFAULT 0 COMMENT '对应role表的id字段',
  `created_time` timestamp(0) NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '插入时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = '用户角色关系表' ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
