/*
SQLyog Ultimate v12.08 (64 bit)
MySQL - 5.7.26 : Database - rg_botongparking_com
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`rg_botongparking_com` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `rg_botongparking_com`;

/*Table structure for table `potong` */

DROP TABLE IF EXISTS `potong`;

CREATE TABLE `potong` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `openid` varchar(100) DEFAULT NULL,
  `imgurl` tinytext COMMENT '微信头像',
  `phone` varchar(100) DEFAULT NULL COMMENT '手机号',
  `password` varchar(100) DEFAULT NULL COMMENT '登录密码',
  `accesstoken` varchar(100) DEFAULT NULL COMMENT '登录态临时凭证',
  `addtime` varchar(100) DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `potong` */

insert  into `potong`(`id`,`openid`,`imgurl`,`phone`,`password`,`accesstoken`,`addtime`) values (1,'openid','imgurl','13227134860','123456','sadgasdg','addtime');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
