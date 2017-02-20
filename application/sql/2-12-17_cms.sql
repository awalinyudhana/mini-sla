/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 10.1.10-MariaDB : Database - cms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `boq` */

DROP TABLE IF EXISTS `boq`;

CREATE TABLE `boq` (
  `boq_id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_add` date DEFAULT NULL,
  `start_date_of_support` date DEFAULT NULL,
  `end_date_of_support` date DEFAULT NULL,
  `service_level_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`boq_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `boq` */

insert  into `boq`(`boq_id`,`tanggal_add`,`start_date_of_support`,`end_date_of_support`,`service_level_id`,`customer_id`) values (1,'2017-02-09','2017-02-09','2017-02-11',3,1),(2,'2017-02-09','2017-02-09','2017-02-13',4,1);

/*Table structure for table `boq_detail` */

DROP TABLE IF EXISTS `boq_detail`;

CREATE TABLE `boq_detail` (
  `boq_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `boq_id` int(11) DEFAULT NULL,
  `perangkat_id` int(11) DEFAULT NULL,
  `serial_number` varchar(128) DEFAULT NULL,
  `deskripsi` text,
  PRIMARY KEY (`boq_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `boq_detail` */

insert  into `boq_detail`(`boq_detail_id`,`boq_id`,`perangkat_id`,`serial_number`,`deskripsi`) values (2,1,3,'Serial Oracle','Deskripsi Oracle'),(3,2,2,'Serial 1','Deskripsi 1'),(4,2,7,'Serial hardware','Deskripsi hardware');

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_customer` varchar(128) DEFAULT NULL,
  `alamat` text,
  `kota` varchar(64) DEFAULT NULL,
  `provinsi` varchar(64) DEFAULT NULL,
  `kode_pos` varchar(32) DEFAULT NULL,
  `pic` int(11) DEFAULT NULL,
  `kontak` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `customer` */

insert  into `customer`(`customer_id`,`nama_customer`,`alamat`,`kota`,`provinsi`,`kode_pos`,`pic`,`kontak`,`email`) values (1,'Feni Ayu','Jalan Kertosono 14','Magelang','Jawa Tengah','63976',1,'08675368265','tech1@sys.com');

/*Table structure for table `groups` */

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `groups` */

insert  into `groups`(`id`,`name`,`description`) values (1,'admin','Administrator'),(2,'members','General User');

/*Table structure for table `login_attempts` */

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `login_attempts` */

/*Table structure for table `perangkat` */

DROP TABLE IF EXISTS `perangkat`;

CREATE TABLE `perangkat` (
  `perangkat_id` int(11) NOT NULL AUTO_INCREMENT,
  `part_number` varchar(128) DEFAULT NULL,
  `brand` varchar(128) DEFAULT NULL,
  `nama_perangkat` varchar(255) DEFAULT NULL,
  `type` enum('Hardware','Software','License','Warranty') DEFAULT NULL,
  `status` enum('Active','End of Sales','End of Support') DEFAULT NULL,
  PRIMARY KEY (`perangkat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `perangkat` */

insert  into `perangkat`(`perangkat_id`,`part_number`,`brand`,`nama_perangkat`,`type`,`status`) values (1,'123Abc','Linksys','Router LS1','Hardware','Active'),(2,'68dgsj','Cisco','Switch C23','Hardware','Active'),(3,'8879hdfsak','Oracle','Oracle DB','Software','Active'),(7,'adsfasdf','sdfasdf','sadfsadfsadf','Hardware','End of Sales');

/*Table structure for table `service_level` */

DROP TABLE IF EXISTS `service_level`;

CREATE TABLE `service_level` (
  `service_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_level` varchar(64) DEFAULT NULL,
  `mom` varchar(255) DEFAULT NULL,
  `bom` varchar(255) DEFAULT NULL,
  `doc` varchar(255) DEFAULT NULL,
  `demo` varchar(255) DEFAULT NULL,
  `installation` varchar(255) DEFAULT NULL,
  `maintenance` varchar(255) DEFAULT NULL,
  `support` varchar(255) DEFAULT NULL,
  `sla` int(3) DEFAULT NULL,
  PRIMARY KEY (`service_level_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `service_level` */

insert  into `service_level`(`service_level_id`,`service_level`,`mom`,`bom`,`doc`,`demo`,`installation`,`maintenance`,`support`,`sla`) values (2,'Ultimate','qwerty','qwerty','qwerty','qwerty','qwerty','qwerty','qwerty',1),(3,'Golden','qwerty','qwerty','qwerty','qwerty','qwerty','qwerty','qwerty',2),(4,'Silver','qwerty','qwerty','qwerty','qwerty','qwerty','qwerty','qwerty',3);

/*Table structure for table `ticket` */

DROP TABLE IF EXISTS `ticket`;

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_by` varchar(64) DEFAULT NULL,
  `boq_detail_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `request_by` varchar(255) DEFAULT NULL,
  `category` varchar(128) DEFAULT NULL,
  `documents` text,
  `technician` varchar(64) DEFAULT NULL,
  `deskripsi` text,
  `close_status` enum('Open','Closed') DEFAULT 'Open',
  `close_date` date DEFAULT NULL,
  `approved_status` enum('Waiting','Approved') DEFAULT 'Waiting',
  `approved_date` date DEFAULT NULL,
  `report_attachment` text,
  PRIMARY KEY (`ticket_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ticket` */

insert  into `ticket`(`ticket_id`,`ticket_by`,`boq_detail_id`,`customer_id`,`tanggal`,`judul`,`request_by`,`category`,`documents`,`technician`,`deskripsi`,`close_status`,`close_date`,`approved_status`,`approved_date`,`report_attachment`) values (1,'by_device',4,1,'2017-02-10','Judulku','Requestku','Installation','276568b2a4f1f0200d9fa6947a400c35.png;707bc0962488bc76f860dc56176a49d9.png','lorem11;lorem22','fdgdsgfdsgdsfg','Closed','2017-02-12','Approved','2017-02-12','d6075a25e24ab018e5dfcf1539ed6bb0.jpg;bc7e41cd8699478073c457d22c05bb83.png'),(2,'by_customer',NULL,1,'2017-02-10','Judulku','Requestku','BoM','cbf6271ce2daa0e122da1c2ecf40f636.png','lorem12;lorem21','sadfsadfsdafsdafsdaf','Open',NULL,'Waiting',NULL,NULL);

/*Table structure for table `ticket_response` */

DROP TABLE IF EXISTS `ticket_response`;

CREATE TABLE `ticket_response` (
  `ticket_response_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `progress` text,
  `result` text,
  `description` text,
  `by` int(11) DEFAULT NULL,
  PRIMARY KEY (`ticket_response_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `ticket_response` */

insert  into `ticket_response`(`ticket_response_id`,`ticket_id`,`tanggal`,`progress`,`result`,`description`,`by`) values (1,1,'2017-02-10 00:00:00','Test','Test','Test',12),(2,1,'2017-02-10 22:00:53','Test 2','Test 2','Test',12),(3,1,'2017-02-12 11:18:23','Progress BoQ 2 #1','Resultku','Descriptionku',0),(4,1,'2017-02-12 11:20:27','Progress BoQ 2 #2','Resultku','Descriptionku',0),(5,1,'2017-02-12 11:57:04','Progress BoQ 2 #5','asdfasdfasd','afsdfsadfasd',0),(6,1,'2017-02-12 17:07:31','Progress BoQ 2 #81','sdafsadf','sadfsadfsdaf',0),(7,1,'2017-02-12 17:08:40','Progress BoQ 2 #54','sdfasdfsadf','sdfsadfsadf',0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`id`,`ip_address`,`username`,`password`,`salt`,`email`,`activation_code`,`forgotten_password_code`,`forgotten_password_time`,`remember_code`,`created_on`,`last_login`,`active`,`first_name`,`last_name`,`company`,`phone`) values (1,'127.0.0.1','administrator','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','','admin@admin.com','',NULL,NULL,NULL,1268889823,1486886592,1,'Prucut',' Bondan Adiroso','ADMIN','0');

/*Table structure for table `users_groups` */

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `users_groups` */

insert  into `users_groups`(`id`,`user_id`,`group_id`) values (1,1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
