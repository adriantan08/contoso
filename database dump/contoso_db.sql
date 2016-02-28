/*
SQLyog Community v10.3 Beta1
MySQL - 5.5.5-10.0.17-MariaDB : Database - contoso_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
USE `contoso_db`;

/*Table structure for table `auth_db` */

DROP TABLE IF EXISTS `auth_db`;

CREATE TABLE `auth_db` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(200) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `last_attempt_count` int(1) DEFAULT '0',
  `last_logged_in` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `auth_db` */

insert  into `auth_db`(`id`,`user`,`password`,`last_attempt_count`,`last_logged_in`) values (3,'test@email.com','FosHIFmJWmMcnMXlBNl4kKWdevuG/w1/pxVuGgzM0HtC42xoA97jjY+aJzToMLjB5CJO+zt8BgpMxPR/pkgLXw==',0,'2016-02-29 00:25:05');

/*Table structure for table `company_db` */

DROP TABLE IF EXISTS `company_db`;

CREATE TABLE `company_db` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `company_db` */

insert  into `company_db`(`id`,`company_name`) values (1,'Microsoft'),(12,'Google'),(13,'Facebook');

/*Table structure for table `company_employees_db` */

DROP TABLE IF EXISTS `company_employees_db`;

CREATE TABLE `company_employees_db` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  KEY `employee_id` (`employee_id`),
  CONSTRAINT `company_employees_db_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company_db` (`id`),
  CONSTRAINT `company_employees_db_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employees_db` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `company_employees_db` */

insert  into `company_employees_db`(`id`,`company_id`,`employee_id`) values (1,1,1),(3,12,9),(4,1,10);

/*Table structure for table `employees_db` */

DROP TABLE IF EXISTS `employees_db`;

CREATE TABLE `employees_db` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `employees_db` */

insert  into `employees_db`(`id`,`name`,`email`) values (1,'Steve','test@email.com'),(2,'Jobs','test2@email.com'),(3,'Adam Smith','adam@email.com'),(9,'Sundar Pichai','test1@email.com'),(10,'Stan ','stan@email.com');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
