# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.13-MariaDB)
# Database: lumen
# Generation Time: 2017-04-25 07:04:22 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table comment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comment`;

CREATE TABLE `comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `video_id` int(11) DEFAULT NULL COMMENT '视频Id',
  `user_id` int(11) DEFAULT NULL COMMENT '评论者Id',
  `content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '内容',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;

INSERT INTO `comment` (`id`, `video_id`, `user_id`, `content`, `create_time`)
VALUES
	(1,2,3,'我是最骚的','2017-02-19 00:00:00'),
	(2,2,3,'我骚猪是最骚的','2017-02-19 21:13:13'),
	(3,2,3,'test 最骚的','2017-02-19 21:21:32'),
	(4,2,4,'最骚的','2017-02-24 08:57:55');

/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table danmu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `danmu`;

CREATE TABLE `danmu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `video_id` int(11) DEFAULT NULL COMMENT '对应视频Id',
  `content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '内容',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `danmu` WRITE;
/*!40000 ALTER TABLE `danmu` DISABLE KEYS */;

INSERT INTO `danmu` (`id`, `video_id`, `content`, `create_time`, `update_time`)
VALUES
	(1,2,'{ \"text\":\"fucker\",\"color\":\"#ffffff\",\"size\":\"1\",\"position\":\"0\",\"time\":11}',NULL,NULL),
	(2,2,'{ \"text\":\"fucker\",\"color\":\"#ffffff\",\"size\":\"1\",\"position\":\"0\",\"time\":11}',NULL,NULL),
	(3,2,'{ \"text\":\"qq\",\"color\":\"#ffffff\",\"size\":\"10\",\"position\":\"0\",\"time\":20}','2017-02-19 14:23:33',NULL),
	(4,2,'{ \"text\":\"比较操蛋\",\"color\":\"#ffffff\",\"size\":\"10\",\"position\":\"0\",\"time\":99}','2017-02-19 16:43:31',NULL),
	(5,2,'{ \"text\":\"test\",\"color\":\"#ffffff\",\"size\":\"10\",\"position\":\"0\",\"time\":34}','2017-02-19 17:14:19',NULL),
	(6,2,'{ \"text\":\"ASDASD\",\"color\":\"#ffffff\",\"size\":\"10\",\"position\":\"0\",\"time\":3}','2017-02-23 10:17:43',NULL),
	(7,2,'{ \"text\":\"ADASD\",\"color\":\"#ffffff\",\"size\":\"10\",\"position\":\"0\",\"time\":3}','2017-02-23 10:17:48',NULL);

/*!40000 ALTER TABLE `danmu` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table dynamic
# ------------------------------------------------------------

DROP TABLE IF EXISTS `dynamic`;

CREATE TABLE `dynamic` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `info` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '信息',
  `img` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '图片',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table follow
# ------------------------------------------------------------

DROP TABLE IF EXISTS `follow`;

CREATE TABLE `follow` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `follow_id` int(11) DEFAULT NULL COMMENT '当前用户id,关注者的id',
  `be_followed_id` int(11) DEFAULT NULL COMMENT '视频主id,被关注者的id',
  `flag` tinyint(4) DEFAULT NULL COMMENT 'flag位置,防止取关or不取关',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `follow` WRITE;
/*!40000 ALTER TABLE `follow` DISABLE KEYS */;

INSERT INTO `follow` (`id`, `follow_id`, `be_followed_id`, `flag`, `create_time`, `update_time`)
VALUES
	(1,4,3,0,'2017-02-26 20:11:34','2017-02-26 20:27:05');

/*!40000 ALTER TABLE `follow` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '电子邮箱',
  `open_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT 'open_id',
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '密码',
  `nickname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '昵称',
  `introduce` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '一句话介绍',
  `photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户头像',
  `create_time` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `email`, `open_id`, `password`, `nickname`, `introduce`, `photo`, `create_time`, `update_time`)
VALUES
	(3,'941137860@qq.com','0','$2y$10$pbvIpaWDsC8A/qscvzgBfOpQTtnJaW0pSZNtqiX8I6qz1DwJyoOzm','gewenrui','make better life','113d4bb1a5235d5d0047aaae82076543.jpg',NULL,NULL),
	(4,'591978732@qq.com','0','$2y$10$tA47cxVMLGdkWZF32RO23urYfLHqqgfDuownUsqerI7mF2iG.kJ7e','挺操蛋','操蛋','0c55d2759df00d32bfcd12cb35642fe2.jpg','0000-00-00 00:00:00','0000-00-00 00:00:00');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table video
# ------------------------------------------------------------

DROP TABLE IF EXISTS `video`;

CREATE TABLE `video` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '视频Id',
  `user_id` int(11) DEFAULT NULL COMMENT '用户id',
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '视频名称',
  `video` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '视频路由',
  `content` text COLLATE utf8_unicode_ci COMMENT '视频简介',
  `picture` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '上传封面路由',
  `create_time` timestamp NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;

INSERT INTO `video` (`id`, `user_id`, `name`, `video`, `content`, `picture`, `create_time`, `update_time`)
VALUES
	(2,3,'视频','49cbd3526968a501e39f31a25e8c8d6a.mp4','视频','49cbd3526968a501e39f31a25e8c8d6a.jpg','2017-02-16 10:03:18',NULL),
	(3,4,'大电影哈哈哈哈','b8e8eff537cb79b91e7346e6a0d3ed86.mp4','大电影哈哈哈哈','b8e8eff537cb79b91e7346e6a0d3ed86.jpg','2017-02-24 09:04:23',NULL);

/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
