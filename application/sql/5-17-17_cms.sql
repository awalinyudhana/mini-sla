# ************************************************************
# Sequel Pro SQL dump
# Version 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.11-debug)
# Database: cms
# Generation Time: 2017-05-17 11:42:01 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table boq
# ------------------------------------------------------------

DROP TABLE IF EXISTS `boq`;

CREATE TABLE `boq` (
  `boq_id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_add` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `purchase_order` varchar(16) DEFAULT NULL,
  `start_date_of_support` date DEFAULT NULL,
  `end_date_of_support` date DEFAULT NULL,
  `service_level_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`boq_id`),
  KEY `service_level_id` (`service_level_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `boq_ibfk_1` FOREIGN KEY (`service_level_id`) REFERENCES `service_level` (`service_level_id`) ON UPDATE CASCADE,
  CONSTRAINT `boq_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `boq` WRITE;
/*!40000 ALTER TABLE `boq` DISABLE KEYS */;

INSERT INTO `boq` (`boq_id`, `tanggal_add`, `purchase_order`, `start_date_of_support`, `end_date_of_support`, `service_level_id`, `customer_id`, `user_id`)
VALUES
	(11,'2017-05-16 12:20:07','12345','2017-05-16','2017-05-16',2,2,1);

/*!40000 ALTER TABLE `boq` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table boq_detail
# ------------------------------------------------------------

DROP TABLE IF EXISTS `boq_detail`;

CREATE TABLE `boq_detail` (
  `boq_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `boq_id` int(11) DEFAULT NULL,
  `perangkat_id` int(11) DEFAULT NULL,
  `serial_number` varchar(128) DEFAULT NULL,
  `deskripsi` text,
  PRIMARY KEY (`boq_detail_id`),
  KEY `boq_id` (`boq_id`),
  KEY `perangkat_id` (`perangkat_id`),
  CONSTRAINT `boq_detail_ibfk_2` FOREIGN KEY (`boq_id`) REFERENCES `boq` (`boq_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `boq_detail_ibfk_3` FOREIGN KEY (`perangkat_id`) REFERENCES `perangkat` (`perangkat_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `boq_detail` WRITE;
/*!40000 ALTER TABLE `boq_detail` DISABLE KEYS */;

INSERT INTO `boq_detail` (`boq_detail_id`, `boq_id`, `perangkat_id`, `serial_number`, `deskripsi`)
VALUES
	(15,11,8,'a','sasas'),
	(16,11,9,'121212','asass');

/*!40000 ALTER TABLE `boq_detail` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table customer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_customer` varchar(128) DEFAULT NULL,
  `alamat` text,
  `kota` varchar(64) DEFAULT NULL,
  `provinsi` varchar(64) DEFAULT NULL,
  `kode_pos` varchar(32) DEFAULT NULL,
  `pic` varchar(32) DEFAULT NULL,
  `kontak` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;

INSERT INTO `customer` (`customer_id`, `nama_customer`, `alamat`, `kota`, `provinsi`, `kode_pos`, `pic`, `kontak`, `email`)
VALUES
	(1,'PT Angkasa Pura','Jalan Kertosono 14','Magelang','Jawa Tengah','63976','Feni','08675368265','tech1@sys.com'),
	(2,'PT Paramite Inovasi Teknologi','Jalan Jombang 16','Malang','Jawa Timur','65115','I Putu Sudarma','081336661922','i.putu@gmail.com');

/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;

INSERT INTO `groups` (`id`, `name`, `description`)
VALUES
	(1,'admin','Administrator'),
	(3,'manager','Tehnikal Manager'),
	(4,'technical','Tehnikal Support'),
	(5,'sales','Sales'),
	(6,'bod','BoQ');

/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table login_attempts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table perangkat
# ------------------------------------------------------------

DROP TABLE IF EXISTS `perangkat`;

CREATE TABLE `perangkat` (
  `perangkat_id` int(11) NOT NULL AUTO_INCREMENT,
  `part_number` varchar(128) DEFAULT NULL,
  `brand` varchar(128) DEFAULT NULL,
  `nama_perangkat` varchar(255) DEFAULT NULL,
  `type` enum('Hardware','Software','License','Warranty') DEFAULT NULL,
  `status` enum('Active','End of Sales','End of Support') DEFAULT NULL,
  `hyperlink` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`perangkat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `perangkat` WRITE;
/*!40000 ALTER TABLE `perangkat` DISABLE KEYS */;

INSERT INTO `perangkat` (`perangkat_id`, `part_number`, `brand`, `nama_perangkat`, `type`, `status`, `hyperlink`)
VALUES
	(8,'CTS-SX10N-K9','Cisco','Cisco SX-10','Hardware','Active','http://www.facebook.com'),
	(9,'LIC-TP-11X-ROOM','Cisco','TP Room License','License','Active','http://www.facebook.com'),
	(10,'CTS-SX10N-K1','Cisco','Cisco SX-10','Hardware','Active','https://www.facebook.com');

/*!40000 ALTER TABLE `perangkat` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table service_level
# ------------------------------------------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `service_level` WRITE;
/*!40000 ALTER TABLE `service_level` DISABLE KEYS */;

INSERT INTO `service_level` (`service_level_id`, `service_level`, `mom`, `bom`, `doc`, `demo`, `installation`, `maintenance`, `support`, `sla`)
VALUES
	(2,'Ultimate','1.2','4','8','9','3','1','9',7),
	(3,'Golden','3.2','4.1','4','0.1','3','6','2',2),
	(4,'Silver','4','5','1','6','3','2','2',3);

/*!40000 ALTER TABLE `service_level` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ticket
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ticket`;

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_by` varchar(64) DEFAULT NULL,
  `boq_detail_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `judul` varchar(255) DEFAULT NULL,
  `request_by` varchar(255) DEFAULT NULL,
  `category` varchar(128) DEFAULT NULL,
  `document` text,
  `deskripsi` text,
  `close_status` enum('Open','Closed') DEFAULT 'Open',
  `close_date` date DEFAULT NULL,
  `approved_status` enum('Waiting','Approved') DEFAULT 'Waiting',
  `approved_date` date DEFAULT NULL,
  `report_attachment` text,
  `note` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ticket_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;

INSERT INTO `ticket` (`ticket_id`, `ticket_by`, `boq_detail_id`, `customer_id`, `user_id`, `tanggal`, `judul`, `request_by`, `category`, `document`, `deskripsi`, `close_status`, `close_date`, `approved_status`, `approved_date`, `report_attachment`, `note`)
VALUES
	(5,'by_device',8,2,1,'2017-02-15 16:50:26','Testting','Awalin','Maintenance',NULL,'asas\r\nas','Open',NULL,'Waiting',NULL,NULL,NULL),
	(6,'by_device',9,2,1,'2017-02-15 16:52:47','Testing','Awalin','Installation','Screen_Shot_2017-02-15_at_08_47_36.png','Testing','Closed','2017-05-16','Waiting',NULL,NULL,NULL),
	(7,'by_customer',NULL,2,1,'2017-02-15 00:00:00','Document Ticket','Awalin','Doc','Screen_Shot_2017-01-23_at_00_27_28.png','Testing','Open',NULL,'Waiting',NULL,NULL,NULL);

/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ticket_response
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ticket_response`;

CREATE TABLE `ticket_response` (
  `ticket_response_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `progress` text,
  `result` text,
  `description` text,
  `user_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`ticket_response_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `ticket_response_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `ticket_response` WRITE;
/*!40000 ALTER TABLE `ticket_response` DISABLE KEYS */;

INSERT INTO `ticket_response` (`ticket_response_id`, `ticket_id`, `tanggal`, `progress`, `result`, `description`, `user_id`)
VALUES
	(10,7,'2017-02-17 19:19:13','Testing','progress Testing','Deskripsi testing',1),
	(11,6,'2017-05-16 11:49:10','test','asas','gggggg',1),
	(12,5,'2017-05-16 11:50:02','test','asas','asas',1),
	(13,7,'2017-05-16 11:55:11','lal','aaaa','aaaaaaddd',1),
	(14,6,'2017-05-16 12:01:19','test','eeee','werewr',1);

/*!40000 ALTER TABLE `ticket_response` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table ticket_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ticket_users`;

CREATE TABLE `ticket_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) DEFAULT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `ticket_users_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`ticket_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticket_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `ticket_users` WRITE;
/*!40000 ALTER TABLE `ticket_users` DISABLE KEYS */;

INSERT INTO `ticket_users` (`id`, `ticket_id`, `user_id`)
VALUES
	(8,5,1),
	(9,5,3),
	(10,6,5),
	(11,7,5),
	(12,7,1),
	(13,7,3),
	(14,7,2),
	(15,5,2),
	(16,6,3);

/*!40000 ALTER TABLE `ticket_users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`)
VALUES
	(1,'127.0.0.1','123456','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','','admin@admin.com','',NULL,NULL,NULL,1268889823,1495021158,1,'Prucut',' Bondan Adiroso','ADMIN','0'),
	(2,'127.0.0.1','123451','$2y$08$zjR6mNm9nPLqnD0sXJImC.BcHedkyoQt0BWCI4hflJG0/lRd5y3CG',NULL,'otoy.destroyed@gmail.com',NULL,NULL,NULL,NULL,1486970891,1494911186,1,'Awalin','Yudhana',NULL,NULL),
	(3,'127.0.0.1','123452','$2y$08$4vT.ArROFUdiX/81yMK3M.PpJNOUT80wYDEfc14VtnsF5QcFJgh8q',NULL,'lordhasyim@gmail.com',NULL,NULL,NULL,NULL,1486970936,NULL,1,'Ahmad','Hasyim',NULL,NULL),
	(4,'127.0.0.1','123453','$2y$08$TXj69RNYjcYFU67g8rObHecqqHl2cFjXI4nS792Yf8/ASDdWjcY/S',NULL,'kholiqur.risky@gmail.com',NULL,NULL,NULL,NULL,1486970986,NULL,1,'Kholiqur','Risky',NULL,NULL),
	(5,'127.0.0.1','123455','$2y$08$qzDKF/vuTyAzlv2vFkmzDejxWaxQwipryf9mY0iWFxcQY/6IEE2Gy',NULL,'tossy.radian@gmail.com',NULL,NULL,NULL,NULL,1487048766,NULL,1,'Tossy','Radian',NULL,NULL),
	(6,'127.0.0.1','123454','$2y$08$vTrB8p.17I/Assk02rCGyeJ7QDr5Js8GPU11WiZLRcFI4Ti4R8v6u',NULL,'riesma.hamdan@gmail.com',NULL,NULL,NULL,NULL,1487050804,NULL,1,'Risema','Hamdan',NULL,NULL),
	(7,'127.0.0.1','6661922','$2y$08$5tWcCoE9V1DFDYWyAt5nq./.kzEEu/5qMcmQ4.VnwLkQvJVHs2anW',NULL,'otoy.destroyed@gmail.com',NULL,NULL,NULL,NULL,1494914956,NULL,1,'Awalin','Yudhana',NULL,NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users_groups
# ------------------------------------------------------------

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`)
VALUES
	(35,1,1),
	(34,2,3),
	(42,3,6),
	(21,4,5),
	(30,5,4),
	(27,6,3),
	(41,7,1);

/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
