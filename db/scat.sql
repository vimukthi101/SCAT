/*
SQLyog Ultimate v8.55 
MySQL - 5.5.5-10.1.8-MariaDB : Database - scat
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`scat` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `scat`;

/*Table structure for table `address` */

DROP TABLE IF EXISTS `address`;

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `address_no` varchar(10) NOT NULL,
  `address_lane` varchar(40) NOT NULL,
  `address_city` varchar(30) NOT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

/*Data for the table `address` */

/*Table structure for table `card` */

DROP TABLE IF EXISTS `card`;

CREATE TABLE `card` (
  `card_no` varchar(16) NOT NULL,
  `pin` int(4) NOT NULL,
  `station_station_code` varchar(10) DEFAULT NULL,
  `issued_to_commuter` int(1) DEFAULT '0',
  PRIMARY KEY (`card_no`),
  KEY `fk_card_station1_idx` (`station_station_code`),
  CONSTRAINT `fk_card_station1` FOREIGN KEY (`station_station_code`) REFERENCES `station` (`station_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `card` */

/*Table structure for table `card_reading` */

DROP TABLE IF EXISTS `card_reading`;

CREATE TABLE `card_reading` (
  `card_number` varchar(16) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `card_reading` */

/*Table structure for table `card_request` */

DROP TABLE IF EXISTS `card_request`;

CREATE TABLE `card_request` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `no_of_cards_requested` int(11) NOT NULL,
  `no_of_cards_sent` int(11) NOT NULL DEFAULT '0',
  `station_station_code` varchar(10) NOT NULL,
  `card_request_status_status_id` int(11) NOT NULL,
  `requested_date` datetime NOT NULL,
  `send_date` datetime DEFAULT '0000-00-00 00:00:00',
  `received_date` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`request_id`),
  KEY `fk_card_request_station1_idx` (`station_station_code`),
  KEY `fk_card_request_card_request_status1_idx` (`card_request_status_status_id`),
  CONSTRAINT `fk_card_request_card_request_status1` FOREIGN KEY (`card_request_status_status_id`) REFERENCES `card_request_status` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_card_request_station1` FOREIGN KEY (`station_station_code`) REFERENCES `station` (`station_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `card_request` */

/*Table structure for table `card_request_status` */

DROP TABLE IF EXISTS `card_request_status`;

CREATE TABLE `card_request_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_type` varchar(10) NOT NULL,
  PRIMARY KEY (`status_id`),
  UNIQUE KEY `status_type_UNIQUE` (`status_type`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `card_request_status` */

insert  into `card_request_status`(`status_id`,`status_type`) values (4,'received'),(3,'reject'),(1,'request'),(2,'send');

/*Table structure for table `commuter` */

DROP TABLE IF EXISTS `commuter`;

CREATE TABLE `commuter` (
  `nic` varchar(10) NOT NULL,
  `contact_no` varchar(10) DEFAULT NULL,
  `registered_date_time` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `credit` decimal(7,2) NOT NULL DEFAULT '0.00',
  `address_address_id` int(11) NOT NULL,
  `card_card_no` varchar(16) NOT NULL,
  `name_name_id` int(11) NOT NULL,
  `password` varchar(32) NOT NULL,
  `previous_password` varchar(32) DEFAULT NULL,
  `login_attempt` int(11) DEFAULT '0',
  PRIMARY KEY (`nic`),
  KEY `fk_commuter_address1_idx` (`address_address_id`),
  KEY `fk_commuter_card1_idx` (`card_card_no`),
  KEY `fk_commuter_name1_idx` (`name_name_id`),
  CONSTRAINT `fk_commuter_address1` FOREIGN KEY (`address_address_id`) REFERENCES `address` (`address_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_commuter_card1` FOREIGN KEY (`card_card_no`) REFERENCES `card` (`card_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_commuter_name1` FOREIGN KEY (`name_name_id`) REFERENCES `name` (`name_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `commuter` */

/*Table structure for table `commuter_regfee` */

DROP TABLE IF EXISTS `commuter_regfee`;

CREATE TABLE `commuter_regfee` (
  `regfee_id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_fee` decimal(9,2) NOT NULL,
  PRIMARY KEY (`regfee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `commuter_regfee` */

/*Table structure for table `employee` */

DROP TABLE IF EXISTS `employee`;

CREATE TABLE `employee` (
  `contact_no` varchar(10) DEFAULT NULL,
  `nic` varchar(10) NOT NULL,
  `address_id` int(11) NOT NULL,
  `name_id` int(11) NOT NULL,
  `password` varchar(32) NOT NULL,
  `previous_password` varchar(32) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `login_attempt` int(11) NOT NULL DEFAULT '0',
  `internal` int(11) NOT NULL DEFAULT '0',
  `employee_email` varchar(100) NOT NULL,
  PRIMARY KEY (`nic`),
  UNIQUE KEY `nic_UNIQUE` (`nic`),
  KEY `fk_employee_address1_idx` (`address_id`),
  KEY `fk_employee_name1_idx` (`name_id`),
  CONSTRAINT `fk_employee_address1` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_name1` FOREIGN KEY (`name_id`) REFERENCES `name` (`name_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `employee` */

/*Table structure for table `employee_position` */

DROP TABLE IF EXISTS `employee_position`;

CREATE TABLE `employee_position` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(20) NOT NULL,
  PRIMARY KEY (`position_id`),
  UNIQUE KEY `position_UNIQUE` (`position`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `employee_position` */

insert  into `employee_position`(`position_id`,`position`) values (2,'manager'),(4,'registrar'),(3,'stationMaster'),(1,'sysadmin'),(6,'topupAgent'),(5,'updater');

/*Table structure for table `gps` */

DROP TABLE IF EXISTS `gps`;

CREATE TABLE `gps` (
  `train_train_id` int(11) NOT NULL,
  `time_stamp` datetime NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  PRIMARY KEY (`train_train_id`),
  KEY `fk_gps_train_idx` (`train_train_id`),
  CONSTRAINT `fk_gps_train` FOREIGN KEY (`train_train_id`) REFERENCES `train` (`train_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `gps` */

/*Table structure for table `name` */

DROP TABLE IF EXISTS `name`;

CREATE TABLE `name` (
  `name_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `second_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(20) NOT NULL,
  PRIMARY KEY (`name_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

/*Data for the table `name` */

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `payment_date_time` datetime NOT NULL,
  `no_of_tickets` int(11) NOT NULL,
  `commuter_nic` varchar(10) NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `ticket_id_idx` (`ticket_id`),
  KEY `fk_payment_commuter1_idx` (`commuter_nic`),
  CONSTRAINT `fk_payment_commuter1` FOREIGN KEY (`commuter_nic`) REFERENCES `commuter` (`nic`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ticket_id` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`ticket_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `payment` */

/*Table structure for table `payment_terminal` */

DROP TABLE IF EXISTS `payment_terminal`;

CREATE TABLE `payment_terminal` (
  `payment_terminal_id` int(11) NOT NULL AUTO_INCREMENT,
  `out_station_code` varchar(10) NOT NULL,
  `terminal_line` varchar(45) NOT NULL,
  `in_station_code` varchar(10) NOT NULL,
  PRIMARY KEY (`payment_terminal_id`),
  KEY `fk_payment_terminal_station1_idx` (`out_station_code`),
  KEY `fk_payment_terminal_station2_idx` (`in_station_code`),
  CONSTRAINT `fk_payment_terminal_station1` FOREIGN KEY (`out_station_code`) REFERENCES `station` (`station_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_payment_terminal_station2` FOREIGN KEY (`in_station_code`) REFERENCES `station` (`station_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

/*Data for the table `payment_terminal` */

/*Table structure for table `recharge` */

DROP TABLE IF EXISTS `recharge`;

CREATE TABLE `recharge` (
  `topup_id` int(11) NOT NULL AUTO_INCREMENT,
  `recharge_date_time` datetime NOT NULL,
  `amount` decimal(7,2) NOT NULL,
  `card_card_no` varchar(16) NOT NULL,
  `employee_nic` varchar(10) NOT NULL,
  `send_status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`topup_id`),
  KEY `fk_recharge_card1_idx` (`card_card_no`),
  KEY `fk_recharge_employee1_idx` (`employee_nic`),
  CONSTRAINT `fk_recharge_card1` FOREIGN KEY (`card_card_no`) REFERENCES `card` (`card_no`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_recharge_employee1` FOREIGN KEY (`employee_nic`) REFERENCES `employee` (`nic`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `recharge` */

/*Table structure for table `registrar_final_payment` */

DROP TABLE IF EXISTS `registrar_final_payment`;

CREATE TABLE `registrar_final_payment` (
  `payment_fee` decimal(7,2) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT '0',
  `payment_date` datetime NOT NULL,
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_nic` varchar(10) NOT NULL,
  `payment_received_by` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `fk_registrar_final_payment_employee_idx` (`employee_nic`),
  KEY `fk_registrar_final_payment_employee1_idx` (`payment_received_by`),
  CONSTRAINT `fk_registrar_final_payment_employee` FOREIGN KEY (`employee_nic`) REFERENCES `employee` (`nic`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_registrar_final_payment_employee1` FOREIGN KEY (`payment_received_by`) REFERENCES `employee` (`nic`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `registrar_final_payment` */

/*Table structure for table `registrar_payment` */

DROP TABLE IF EXISTS `registrar_payment`;

CREATE TABLE `registrar_payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_date_time` datetime NOT NULL,
  `commuter_nic` varchar(10) NOT NULL,
  `commuter_regfee_regfee_id` int(11) NOT NULL,
  `employee_nic` varchar(10) NOT NULL,
  `status` int(1) DEFAULT '0',
  PRIMARY KEY (`payment_id`),
  KEY `fk_registrar_payment_commuter1_idx` (`commuter_nic`),
  KEY `fk_registrar_payment_commuter_regfee2_idx` (`commuter_regfee_regfee_id`),
  KEY `fk_registrar_payment_employee1_idx` (`employee_nic`),
  CONSTRAINT `fk_registrar_payment_commuter1` FOREIGN KEY (`commuter_nic`) REFERENCES `commuter` (`nic`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_registrar_payment_commuter_regfee2` FOREIGN KEY (`commuter_regfee_regfee_id`) REFERENCES `commuter_regfee` (`regfee_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_registrar_payment_employee1` FOREIGN KEY (`employee_nic`) REFERENCES `employee` (`nic`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `registrar_payment` */

/*Table structure for table `staff` */

DROP TABLE IF EXISTS `staff`;

CREATE TABLE `staff` (
  `employee_id` varchar(10) NOT NULL,
  `employee_position_position_id` int(11) NOT NULL,
  `employee_nic` varchar(10) NOT NULL,
  `station_code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`employee_id`),
  KEY `fk_staff_employee_position1_idx` (`employee_position_position_id`),
  KEY `fk_staff_employee1_idx` (`employee_nic`),
  CONSTRAINT `fk_staff_employee1` FOREIGN KEY (`employee_nic`) REFERENCES `employee` (`nic`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_staff_employee_position1` FOREIGN KEY (`employee_position_position_id`) REFERENCES `employee_position` (`position_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `staff` */

/*Table structure for table `station` */

DROP TABLE IF EXISTS `station`;

CREATE TABLE `station` (
  `station_code` varchar(10) NOT NULL,
  `station_name` varchar(45) NOT NULL,
  `available_cards` int(11) NOT NULL,
  `employee_nic` varchar(10) NOT NULL,
  PRIMARY KEY (`station_code`),
  KEY `fk_station_employee1_idx` (`employee_nic`),
  CONSTRAINT `fk_station_employee1` FOREIGN KEY (`employee_nic`) REFERENCES `employee` (`nic`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `station` */

/*Table structure for table `ticket` */

DROP TABLE IF EXISTS `ticket`;

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_fee` decimal(6,2) NOT NULL,
  `station_in_station_code` varchar(10) NOT NULL,
  `station_out_station_code` varchar(10) NOT NULL,
  PRIMARY KEY (`ticket_id`),
  KEY `fk_ticket_station1_idx` (`station_in_station_code`),
  KEY `fk_ticket_station2_idx` (`station_out_station_code`),
  CONSTRAINT `fk_ticket_station1` FOREIGN KEY (`station_in_station_code`) REFERENCES `station` (`station_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticket_station2` FOREIGN KEY (`station_out_station_code`) REFERENCES `station` (`station_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `ticket` */

/*Table structure for table `timetable` */

DROP TABLE IF EXISTS `timetable`;

CREATE TABLE `timetable` (
  `timetable_id` int(11) NOT NULL AUTO_INCREMENT,
  `train_time` time NOT NULL,
  `train_train_id` int(11) NOT NULL,
  `employee_nic` varchar(10) NOT NULL,
  `station_station_code` varchar(10) NOT NULL,
  `line` varchar(50) NOT NULL,
  `train_date` varchar(10) NOT NULL,
  PRIMARY KEY (`timetable_id`),
  KEY `fk_timetable_train1_idx` (`train_train_id`),
  KEY `fk_timetable_employee1_idx` (`employee_nic`),
  KEY `fk_timetable_station1_idx` (`station_station_code`),
  CONSTRAINT `fk_timetable_employee1` FOREIGN KEY (`employee_nic`) REFERENCES `employee` (`nic`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_timetable_station1` FOREIGN KEY (`station_station_code`) REFERENCES `station` (`station_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_timetable_train1` FOREIGN KEY (`train_train_id`) REFERENCES `train` (`train_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `timetable` */

/*Table structure for table `topup_agent` */

DROP TABLE IF EXISTS `topup_agent`;

CREATE TABLE `topup_agent` (
  `agent_reg_date_time` datetime NOT NULL,
  `topup_agent_status_id` int(11) NOT NULL,
  `topup_agent_regfee_id` int(11) NOT NULL,
  `employee_nic` varchar(10) NOT NULL,
  `topup_agent_id` varchar(45) NOT NULL,
  `station_code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`topup_agent_id`),
  KEY `fk_topup_agent_topup_agent_status1_idx` (`topup_agent_status_id`),
  KEY `fk_topup_agent_topup_agent_regfee1_idx` (`topup_agent_regfee_id`),
  KEY `fk_topup_agent_employee1_idx` (`employee_nic`),
  CONSTRAINT `fk_topup_agent_employee1` FOREIGN KEY (`employee_nic`) REFERENCES `employee` (`nic`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_topup_agent_topup_agent_regfee1` FOREIGN KEY (`topup_agent_regfee_id`) REFERENCES `topup_agent_regfee` (`topup_agent_regfee_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_topup_agent_topup_agent_status1` FOREIGN KEY (`topup_agent_status_id`) REFERENCES `topup_agent_status` (`topup_agent_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `topup_agent` */

/*Table structure for table `topup_agent_payment` */

DROP TABLE IF EXISTS `topup_agent_payment`;

CREATE TABLE `topup_agent_payment` (
  `topup_agent_payment_fee` decimal(7,2) NOT NULL,
  `topup_agent_payment_status` int(11) NOT NULL,
  `employee_nic` varchar(10) NOT NULL,
  `topup_agent_payment_date` datetime NOT NULL,
  `topup_agent_payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_received_by` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`topup_agent_payment_id`),
  KEY `fk_topup_agent_payment_employee1_idx` (`employee_nic`),
  KEY `fk_topup_agent_payment_employee2_idx` (`payment_received_by`),
  CONSTRAINT `fk_topup_agent_payment_employee1` FOREIGN KEY (`employee_nic`) REFERENCES `employee` (`nic`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_topup_agent_payment_employee2` FOREIGN KEY (`payment_received_by`) REFERENCES `employee` (`nic`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `topup_agent_payment` */

/*Table structure for table `topup_agent_regfee` */

DROP TABLE IF EXISTS `topup_agent_regfee`;

CREATE TABLE `topup_agent_regfee` (
  `topup_agent_regfee_id` int(11) NOT NULL AUTO_INCREMENT,
  `topup_agent_regfee` decimal(7,2) NOT NULL,
  PRIMARY KEY (`topup_agent_regfee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `topup_agent_regfee` */

insert  into `topup_agent_regfee`(`topup_agent_regfee_id`,`topup_agent_regfee`) values (1,'10000.00'),(2,'20000.00'),(3,'30000.00'),(4,'40000.00'),(5,'50000.00'),(6,'60000.00'),(7,'70000.00'),(8,'80000.00'),(9,'90000.00');

/*Table structure for table `topup_agent_status` */

DROP TABLE IF EXISTS `topup_agent_status`;

CREATE TABLE `topup_agent_status` (
  `topup_agent_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `topup_agent_status` varchar(10) NOT NULL,
  PRIMARY KEY (`topup_agent_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `topup_agent_status` */

insert  into `topup_agent_status`(`topup_agent_status_id`,`topup_agent_status`) values (1,'registered'),(2,'active'),(3,'disabled');

/*Table structure for table `train` */

DROP TABLE IF EXISTS `train`;

CREATE TABLE `train` (
  `train_id` int(11) NOT NULL,
  `train_name` varchar(20) DEFAULT NULL,
  `train_type_type_id` varchar(10) NOT NULL,
  PRIMARY KEY (`train_id`),
  KEY `fk_train_train_type1_idx` (`train_type_type_id`),
  CONSTRAINT `fk_train_train_type1` FOREIGN KEY (`train_type_type_id`) REFERENCES `train_type` (`type_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `train` */

/*Table structure for table `train_type` */

DROP TABLE IF EXISTS `train_type`;

CREATE TABLE `train_type` (
  `type_id` varchar(10) NOT NULL,
  `type_name` varchar(10) NOT NULL,
  PRIMARY KEY (`type_id`),
  UNIQUE KEY `type_name_UNIQUE` (`type_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `train_type` */

insert  into `train_type`(`type_id`,`type_name`) values ('EXP','Express'),('INC','Intercity'),('SEMI','semi'),('SLOW','slow');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
