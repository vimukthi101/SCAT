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
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;

/*Data for the table `address` */

insert  into `address`(`address_id`,`address_no`,`address_lane`,`address_city`) values (46,'3/15A','Gangarama Road','Piliyandala'),(53,'3/10','Pituwala','Elpitiya'),(54,'20','Rawatawatta','Moratuwa'),(55,'32','Kohuwala','Nugegoda'),(56,'2','Pepiliyana','Boralesgamuwa'),(57,'2','Kadawatha','Gampaha'),(58,'23','Jaela','Kadana'),(59,'20','Imbulgoda','Gampaha'),(60,'20','Imbulgoda','Gampaha'),(61,'3','Ihalabage','Rathnapura'),(62,'2','Ekala','Kadana'),(63,'56','Ekala','Katunayake'),(64,'5','Wadduwa','Kaluthara'),(65,'23','Meepe','Meemure'),(66,'53','Nuwara','Kandy'),(67,'45','Athurugiriya','Kottawa'),(68,'7','Athurugiriya','Kottawa'),(69,'56','Katubedda','Moratuwa'),(70,'5','Wadduwa','Kaluthara'),(71,'42','Darga','Aluthgama'),(72,'5','Street','Malabe'),(73,'53','Imbulgaha','Gampaha'),(74,'2','Thalahena','Kegalle'),(75,'2','Mullwriyawa','Angoda'),(76,'3','Matara','Galle'),(77,'3','Thandikulam','Jaffna'),(78,'6','Mahawa','Kandy'),(79,'5','Angulana','Moratuwa'),(80,'65','Panadure','Panadura'),(81,'32','Rawathawatta','Moratuwa'),(82,'5','Anuradhapura','Polonnaruwa'),(83,'5','Kadawatha','Nugegoda'),(84,'5','Gangarama','Colombo'),(85,'3','Wadduwa','Panadura'),(86,'6','Koswattha','Kaluthara'),(87,'5','Badulla','Kandy'),(88,'65','Trinco','Trincomalee'),(89,'32','Maradana','Colombo'),(90,'52','PAnadure','Panadura'),(91,'23','Airport','Rathmalana'),(92,'3','Willorawatta','Moratuwa'),(93,'5','Garambe','Polgahawela'),(94,'8','Thalawatugoda','Polgahawela'),(95,'8','Potuhera','Pothupitiya'),(96,'65','Neliya','Polgahawela'),(97,'56','Wewala','Piliyandala'),(98,'6','Wewala','Piliyandala'),(99,'53','Athurugiriya','Kottawa'),(100,'52','Seenigama','Galle'),(101,'23','Alawwa','Kandy'),(102,'5','Nagollagama','Mahawa'),(103,'52','Timbiriyagedara','Mahawa'),(104,'53','Kirulaone','Pamankada'),(105,'52','Meegoda','Yakkala'),(106,'88','Waga','Yakkala'),(107,'25','Panagoda','Yakkala'),(108,'5','Homagama','Kottawa'),(109,'52','Kollupitiya','Bambalapitiya'),(110,'5','Padukka','Kottawa'),(111,'23','Baseline','Colombo'),(112,'53','Meegahapura','Nugegoda'),(113,'5','Madu','Jaffna'),(114,'53','Mahwa','Anuradhapura'),(115,'59','Pinnaduwa','Elpitiya'),(116,'99','Keselwatta','Pinnawala'),(117,'56','Wewala','Gampaha'),(118,'77','Gadabuwana','Maharagama'),(119,'68','Mahara','Maharagama'),(120,'23','Mahabage','Ekala'),(121,'12','Padukka','Kottawa'),(122,'30','Waga','Alawwa'),(123,'3','Hokandara','Panagoda'),(124,'7','Pituwala','Elpitiya'),(125,'7','Alawwa','Kurunegalla'),(126,'4','Kesbewa','Piliyandala'),(127,'1','Mahabage','Kandy'),(128,'24','Maliban','Rathmalana'),(129,'74','Raddoluwa','Rathnapura'),(130,'2','Mahara','Maharagama'),(131,'24','Wattala','Colombo'),(132,'23','Ganegoda','Peliyagoda'),(133,'21','Kotalawalapura','Rathmalana'),(134,'4','NIlaweli','Hambanthota'),(135,'24','Kobeigane','Hambanthota'),(136,'73','Kanneliya','Galle'),(137,'24','Omanthai','Mankulam'),(138,'80','Bentota','Aluthgama'),(139,'23','Katana','Katunayake'),(140,'90','Dehiwala','MtLavinia'),(141,'30','Kantale','Giritale'),(142,'40','Nuwara','Kandy'),(143,'39','Koswattha','Kaluthara'),(144,'37','Budalgama','Koshinna'),(145,'80','Kudagampola','Gampola'),(146,'08','Madolduwa','Matara'),(147,'9','Bolawatte','Chilaw'),(148,'29','Puttalam','Noornagar'),(149,'38','Ulapane','Gampola'),(150,'28','Thummulla','Colombo'),(151,'30','Talawa','Anuradhapura'),(152,'15','Katuwawala','Boralesgamuwa'),(153,'03','Egodauyana','Moratuwa'),(154,'05','Makandana','Katuwawala'),(155,'09','Kotahena','Colombo'),(156,'38','Arauwala','Pannipitiya'),(157,'08','Delkanda','Pepiliyana'),(158,'92','Kotikawatta','Angoda'),(159,'06','Koshena','Katugastota'),(160,'06','Kiribathgoda','Colombo'),(161,'53','Pamankada','Kirulapone'),(162,'52','Pothupitiya','Panadura'),(163,'43','Fort','Colombo'),(164,'73','Katuwawala','Kottawa'),(165,'20','Kudagane','Kohuwala'),(166,'60','Kohuwala','Nugegoda'),(167,'41','Kohuwala','Dehiwala'),(168,'73','Madu','Matara'),(169,'4','Katubedda','Moratuwa'),(170,'42','Gunekatuwa','Hanguranketha'),(171,'94','Pinhenda','Alawwa'),(172,'48','Katugampola','Gampola'),(173,'73','Katubedda','Rathmalana'),(174,'82','Kurunegala','Kegalle'),(175,'4','Gangarama','Piliyandala'),(176,'4','Kohupitiya','Kottawa'),(177,'8','Kudaoya','Kahapola'),(178,'4','Ganemulla','Peliyagoda'),(179,'459','Katuwawala','Peliyagoda'),(180,'62/2','Balapitiya','Aluthgama'),(181,'5','Bentota','Aluthgama'),(182,'56/8','Lunawa','Moratuwa'),(183,'23/5','Ahungalla','Galle'),(184,'75/6','Balana','Beruwala'),(185,'13','Bahirawakanda','Balana'),(186,'35','Homagama','Peliyagoda'),(187,'18','Waga','Katugastota'),(188,'89','Morakele','Puwakpitiya'),(189,'5','Kochchikade','Colombo'),(190,'63','Chinabay','Trincomalee'),(191,'55/2A','Meegoda','Watareka'),(192,'59/3','Panagoda','Homagama'),(193,'23/5','Airport','Rathmalana'),(194,'35/9','Morakele','Waga'),(195,'29/3','Hettipola','Hettipola'),(196,'27','Galhena','Polonnaruwa'),(197,'53','Koggala','Matara'),(198,'70','Horawala','Negombo'),(199,'58','Pitiduwa','Koshena'),(200,'35/8','Punali','Ampara'),(201,'38','Vauniya','Mihintale'),(202,'2','Makandana','Ganegoda'),(203,'35/9','Lunawa','Moratuwa'),(204,'25/6','kaluthara','Kaluthara'),(205,'23/8','Bibila','Kandy'),(206,'23/4','Weerakatiya','Hambanthota'),(207,'2','Kudawella','Aluthgama'),(208,'2/4','Akuressa','Avissawella'),(209,'25/9','Bentota','Induruwa'),(210,'23','Valachchenai','Kalkuda'),(211,'5/2','Neriyakulam','Madu'),(212,'15/8','Mankulam','Marukandi'),(213,'23/7','Makandana','Hadigamuwa'),(214,'4','Induruwa','Mahainduruwa'),(215,'2','Piyangama','Ahungalle'),(216,'45/6','Balapitiya','Andadole'),(217,'48/2','Kandegoda','Ambalangoda'),(218,'25/9','Pinwatta','Wadduwa'),(219,'25/3','Katubedda','Moratuwa'),(220,'52/8','Puwakpitiya','Avissawella'),(221,'52/8','Godagama','Meegoda'),(222,'2','Padukka','Arukwatta'),(223,'25/78','Omanthai','Murukandi'),(224,'45/82','Payagala','Maggona'),(225,'23/85D','Wellawatte','Dehiwala'),(226,'25/85','Telawella','Seenigama'),(227,'2','Thalawatugoda','Meegoda'),(228,'25/8','Watareka','Arukwatta'),(229,'23/8','Thandikulam','Omanthai'),(230,'25/8','Kiribathgoda','Colombo'),(231,'25/8E','Badulla','Bandarawella'),(232,'10','Madapatha','Boralesgamuwa'),(233,'25','Balana','Dumbara'),(234,'25/4','Hikkaduwa','Galle'),(235,'25','Gurusingehpura','Malabe'),(236,'25','Kithulgala','Kegalle'),(237,'15/8','Malabe','Jaela'),(238,'52/9','Keerigama','Negombo'),(239,'41/5','Aluvihara','Matale'),(240,'5','Kankasanthurei','Jaffna'),(241,'25/8','Lunawa','Moratuwa'),(242,'20/8A','Koshinna','Girithale'),(243,'3/20','Imbulgoda','Gampaha'),(244,'3','Kohuwala','Nugegoda'),(245,'65','Athurugiriya','Kottawa'),(246,'3/15A','Wewala','Piliyandala');

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

insert  into `card`(`card_no`,`pin`,`station_station_code`,`issued_to_commuter`) values ('1234567890123455',5521,'FOT',1),('1234567890123456',9035,'FOT',0),('1234567890123457',2638,NULL,0);

/*Table structure for table `card_reading` */

DROP TABLE IF EXISTS `card_reading`;

CREATE TABLE `card_reading` (
  `card_number` varchar(16) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `card_reading` */

insert  into `card_reading`(`card_number`,`timestamp`,`status`,`id`) values ('1234567890123455','2017-03-26 00:23:03',1,18);

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `card_request` */

insert  into `card_request`(`request_id`,`no_of_cards_requested`,`no_of_cards_sent`,`station_station_code`,`card_request_status_status_id`,`requested_date`,`send_date`,`received_date`) values (13,2,2,'FOT',4,'2017-03-25 20:56:57','2017-03-25 20:57:25','2017-03-25 20:57:52');

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

insert  into `commuter`(`nic`,`contact_no`,`registered_date_time`,`status`,`credit`,`address_address_id`,`card_card_no`,`name_name_id`,`password`,`previous_password`,`login_attempt`) values ('931340034v','0711790372','2017-03-25 21:55:34',1,'30.00',246,'1234567890123455',246,'8a94ecfa54dcb88a2fa993bfa6388f9e','',1);

/*Table structure for table `commuter_regfee` */

DROP TABLE IF EXISTS `commuter_regfee`;

CREATE TABLE `commuter_regfee` (
  `regfee_id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_fee` decimal(9,2) NOT NULL,
  PRIMARY KEY (`regfee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `commuter_regfee` */

insert  into `commuter_regfee`(`regfee_id`,`reg_fee`) values (11,'100.00');

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

insert  into `employee`(`contact_no`,`nic`,`address_id`,`name_id`,`password`,`previous_password`,`status`,`login_attempt`,`internal`,`employee_email`) values ('','111111111v',129,129,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'sanjeewa@gmail.com'),('','123123456v',131,131,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'maneka@gmail.com'),('','123321123v',111,111,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nishadi@gmail.com'),('','123456789v',89,89,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'bryan@gmail.com'),('','159785234v',157,157,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'dineshH@gmail.com'),('','168203595v',156,156,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'ashan@gmail.com'),('','201345685v',98,98,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'amandi@gmail.com'),('','201789456v',99,99,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'kusuma@gmail.com'),('','203245698v',150,150,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'buddikaD@gmail.com'),('','232345456v',132,132,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'sahan@gmail.com'),('','235698741v',220,220,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'chamika@gmail.com'),('','258369412v',204,204,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'thushari@gmail.com'),('','258795486v',195,195,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'thisal@gmail.com'),('','258963147v',201,201,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'kanchana@gmail.com'),('','258974136v',219,219,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nipun@gmail.com'),('','269875813v',203,203,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nishka@gmail.com'),('','302750189v',140,140,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'thilinaG@gmail.com'),('','304506820v',143,143,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'kapugedara@gmail.com'),('','305721962v',161,161,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'naveen@gmail.com'),('','307539513v',144,144,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'kesara@gmail.com'),('','321025648v',90,90,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'saman@gmail.com'),('','321231236v',152,152,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'ruvindi@gmail.com'),('','321478521v',233,233,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'shamal@gmail.com'),('','323256985v',133,133,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'sinethra@gmail.com'),('','324785106v',221,221,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'udara@gmail.com'),('','325874106v',234,234,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'amith@gmail.com'),('','325978468v',173,173,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'gayani@gmail.com'),('','326894752v',208,208,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'mahinda@gmail.com'),('','329875698v',134,134,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'hambantota@gmail.com'),('','333333333v',128,128,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'chamod@gmail.com'),('','333666555v',182,182,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'jagath@gmail.com'),('','348619726v',136,136,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'kusald@gmail.com'),('','358967125v',206,206,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nithya@gmail.com'),('','359876125v',199,199,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nisha@gmail.com'),('','359876127v',200,200,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'dusha@gmail.com'),('','359876185v',198,198,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'irosh@gmail.com'),('','397531592v',149,149,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nishalka@gmail.com'),('','423056982v',88,88,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'murali@gmail.com'),('','444444444v',126,126,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'iroshima@gmail.com'),('','453126953v',57,57,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nihal@gmail.com'),('','456465789v',94,94,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'talawatugedara@yahoo.com'),('','456789258v',82,82,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'udayanag@gmail.com'),('','456789987v',91,91,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'gunapala@gmail.com'),('','458796320v',209,209,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'pasan@gmail.com'),('','485697236v',187,187,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'pasindu@gmail.com'),('','487521986v',224,224,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'melani@gmail.com'),('','505075362v',146,146,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'mudali@gmail.com'),('','548965558v',97,97,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'janidi@gmail.com'),('','554442229v',77,77,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'kayukaran@gmail.com'),('','555123789v',112,112,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'prabath@gmail.com'),('','555555555v',127,127,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'ravindu@gmail.com'),('','555666159v',104,104,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'maho@gmail.com'),('','555666852v',75,75,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'randula@gmail.com'),('','555666888v',84,84,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'kumuda@gmail.com'),('','555896482v',185,185,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'madhu@gmail.com'),('','556684238v',78,78,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'tiran@gmail.com'),('','569732591v',205,205,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'vishakan@gmail.com'),('','587963140v',228,228,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'naduni@gmail.com'),('','587963142v',215,215,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nethu@gmail.com'),('','587963214v',218,218,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'surangi@gmail.com'),('','587968426v',197,197,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'galagoda@gmail.com'),('','589762485v',196,196,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'thulada@gmail.com'),('','598670358v',192,192,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nadeesha@gmail.com'),('','598764823v',189,189,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'sakuni@gmail.com'),('0112608198','657891257v',54,54,'81dc9bdb52d04dc20036dbd8313ed055','95b431e51fc53692913da5263c214162',1,1,1,'scatsmcolombo@gmail.com'),('','666333222v',81,81,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'geeshan@gmail.com'),('','666555777v',64,64,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'thilina@gmail.com'),('','666666666v',125,125,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'damith@gmail.com'),('','698523456v',65,65,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'sameera@gmail.com'),('','703951083v',151,151,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'pinsara@gmail.com'),('','735940235v',165,165,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'samadhi@gmail.com'),('','736951283v',174,174,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nethushi@gmail.com'),('','745001236v',237,237,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'shanaka@gmail.com'),('','752000555v',105,105,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'baseline@gmail.com'),('','752014896v',222,222,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'peshala@gmail.com'),('','752103698v',230,230,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'jayanath@gmail.com'),('','753000684v',145,145,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nisansala@gmail.com'),('','753126840v',167,167,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'dimuth@gmail.com'),('','753126950v',166,166,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'iresh@gmail.com'),('','753147952v',229,229,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'dulaj@gmail.com'),('','753154784v',92,92,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'dushan@gmail.com'),('','753159286v',163,163,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'ravimali@gmail.com'),('','753159444v',83,83,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'oshardie@gmail.com'),('','753159777v',96,96,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'neliya@gmail.com'),('','753159786v',56,56,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'gihan@gmail.com'),('','753159826v',59,59,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'rajitha@gmail.com'),('','753159852v',232,232,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'adeera@gmail.com'),('','753202020v',86,86,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'sanath@yahoo.com'),('','753444444v',102,102,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nagollagama@gmail.com'),('','753666444v',79,79,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nisal@gmail.com'),('','753666995v',70,70,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'dulanga@gmail.com'),('','753698412v',241,241,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'shehan@gmail.com'),('','753698521v',61,61,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'aruni@gmail.com'),('','753698741v',120,120,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'helen@gmail.com'),('','753753753v',110,110,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'yuranu@gmail.com'),('','753753846v',139,139,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'aparna@gmail.com'),('','753888777v',121,121,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'ranga@gmail.com'),('','753945821v',168,168,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'dewaka@gmail.com'),('','753951842v',135,135,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nilaweli@gmail.com'),('','753961025v',153,153,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nehara@gmail.com'),('','753999885v',101,101,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'thushara@gmail.com'),('','755588894v',71,71,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nelisha@gmail.com'),('','756314852v',239,239,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'aravinda@gmail.com'),('','756982431v',171,171,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'niklesha@gmail.com'),('','756984238v',66,66,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'thisara@gmail.com'),('','756984423v',73,73,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'oshan@gmail.com'),('','757778963v',240,240,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'thiwanka@gmail.com'),('','758775269v',191,191,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'suraj@gmail.com'),('','758963250v',155,155,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'rojith@gmail.com'),('','759361582v',172,172,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'shaya@gmail.com'),('','759410236v',164,164,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'frank@gmail.com'),('','759612384v',207,207,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'maithree@gmail.com'),('','759681234v',178,178,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'hansaka@gmail.com'),('','759777666v',72,72,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'hansagee@yahoo.com'),('','759842630v',179,179,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'ariyarathna@gmail.com'),('','759846018v',180,180,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'balapitiya@gmail.com'),('','759846218v',106,106,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'indika@gmail.com'),('','759846235v',108,108,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'morawaka@gmail.com'),('','775566998v',67,67,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'kumar@yahoo.com'),('','777555623v',63,63,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'dinesh@gmail.com'),('','777666333v',85,85,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'kusal@gmail.com'),('','777777777v',122,122,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'thusara@gmail.com'),('','777888444v',130,130,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'kavindi@gmail.com'),('','777888569v',74,74,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'tharindu@gmail.com'),('','778889956v',76,76,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'gayan@yahoo.com'),('','778956725v',69,69,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'koshila@gmail.com'),('','779988552v',114,114,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'weerakatiya@gmail.com'),('','785210369v',225,225,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'akuressa@gmail.com'),('','785213694v',231,231,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'harshana@gmail.com'),('','785496325v',170,170,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'dilatara@gmail.com'),('','785632410v',238,238,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'dasun@gmail.com'),('','785694238v',186,186,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'shanilya@gmail.com'),('','785964128v',184,184,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'balna@gmail.com'),('','789123059v',142,142,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'mark@gmail.com'),('','789123506v',141,141,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'suranga@gmail.com'),('','789258436v',169,169,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'shehani@gmail.com'),('','789456888v',100,100,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'aruna@gmail.com'),('','789487562v',223,223,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'hasitha@gmail.com'),('','789520146v',227,227,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nadun@gmail.com'),('','789523614v',216,216,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'duminda@gmail.com'),('','789523681v',176,176,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'biyanka@gmail.com'),('','789526702v',177,177,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'sarani@gmail.com'),('','789528364v',158,158,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'chirath@gmail.com'),('','789528634v',175,175,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nicky@gmail.com'),('','789548632v',244,244,'51f15efdd170e6043fa02a74882f0470','',1,0,0,'topupagentcolombo@gmail.com'),('','789555666v',119,119,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'deshani@gmail.com'),('','789586214v',188,188,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'anuradha@gmail.com'),('','789587621v',213,213,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'lawan@gmail.com'),('','789587692v',202,202,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'janith@gmail.com'),('','789587962v',210,210,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'sayanthan@gmail.com'),('','789658234v',217,217,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'jagodage@gmail.com'),('','789785123v',211,211,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'vimalaharan@gmail.com'),('','789789780v',109,109,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'meerium@gmail.com'),('','789789789v',93,93,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'garambe@gmail.com'),('','789789987v',95,95,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'poyuphera@gmail.com'),('','789845623v',214,214,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'shanika@gmail.com'),('','789857682v',194,194,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'hashan@gmail.com'),('','789879521v',181,181,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'bentota@gmail.com'),('','789888562v',183,183,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'wijesiri@gmail.com'),('','789987456v',116,116,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'pinnawala@gmail.com'),('','793148625v',137,137,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'kanneliya@gmail.com'),('','794138426v',138,138,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'koe@gmail.com'),('0714495673','794384562v',53,53,'81dc9bdb52d04dc20036dbd8313ed055','b59c67bf196a4758191e42f76670ceba',1,0,1,'managerscatfortrains@gmail.com'),('','830145698v',160,160,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'deshika@gmail.com'),('','830156983v',159,159,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'indrachapa@gmail.com'),('','852036974v',235,235,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'amal@gmail.com'),('','852074136v',226,226,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'himantha@gmail.com'),('','853012459v',87,87,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'mahela@gmail.com'),('','853164259v',60,60,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'supun@gmail.com'),('','853697412v',245,245,'71f538c5db462f9bf1c7a8521c622c41','',1,0,1,'updatercolombo@gmail.com'),('','854103692v',242,242,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'chanuka@gmail.com'),('','857559643v',80,80,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'yasiru@gmail.com'),('','859784569v',193,193,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'tharaka@gmail.com'),('','863120548v',58,58,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'ranil@gmail.com'),('','874569320v',236,236,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'ananda@gmail.com'),('','879584632v',190,190,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'ruwangi@gmail.com'),('','888456123v',62,62,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'buddika@gmail.com'),('','888753159v',118,118,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nishad@gmail.com'),('','888888888v',123,123,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nimmi@gmail.com'),('','888999777v',103,103,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'timibiriyagedara@gmail.com'),('','889756825v',113,113,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'thandikulam@gmail.com'),('','889977489v',68,68,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'devinda@gmail.com'),('0112619927','894532167v',55,55,'81dc9bdb52d04dc20036dbd8313ed055','f1676935f9304b97d59b0738289d2e22',1,0,1,'scatsmbadulla@gmail.com'),('','894752361v',243,243,'a0833c8a1817526ac555f8d67727caf6','a0833c8a1817526ac555f8d67727caf6',1,0,1,'registrarcolombo@gmail.com'),('','895288630v',107,107,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'rangana@gmail.com'),('0711790372','931340034v',46,46,'81dc9bdb52d04dc20036dbd8313ed055','81dc9bdb52d04dc20036dbd8313ed055',1,0,1,'scatft@gmail.com'),('','934560235v',162,162,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'sanduni@gmail.com'),('','964567890v',148,148,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'shalini@gmail.com'),('','967531260v',147,147,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'samith@gmail.com'),('','987536402v',212,212,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'shalintha@gmail.com'),('','998875628v',115,115,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'pinnaduwa@gmail.com'),('','999253168v',154,154,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'wirantha@gmail.com'),('','999999475v',117,117,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'nugera@gmail.com'),('','999999999v',124,124,'81dc9bdb52d04dc20036dbd8313ed055','',1,0,1,'chanaka@gmail.com');

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
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;

/*Data for the table `name` */

insert  into `name`(`name_id`,`first_name`,`second_name`,`last_name`) values (46,'Vimukthi','','Saranga'),(53,'Ponnamperuma','Arachchige','Dayananda'),(54,'Sarath','','Kotalawala'),(55,'Kamal','Shantha','SIlva'),(56,'Gihan','Piyumantha','Dias'),(57,'Nihal','','Silva'),(58,'Ranil','','Perera'),(59,'Rajitha','Gayan','Jayasekara'),(60,'Supun','','Uddeepa'),(61,'Aruni','','Gunapala'),(62,'Buddika','Bageshwara','Alwis'),(63,'Dinesh','','Hasitha'),(64,'Thilina','','Perera'),(65,'Sameera','','Samarawickrama'),(66,'Thisara','','Perera'),(67,'Kumar','','Sangakkara'),(68,'Darshana','Devinda','Alwis'),(69,'Koshila','','Kalansooriya'),(70,'Dulanga','Gananath','Wijesuriya'),(71,'Nelisha','','Piyum'),(72,'Hansagee','','Wickramsinghe'),(73,'Oshan','','Perera'),(74,'Tharindu','','Nanayakkara'),(75,'Randula','','Silva'),(76,'Gayan','','Perera'),(77,'Kayukaran','','Parameswaran'),(78,'Tiran','','Dias'),(79,'Nisal','','Senevirathna'),(80,'Yasiru','','Fernando'),(81,'Geeshan','De','Mel'),(82,'Udayanga','','Sennanayake'),(83,'Oshardie','','Tiseera'),(84,'Kumudu','','Silva'),(85,'Kusal','','Mendis'),(86,'Sanath','','Jayasuriya'),(87,'Mahela','','Jayawardena'),(88,'Muttaiah','','Muralidaran'),(89,'Bryan','','Perera'),(90,'Saman','','Senarathna'),(91,'Senarath','','Gurusinghe'),(92,'Dushan','','Nagahawatta'),(93,'Sunil','','Garambe'),(94,'Sarath','','Thalawattegedara'),(95,'Potuhera','','Pothupitiya'),(96,'Ajantha','','Neliyage'),(97,'Janidi','','Tharukshi'),(98,'Amandi','','Prarthana'),(99,'Koratuwalage','','Kusumawathi'),(100,'Aruna','','Chathuranga'),(101,'Thushara','','Buddhika'),(102,'Nagollagama','','Perera'),(103,'Timbiriyagedara','','Gunapala'),(104,'Ajantha','','Mendis'),(105,'Priyantha','','Herath'),(106,'Indika','','Kumara'),(107,'Rangana','Herath','Mudiyanse'),(108,'Morawaka','','Karunarathne'),(109,'Meerium','','Tissera'),(110,'Yureni','','Noshika'),(111,'Nishadi','','Nugera'),(112,'Prabath','','Silva'),(113,'Thandikulam','','Parameswaran'),(114,'Chathuranga','','Weerakatiya'),(115,'Sirimal','','Pinnaduwa'),(116,'Nuwan','','Kulasekara'),(117,'Nuwan','','Nugera'),(118,'Nishad','','Kodikara'),(119,'Deshani','','Bhagya'),(120,'Nisha','','Helen'),(121,'Ranga','','Kuamara'),(122,'Thusara','','Alwis'),(123,'Nirmali','','Aponso'),(124,'Chanaka','','Ponnamperuma'),(125,'Damith','','Chanaka'),(126,'Iroshima','','Kumari'),(127,'Ravindu','','Kuamara'),(128,'Chamod','','Nanayakkara'),(129,'Sanjeewa','','Pushpakumara'),(130,'Kavindi','','Dewage'),(131,'Maneka','','Dewage'),(132,'Sahan','','Sasanka'),(133,'Sinethra','','Lakshan'),(134,'Harsha','','Gunasekara'),(135,'Nishka','','Supul'),(136,'Kusal','Janith','Silva'),(137,'Kannasami','','Pasikudam'),(138,'Kosala','','Chathura'),(139,'Aparna','','Gunasinghe'),(140,'Thilina','','Gamlath'),(141,'Suranga','','Lakmal'),(142,'Mark','','Anthony'),(143,'Chamara','','Kapugedara'),(144,'Kesara','','Chmathkara'),(145,'Nisansala','','Pavithrani'),(146,'Mudalige','','Karunanayake'),(147,'Samith','','Kapurupassa'),(148,'Shalini','','Kapukotuwa'),(149,'Nishalka','','Gurusinghe'),(150,'Buddika','','Dinesh'),(151,'Pinsara','','Kokila'),(152,'Ruvindi','','Dias'),(153,'Nehara','','Pieris'),(154,'Wirantha','','Athukorala'),(155,'Rojith','Randula','Pieris'),(156,'Ahan','','Perera'),(157,'Dinesh','','Saparamadu'),(158,'Chirath','','Malasekara'),(159,'Indrachapa','','Liyanage'),(160,'Deshika','','Kaushani'),(161,'Naveen','','Lakmal'),(162,'Sanduni','','Chamatkara'),(163,'Ravimali','','Perera'),(164,'Frank','','Roshan'),(165,'Samadhi','','Jaya'),(166,'Iresh','','Dewaka'),(167,'Dimuth','','Pieris'),(168,'Dewaka','','Surendra'),(169,'Shehani','','Kulakulasooriya'),(170,'Diltara','','Gunasekara'),(171,'Niklesha','','Pereira'),(172,'Shaya','','Gamage'),(173,'Gayani','','Frenando'),(174,'Nethushi','','Shenaya'),(175,'Nicky','De','Silva'),(176,'Biyanka','','Ranasekara'),(177,'Sarani','','Hansini'),(178,'Hansaka','','Kulathunga'),(179,'Ariyarathna','','Gunapala'),(180,'Balapiyage','','Kasun'),(181,'Bentotage','','Gamini'),(182,'Jagath','','Chamila'),(183,'Wijesiri','','Jayasinghe'),(184,'Balanage','','Dushan'),(185,'Madhu','','Ushani'),(186,'Shaniya','','Madushani'),(187,'Pasindu','','Alwis'),(188,'Anuradha','','Erandathi'),(189,'Sakuni','','Illeperuma'),(190,'Ruwangi','','Kulasekara'),(191,'Suraj','','Randeev'),(192,'Nadeesha','','Wishwani'),(193,'Tharaka','','Munasinghe'),(194,'Hashan','','Ravindu'),(195,'Thisal','','Gunasoma'),(196,'Thulada','','Gunarathna'),(197,'Galagoda','','Chamara'),(198,'Irosh','','Gomes'),(199,'Nisha','','Ivandi'),(200,'Dusha','','Ivandi'),(201,'Kanchana','','Dabare'),(202,'Janith','','Silva'),(203,'Nishka','','Kulathunga'),(204,'Thushari','','Perera'),(205,'Vishakan','','Weerasekara'),(206,'Nithya','','Weerasoma'),(207,'Maithree','','Sirisena'),(208,'Mahinda','','Silva'),(209,'Pasan','','Gayashan'),(210,'Sayanthan','','Wimaleshwaran'),(211,'Vimalaharan','','Wimaleshwaran'),(212,'Shalintha','','Kapukotuwa'),(213,'Lawan','','Udara'),(214,'Shanika','','Rasanjalee'),(215,'Nethu','','Nimsara'),(216,'Duminda','','Niroshan'),(217,'Jagodage','','Duminda'),(218,'Surangi','','Jayalaththanthrige'),(219,'Nipun','','Chamika'),(220,'Chamika','','Galappaththi'),(221,'Udara','','Jayasundara'),(222,'Peshala','','Wijewickrama'),(223,'Hasitha','','Dabare'),(224,'Melani','','Dayananda'),(225,'Akuressa','','Gunatilaka'),(226,'Himantha','','Deshapriya'),(227,'Nadun','','Deshan'),(228,'Naduni','','Shanika'),(229,'Dulaj','','Croos'),(230,'Jayanath','','Dissanayake'),(231,'Harshana','','Dissanayake'),(232,'Adeers','','Shamal'),(233,'Shamal','','Withanawasam'),(234,'Amith','','Pussella'),(235,'Amal','','Aponsu'),(236,'Ananda','','Perera'),(237,'Shanaka','','Kodithuwakku'),(238,'Dasun','','Shanaka'),(239,'Aravinda','','Gunarathna'),(240,'Thiwanka','','Shehan'),(241,'Shehan','','Jayasuriya'),(242,'Chanuka','','Pieris'),(243,'Asitha','','Bandara'),(244,'Sadeev','','Samarawickrama'),(245,'Sudeepa','De','Silva'),(246,'Vimukthi','','Saranga');

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

/*Data for the table `payment` */

insert  into `payment`(`payment_id`,`ticket_id`,`payment_date_time`,`no_of_tickets`,`commuter_nic`) values (11,384,'2017-03-25 23:01:30',1,'931340034v'),(12,303,'2017-03-25 23:05:04',1,'931340034v');

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
) ENGINE=InnoDB AUTO_INCREMENT=303 DEFAULT CHARSET=utf8;

/*Data for the table `payment_terminal` */

insert  into `payment_terminal`(`payment_terminal_id`,`out_station_code`,`terminal_line`,`in_station_code`) values (72,'ALW','main','FOT'),(73,'APS','main','FOT'),(74,'BEM','main','FOT'),(75,'BGH','main','FOT'),(76,'BJM','main','FOT'),(77,'BTL','main','FOT'),(78,'BTU','main','FOT'),(79,'DAG','main','FOT'),(80,'DRL','main','FOT'),(81,'EDM','main','FOT'),(82,'GAN','main','FOT'),(83,'GND','main','FOT'),(84,'GPH','main','FOT'),(85,'HDP','main','FOT'),(86,'HRP','main','FOT'),(87,'HUN','main','FOT'),(88,'KEN','main','FOT'),(89,'KLA','main','FOT'),(90,'MDA','main','FOT'),(91,'MGG','main','FOT'),(92,'MIR','main','FOT'),(93,'PLG','main','FOT'),(94,'PLL','main','FOT'),(95,'PNL','main','FOT'),(96,'RBK','main','FOT'),(97,'RGM','main','FOT'),(98,'TBM','main','FOT'),(99,'VGD','main','FOT'),(100,'WKA','main','FOT'),(101,'WPA','main','FOT'),(102,'WRD','main','FOT'),(103,'WRW','main','FOT'),(104,'WSL','main','FOT'),(105,'WWT','main','FOT'),(106,'YGD','main','FOT'),(107,'YGM','main','FOT'),(108,'YTG','main','FOT'),(139,'AKT','ptm','FOT'),(140,'AND','ptm','FOT'),(141,'AWP','ptm','FOT'),(142,'BGY','ptm','FOT'),(143,'BLT','ptm','FOT'),(144,'BOA','ptm','FOT'),(145,'BSH','ptm','FOT'),(146,'CAK','ptm','FOT'),(147,'CHL','ptm','FOT'),(148,'EPN','ptm','FOT'),(149,'IPZ','ptm','FOT'),(150,'JLA','ptm','FOT'),(151,'KAN','ptm','FOT'),(152,'KAT','ptm','FOT'),(153,'KAW','ptm','FOT'),(154,'KCH','ptm','FOT'),(155,'KPL','ptm','FOT'),(156,'KTK','ptm','FOT'),(157,'KUD','ptm','FOT'),(158,'KUR','ptm','FOT'),(159,'KWW','ptm','FOT'),(160,'KYA','ptm','FOT'),(161,'LGM','ptm','FOT'),(162,'LWL','ptm','FOT'),(163,'MDP','ptm','FOT'),(164,'MGE','ptm','FOT'),(165,'MKI','ptm','FOT'),(166,'MNG','ptm','FOT'),(167,'MNL','ptm','FOT'),(168,'NAT','ptm','FOT'),(169,'NGB','ptm','FOT'),(170,'NOR','ptm','FOT'),(171,'NPK','ptm','FOT'),(172,'PCK','ptm','FOT'),(173,'PNV','ptm','FOT'),(174,'PRL','ptm','FOT'),(175,'PTM','ptm','FOT'),(176,'PVI','ptm','FOT'),(177,'SED','ptm','FOT'),(178,'SWR','ptm','FOT'),(179,'TDR','ptm','FOT'),(180,'TDY','ptm','FOT'),(181,'TUD','ptm','FOT'),(182,'WHP','ptm','FOT'),(183,'WKL','ptm','FOT'),(196,'ABA','coast','FOT'),(197,'AGL','coast','FOT'),(198,'AKU','coast','FOT'),(199,'ALT','coast','FOT'),(200,'AND','coast','FOT'),(201,'ANM','coast','FOT'),(202,'AUH','coast','FOT'),(203,'BNT','coast','FOT'),(204,'BPA','coast','FOT'),(205,'BPT','coast','FOT'),(206,'BRL','coast','FOT'),(207,'BSH','coast','FOT'),(208,'DNA','coast','FOT'),(209,'DWL','coast','FOT'),(210,'EYA','coast','FOT'),(211,'GLE','coast','FOT'),(212,'GNT','coast','FOT'),(213,'HBD','coast','FOT'),(214,'HKD','coast','FOT'),(215,'HML','coast','FOT'),(216,'IDA','coast','FOT'),(217,'KDA','coast','FOT'),(218,'KGD','coast','FOT'),(219,'KKD','coast','FOT'),(220,'KLP','coast','FOT'),(221,'KMB','coast','FOT'),(222,'KMG','coast','FOT'),(223,'KMK','coast','FOT'),(224,'KOG','coast','FOT'),(225,'KOR','coast','FOT'),(226,'KPN','coast','FOT'),(227,'KTL','coast','FOT'),(228,'KTN','coast','FOT'),(229,'KTS','coast','FOT'),(230,'KUG','coast','FOT'),(231,'KWE','coast','FOT'),(232,'LNA','coast','FOT'),(233,'MED','coast','FOT'),(234,'MGN','coast','FOT'),(235,'MIS','coast','FOT'),(236,'MLV','coast','FOT'),(237,'MPA','coast','FOT'),(238,'MRT','coast','FOT'),(239,'MTR','coast','FOT'),(240,'MWA','coast','FOT'),(241,'PGD','coast','FOT'),(242,'PGM','coast','FOT'),(243,'PGN','coast','FOT'),(244,'PGS','coast','FOT'),(245,'PIN','coast','FOT'),(246,'PLD','coast','FOT'),(247,'PLR','coast','FOT'),(248,'PND','coast','FOT'),(249,'PYA','coast','FOT'),(250,'RCH','coast','FOT'),(251,'RML','coast','FOT'),(252,'RTG','coast','FOT'),(253,'SCR','coast','FOT'),(254,'SMA','coast','FOT'),(255,'TLP','coast','FOT'),(256,'TNA','coast','FOT'),(257,'TWT','coast','FOT'),(258,'UNW','coast','FOT'),(259,'WDA','coast','FOT'),(260,'WLG','coast','FOT'),(261,'WLM','coast','FOT'),(262,'WTE','coast','FOT'),(263,'GNW','kks','FOT'),(264,'GRB','kks','FOT'),(265,'KRN','kks','FOT'),(266,'MHO','kks','FOT'),(267,'MTG','kks','FOT'),(268,'NAG','kks','FOT'),(269,'NLY','kks','FOT'),(270,'PTA','kks','FOT'),(271,'TIM','kks','FOT'),(272,'TWG','kks','FOT'),(273,'WEL','kks','FOT'),(274,'YPP','kks','FOT'),(275,'APT','kv','FOT'),(276,'ARW','kv','FOT'),(277,'AVS','kv','FOT'),(278,'BSI','kv','FOT'),(279,'CRD','kv','FOT'),(280,'GGA','kv','FOT'),(281,'GMA','kv','FOT'),(282,'HMA','kv','FOT'),(283,'KDG','kv','FOT'),(284,'KOT','kv','FOT'),(285,'KPE','kv','FOT'),(286,'KSG','kv','FOT'),(287,'MAG','kv','FOT'),(288,'MGD','kv','FOT'),(289,'MKP','kv','FOT'),(290,'MPL','kv','FOT'),(291,'NHP','kv','FOT'),(292,'NUG','kv','FOT'),(293,'NWN','kv','FOT'),(294,'PAN','kv','FOT'),(295,'PDK','kv','FOT'),(296,'PNG','kv','FOT'),(297,'PNW','kv','FOT'),(298,'PWP','kv','FOT'),(299,'UGL','kv','FOT'),(300,'UHM','kv','FOT'),(301,'WAT','kv','FOT'),(302,'WGG','kv','FOT');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `recharge` */

insert  into `recharge`(`topup_id`,`recharge_date_time`,`amount`,`card_card_no`,`employee_nic`,`send_status`) values (1,'2017-03-25 22:23:47','100.00','1234567890123455','789548632v',0);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `registrar_final_payment` */

insert  into `registrar_final_payment`(`payment_fee`,`payment_status`,`payment_date`,`payment_id`,`employee_nic`,`payment_received_by`) values ('100.00',1,'2017-03-25 21:58:20',1,'894752361v','657891257v');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `registrar_payment` */

insert  into `registrar_payment`(`payment_id`,`payment_date_time`,`commuter_nic`,`commuter_regfee_regfee_id`,`employee_nic`,`status`) values (9,'2017-03-25 21:55:34','931340034v',11,'894752361v',1);

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

insert  into `staff`(`employee_id`,`employee_position_position_id`,`employee_nic`,`station_code`) values ('E0001',1,'931340034v','all'),('E0002',2,'794384562v','all'),('E0003',3,'657891257v','FOT'),('E0004',3,'894532167v','AVS'),('E0005',3,'753159786v','MDA'),('E0006',3,'453126953v','DAG'),('E0007',3,'863120548v','KLA'),('E0008',3,'753159826v','WRD'),('E0009',3,'853164259v','YTG'),('E0010',3,'753698521v','GND'),('E0011',3,'888456123v','PLL'),('E0012',3,'777555623v','WSL'),('E0013',3,'666555777v','KEN'),('E0014',3,'698523456v','WWT'),('E0015',3,'756984238v','MIR'),('E0016',3,'775566998v','WRW'),('E0017',3,'889977489v','APS'),('E0018',3,'778956725v','BTL'),('E0019',3,'753666995v','BJM'),('E0020',3,'755588894v','BGH'),('E0021',3,'759777666v','PNL'),('E0022',3,'756984423v','GPH'),('E0023',3,'777888569v','RGM'),('E0024',3,'555666852v','EDM'),('E0025',3,'778889956v','HUN'),('E0026',3,'554442229v','WPA'),('E0027',3,'556684238v','HRP'),('E0028',3,'753666444v','WKA'),('E0029',3,'857559643v','DRL'),('E0030',3,'666333222v','BTU'),('E0031',3,'456789258v','MGG'),('E0032',3,'753159444v','YGD'),('E0033',3,'555666888v','GAN'),('E0034',3,'777666333v','ALW'),('E0035',3,'753202020v','BEM'),('E0036',3,'853012459v','TBM'),('E0037',3,'423056982v','VGD'),('E0038',3,'123456789v','HDP'),('E0039',3,'321025648v','PLG'),('E0040',3,'456789987v','YGM'),('E0041',3,'753154784v','RBK'),('E0042',3,'789789789v','TWG'),('E0043',3,'456465789v','GRB'),('E0044',3,'789789987v','PTA'),('E0045',3,'753159777v','MTG'),('E0046',3,'548965558v','KRN'),('E0047',3,'201345685v','NLY'),('E0048',3,'201789456v','WEL'),('E0049',3,'789456888v','YPP'),('E0050',3,'753999885v','GNW'),('E0051',3,'753444444v','NAG'),('E0052',3,'888999777v','MHO'),('E0053',3,'555666159v','TIM'),('E0054',3,'752000555v','BSI'),('E0055',3,'759846218v','KOT'),('E0056',3,'895288630v','CRD'),('E0057',3,'759846235v','UHM'),('E0058',3,'789789780v','NUG'),('E0059',3,'753753753v','NHP'),('E0060',3,'123321123v','PAN'),('E0061',3,'555123789v','MPL'),('E0062',3,'889756825v','HMA'),('E0063',3,'779988552v','WAT'),('E0064',3,'998875628v','NWN'),('E0065',3,'789987456v','MAG'),('E0066',3,'999999475v','KPE'),('E0067',3,'888753159v','GGA'),('E0068',3,'789555666v','PDK'),('E0069',3,'753698741v','MGD'),('E0070',3,'753888777v','PNG'),('E0071',3,'777777777v','JLA'),('E0072',3,'888888888v','NGB'),('E0073',3,'999999999v','GMA'),('E0074',3,'666666666v','PNW'),('E0075',3,'444444444v','MKP'),('E0076',3,'555555555v','WGG'),('E0077',3,'333333333v','KDG'),('E0078',3,'111111111v','IPZ'),('E0079',3,'777888444v','KSG'),('E0080',3,'123123456v','ARW'),('E0081',3,'232345456v','PWP'),('E0082',3,'323256985v','TUD'),('E0083',3,'329875698v','KUD'),('E0084',3,'753951842v','PRL'),('E0085',3,'348619726v','LGM'),('E0086',3,'793148625v','APT'),('E0087',3,'794138426v','UGL'),('E0088',3,'753753846v','SED'),('E0089',3,'302750189v','KTK'),('E0090',3,'789123506v','KUR'),('E0091',3,'789123059v','BSA'),('E0092',3,'304506820v','KAW'),('E0093',3,'307539513v','AWP'),('E0094',3,'753000684v','BLT'),('E0095',3,'505075362v','KAN'),('E0096',3,'967531260v','KAT'),('E0097',3,'964567890v','KCH'),('E0098',3,'397531592v','CAK'),('E0099',3,'203245698v','WKL'),('E0100',3,'703951083v','LWL'),('E0101',3,'321231236v','TDR'),('E0102',3,'753961025v','NOR'),('E0103',3,'999253168v','AKT'),('E0104',3,'758963250v','MNG'),('E0105',3,'168203595v','BGY'),('E0106',3,'159785234v','MGE'),('E0107',3,'789528364v','BOA'),('E0108',3,'830156983v','AND'),('E0109',3,'830145698v','CHL'),('E0110',3,'305721962v','MNL'),('E0111',3,'934560235v','MDP'),('E0112',3,'753159286v','PCK'),('E0113',3,'759410236v','KYA'),('E0114',3,'735940235v','NAT'),('E0115',3,'753126950v','WHP'),('E0116',3,'753126840v','KWW'),('E0117',3,'753945821v','TDY'),('E0118',3,'789258436v','NPK'),('E0119',3,'785496325v','SWR'),('E0120',3,'756982431v','PVI'),('E0121',3,'759361582v','EPN'),('E0122',3,'325978468v','MKI'),('E0123',3,'736951283v','PTM'),('E0124',3,'789528634v','KPL'),('E0125',3,'789523681v','PNV'),('E0126',3,'789526702v','PIN'),('E0127',3,'759681234v','SCR'),('E0128',3,'759842630v','EYA'),('E0129',3,'759846018v','KOR'),('E0130',3,'789879521v','KKD'),('E0131',3,'333666555v','LNA'),('E0132',3,'789888562v','MRT'),('E0133',3,'785964128v','AGL'),('E0134',3,'555896482v','PND'),('E0135',3,'785694238v','KTN'),('E0136',3,'485697236v','WDA'),('E0137',3,'789586214v','WTE'),('E0138',3,'598764823v','DWL'),('E0139',3,'879584632v','KPN'),('E0140',3,'758775269v','BPT'),('E0141',3,'598670358v','MLV'),('E0142',3,'859784569v','PGS'),('E0143',3,'789857682v','KLP'),('E0144',3,'258795486v','KTS'),('E0145',3,'589762485v','PGN'),('E0146',3,'587968426v','BRL'),('E0147',3,'359876185v','MGN'),('E0148',3,'359876125v','RML'),('E0149',3,'359876127v','ALT'),('E0150',3,'258963147v','HML'),('E0151',3,'789587692v','MWA'),('E0152',3,'269875813v','PGD'),('E0153',3,'258369412v','BNT'),('E0154',3,'569732591v','IDA'),('E0155',3,'358967125v','PYA'),('E0156',3,'759612384v','AUH'),('E0157',3,'326894752v','KDA'),('E0158',3,'458796320v','KGD'),('E0159',3,'789587962v','MPA'),('E0160',3,'789785123v','ABA'),('E0161',3,'987536402v','BPA'),('E0162',3,'789587621v','AKU'),('E0163',3,'789845623v','HKD'),('E0164',3,'587963142v','SMA'),('E0165',3,'789523614v','TWT'),('E0166',3,'789658234v','RTG'),('E0167',3,'587963214v','TNA'),('E0168',3,'258974136v','TLP'),('E0169',3,'235698741v','KMK'),('E0170',3,'324785106v','DNA'),('E0171',3,'752014896v','BSH'),('E0172',3,'789487562v','GNT'),('E0173',3,'487521986v','PGM'),('E0174',3,'785210369v','GLE'),('E0175',3,'852074136v','KWE'),('E0176',3,'789520146v','RCH'),('E0177',3,'587963140v','KUG'),('E0178',3,'753147952v','UNW'),('E0179',3,'752103698v','HBD'),('E0180',3,'785213694v','KOG'),('E0181',3,'753159852v','PLR'),('E0182',3,'321478521v','ANM'),('E0183',3,'325874106v','KTL'),('E0184',3,'852036974v','MED'),('E0185',3,'874569320v','KMB'),('E0186',3,'745001236v','WLM'),('E0187',3,'785632410v','MIS'),('E0188',3,'756314852v','WLG'),('E0189',3,'757778963v','KMG'),('E0190',3,'753698412v','MTR'),('E0191',3,'854103692v','PLD'),('E0192',4,'894752361v','FOT'),('E0193',5,'853697412v','FOT');

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

insert  into `station`(`station_code`,`station_name`,`available_cards`,`employee_nic`) values ('ABA','Ambalangoda',0,'789785123v'),('AGL','Angulana',0,'785964128v'),('AKT','Arachchikattuwa',0,'999253168v'),('AKU','Akurala',0,'789587621v'),('ALT','Aluthgama',0,'359876127v'),('ALW','Alawwa',0,'777666333v'),('AND','Andadola',0,'830156983v'),('ANM','Ahangama',0,'321478521v'),('APS','Ambeypussa',0,'889977489v'),('APT','Angampitiya',0,'793148625v'),('ARW','Arukkuwatte',0,'123123456v'),('AUH','Ahungalle',0,'759612384v'),('AVS','Avissawelle',0,'894532167v'),('AWP','Alawatupitiya',0,'307539513v'),('BEM','Bemmulla',0,'753202020v'),('BGH','Bulugahagoda',0,'755588894v'),('BGY','Bangadeniya',0,'168203595v'),('BJM','Bullomuwa',0,'753666995v'),('BLT','Bolawatta',0,'753000684v'),('BNT','Bentota',0,'258369412v'),('BOA','Battaluoya',0,'789528364v'),('BPA','Balapitiya',0,'987536402v'),('BPT','Bambalapitiya',0,'758775269v'),('BRL','Beruwala',0,'587968426v'),('BSA','Borelessa',0,'789123059v'),('BSH','Boossa',0,'752014896v'),('BSI','Baseline',0,'752000555v'),('BTL','Botale',0,'778956725v'),('BTU','Batuwatte',0,'666333222v'),('CAK','Airport',0,'397531592v'),('CHL','Chillaw',0,'830145698v'),('CRD','Cotta',0,'895288630v'),('DAG','Dematagoda',0,'453126953v'),('DNA','Dodanduwe',0,'324785106v'),('DRL','Daraluwa',0,'857559643v'),('DWL','Dehiwala',0,'598764823v'),('EDM','Enderamulla',0,'555666852v'),('EPN','Erukkalampendu',0,'759361582v'),('EYA','EgodaUyana',0,'759842630v'),('FOT','Fort',2,'657891257v'),('GAN','Ganemulla',0,'555666888v'),('GGA','Godagama',0,'888753159v'),('GLE','Galle',0,'785210369v'),('GMA','Gammana',0,'999999999v'),('GND','Ganegoda',0,'753698521v'),('GNT','Ginthota',0,'789487562v'),('GNW','Ganewatta',0,'753999885v'),('GPH','Gampaha',0,'756984423v'),('GRB','Garambe',0,'456465789v'),('HBD','Habaraduwa',0,'752103698v'),('HDP','Heendeniya',0,'123456789v'),('HKD','Hikkaduwa',0,'789845623v'),('HMA','Homagama',0,'889756825v'),('HML','Hettimulla',0,'258963147v'),('HRP','Horape',0,'556684238v'),('HUN','Hunupitiya',0,'778889956v'),('IDA','Induruwa',0,'569732591v'),('IPZ','TradeZone',0,'111111111v'),('JLA','JaEla',0,'777777777v'),('KAN','Kandana',0,'505075362v'),('KAT','Kattuwa',0,'967531260v'),('KAW','Kapuwatte',0,'304506820v'),('KCH','Kochchikade',0,'964567890v'),('KDA','Kosgoda',0,'326894752v'),('KDG','Kadugoda',0,'333333333v'),('KEN','Keenawela',0,'666555777v'),('KGD','Kandegoda',0,'458796320v'),('KKD','Katukurunda',0,'789879521v'),('KLA','Kelaniya',0,'863120548v'),('KLP','Kollupitiya',0,'789857682v'),('KMB','Kumbalgama',0,'874569320v'),('KMG','Kamburugamuwa',0,'757778963v'),('KMK','Kumarakanda',0,'235698741v'),('KOG','Koggala',0,'785213694v'),('KOR','Koralawella',0,'759846018v'),('KOT','Kottawa',0,'759846218v'),('KPE','Kirulapone',0,'999999475v'),('KPL','Karadipuwal',0,'789528634v'),('KPN','Kompnnavidiya',0,'879584632v'),('KRN','Kurunegala',0,'548965558v'),('KSG','Kosgama',0,'777888444v'),('KTK','Katunayake',0,'302750189v'),('KTL','Kathaluwa',0,'325874106v'),('KTN','KalutharaN',0,'785694238v'),('KTS','KalutharaS',0,'258795486v'),('KUD','Kudahakapola',0,'329875698v'),('KUG','Katugoda',0,'587963140v'),('KUR','Kurana',0,'789123506v'),('KWE','Kahawa',0,'852074136v'),('KWW','Kudawewa',0,'753126840v'),('KYA','Kakkapalliya',0,'759410236v'),('LGM','Liyanagemulla',0,'348619726v'),('LNA','Lunawa',0,'333666555v'),('LWL','Lunuwella',0,'703951083v'),('MAG','Maharagama',0,'789987456v'),('MDA','Maradana',0,'753159786v'),('MDP','Madampe',0,'934560235v'),('MED','Midigama',0,'852036974v'),('MGD','Meegoda',0,'753698741v'),('MGE','MangalaEliya',0,'159785234v'),('MGG','Magelegoda',0,'456789258v'),('MGN','Maggone',0,'359876185v'),('MHO','Maho',0,'888999777v'),('MIR','Mirigama',0,'756984238v'),('MIS','Mirissa',0,'785632410v'),('MKI','Madurankuliya',0,'325978468v'),('MKP','Morakele',0,'444444444v'),('MLV','MtLavinia',0,'598670358v'),('MNG','Manuwangama',0,'758963250v'),('MNL','Mundal',0,'305721962v'),('MPA','Madampagama',0,'789587962v'),('MPL','Malpalle',0,'555123789v'),('MRT','Moratuwa',0,'789888562v'),('MTG','Muththettugala',0,'753159777v'),('MTR','Matara',0,'753698412v'),('MWA','MahaInduruwa',0,'789587692v'),('NAG','Nagollagama',0,'753444444v'),('NAT','Nattandiya',0,'735940235v'),('NGB','Negombo',0,'888888888v'),('NHP','Narahenpita',0,'753753753v'),('NLY','Nailiya',0,'201345685v'),('NOR','Noornagar',0,'753961025v'),('NPK','Nelumpokuna',0,'789258436v'),('NUG','Nugegoda',0,'789789780v'),('NWN','Nawinna',0,'998875628v'),('PAN','Pannipitiya',0,'123321123v'),('PCK','Pullachchikulam',0,'753159286v'),('PDK','Padukka',0,'789555666v'),('PGD','Patagamgoda',0,'269875813v'),('PGM','Piyadigama',0,'487521986v'),('PGN','PayagalaN',0,'589762485v'),('PGS','PayagalaS',0,'859784569v'),('PIN','Pinwatte',0,'789526702v'),('PLD','Piliduwa',0,'854103692v'),('PLG','Polgahawela',0,'321025648v'),('PLL','Pellewala',0,'888456123v'),('PLR','Polwathumodara',0,'753159852v'),('PND','Panadura',0,'555896482v'),('PNG','Panagoda',0,'753888777v'),('PNL','Panaliya',0,'759777666v'),('PNV','Periyanagavillu',0,'789523681v'),('PNW','Pinnawala',0,'666666666v'),('PRL','Peralanda',0,'753951842v'),('PTA','Potuhera',0,'789789987v'),('PTM','Puttalam',0,'736951283v'),('PVI','Palavi',0,'756982431v'),('PWP','Puwakpitiya',0,'232345456v'),('PYA','Piyagama',0,'358967125v'),('RBK','Rambukkana',0,'753154784v'),('RCH','Richmondhill',0,'789520146v'),('RGM','Ragama',0,'777888569v'),('RML','Rathmalana',0,'359876125v'),('RTG','Raigama',0,'789658234v'),('SCR','SecretartatHall',0,'759681234v'),('SED','Seeduwa',0,'753753846v'),('SMA','Seenigama',0,'587963142v'),('SWR','Sawarana',0,'785496325v'),('TBM','Thambalpola',0,'853012459v'),('TDR','Tummodara',0,'321231236v'),('TDY','Thilladiya',0,'753945821v'),('TIM','Timbiriyagedara',0,'555666159v'),('TLP','Talpe',0,'258974136v'),('TNA','Thiranagama',0,'587963214v'),('TUD','Tudella',0,'323256985v'),('TWG','Talawattegedara',0,'789789789v'),('TWT','Telwatte',0,'789523614v'),('UGL','Uggalla',0,'794138426v'),('UHM','Udahamulla',0,'759846235v'),('UNW','Unawatuna',0,'753147952v'),('VGD','Veyangoda',0,'423056982v'),('WAT','Watareka',0,'779988552v'),('WDA','Wadduwa',0,'485697236v'),('WEL','Wellawa',0,'201789456v'),('WGG','Waga',0,'555555555v'),('WHP','Walahapitiya',0,'753126950v'),('WKA','Wiakumbura',0,'753666444v'),('WKL','Waikkala',0,'203245698v'),('WLG','Walgama',0,'756314852v'),('WLM','Weligama',0,'745001236v'),('WPA','Walpola',0,'554442229v'),('WRD','Wijayareladahara',0,'753159826v'),('WRW','Wandurawa',0,'775566998v'),('WSL','Wanswasala',0,'777555623v'),('WTE','Wellawatte',0,'789586214v'),('WWT','Wilwatte',0,'698523456v'),('YGD','Yagoda',0,'753159444v'),('YGM','Yategama',0,'456789987v'),('YPP','Yahapauwe',0,'789456888v'),('YTG','Yatalagoda',0,'853164259v');

/*Table structure for table `ticket` */

DROP TABLE IF EXISTS `ticket`;

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_fee` decimal(6,2) NOT NULL,
  `station_in_station_code` varchar(10) NOT NULL,
  `station_out_station_code` varchar(10) NOT NULL,
  `class` int(1) NOT NULL,
  PRIMARY KEY (`ticket_id`),
  KEY `fk_ticket_station1_idx` (`station_in_station_code`),
  KEY `fk_ticket_station2_idx` (`station_out_station_code`),
  CONSTRAINT `fk_ticket_station1` FOREIGN KEY (`station_in_station_code`) REFERENCES `station` (`station_code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticket_station2` FOREIGN KEY (`station_out_station_code`) REFERENCES `station` (`station_code`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=586 DEFAULT CHARSET=utf8;

/*Data for the table `ticket` */

insert  into `ticket`(`ticket_id`,`ticket_fee`,`station_in_station_code`,`station_out_station_code`,`class`) values (22,'40.00','FOT','MDA',1),(23,'20.00','FOT','MDA',2),(24,'10.00','FOT','MDA',3),(25,'40.00','FOT','DAG',1),(26,'20.00','FOT','DAG',2),(27,'10.00','FOT','DAG',3),(28,'40.00','FOT','KLA',1),(29,'20.00','FOT','KLA',2),(30,'10.00','FOT','KLA',3),(31,'40.00','FOT','WSL',1),(32,'20.00','FOT','WSL',2),(33,'10.00','FOT','WSL',3),(34,'40.00','FOT','HUN',1),(35,'20.00','FOT','HUN',2),(36,'10.00','FOT','HUN',3),(37,'40.00','FOT','EDM',1),(38,'20.00','FOT','EDM',2),(39,'15.00','FOT','EDM',3),(40,'60.00','FOT','HRP',1),(41,'30.00','FOT','HRP',2),(42,'15.00','FOT','HRP',3),(43,'60.00','FOT','RGM',1),(44,'30.00','FOT','RGM',2),(45,'20.00','FOT','RGM',3),(46,'60.00','FOT','WPA',1),(47,'40.00','FOT','WPA',2),(48,'20.00','FOT','WPA',3),(49,'60.00','FOT','BTU',1),(50,'40.00','FOT','BTU',2),(51,'20.00','FOT','BTU',3),(52,'80.00','FOT','BGH',1),(53,'40.00','FOT','BGH',2),(54,'20.00','FOT','BGH',3),(55,'80.00','FOT','GAN',1),(56,'40.00','FOT','GAN',2),(57,'26.00','FOT','GAN',3),(58,'80.00','FOT','YGD',1),(59,'50.00','FOT','YGD',2),(60,'26.00','FOT','YGD',3),(61,'100.00','FOT','GPH',1),(62,'50.00','FOT','GPH',2),(63,'26.00','FOT','GPH',3),(64,'100.00','FOT','DRL',1),(65,'60.00','FOT','DRL',2),(66,'30.00','FOT','DRL',3),(67,'100.00','FOT','BEM',1),(68,'60.00','FOT','BEM',2),(69,'30.00','FOT','BEM',3),(70,'120.00','FOT','MGG',1),(71,'60.00','FOT','MGG',2),(72,'35.00','FOT','MGG',3),(73,'120.00','FOT','HDP',1),(74,'70.00','FOT','HDP',2),(75,'35.00','FOT','HDP',3),(76,'120.00','FOT','VGD',1),(77,'70.00','FOT','VGD',2),(78,'35.00','FOT','VGD',3),(79,'140.00','FOT','WRW',1),(80,'70.00','FOT','WRW',2),(81,'40.00','FOT','WRW',3),(82,'140.00','FOT','KEN',1),(83,'80.00','FOT','KEN',2),(84,'40.00','FOT','KEN',3),(85,'140.00','FOT','PLL',1),(86,'80.00','FOT','PLL',2),(87,'45.00','FOT','PLL',3),(88,'160.00','FOT','GND',1),(89,'80.00','FOT','GND',2),(90,'45.00','FOT','GND',3),(91,'180.00','FOT','WRD',1),(92,'90.00','FOT','WRD',2),(93,'50.00','FOT','WRD',3),(94,'180.00','FOT','MIR',1),(95,'90.00','FOT','MIR',2),(96,'50.00','FOT','MIR',3),(97,'180.00','FOT','WWT',1),(98,'90.00','FOT','WWT',2),(99,'50.00','FOT','WWT',3),(100,'180.00','FOT','BTL',1),(101,'100.00','FOT','BTL',2),(102,'55.00','FOT','BTL',3),(103,'180.00','FOT','APS',1),(104,'100.00','FOT','APS',2),(105,'55.00','FOT','APS',3),(106,'200.00','FOT','YTG',1),(107,'110.00','FOT','YTG',2),(108,'55.00','FOT','YTG',3),(109,'200.00','FOT','BJM',1),(110,'110.00','FOT','BJM',2),(111,'60.00','FOT','BJM',3),(112,'200.00','FOT','ALW',1),(113,'110.00','FOT','ALW',2),(114,'60.00','FOT','ALW',3),(115,'220.00','FOT','WKA',1),(116,'120.00','FOT','WKA',2),(117,'65.00','FOT','WKA',3),(118,'240.00','FOT','PLG',1),(119,'130.00','FOT','PLG',2),(120,'70.00','FOT','PLG',3),(121,'240.00','FOT','PNL',1),(122,'130.00','FOT','PNL',2),(123,'75.00','FOT','PNL',3),(124,'240.00','FOT','TBM',1),(125,'130.00','FOT','TBM',2),(126,'75.00','FOT','TBM',3),(127,'260.00','FOT','YGM',1),(128,'140.00','FOT','YGM',2),(129,'75.00','FOT','YGM',3),(130,'260.00','FOT','RBK',1),(131,'140.00','FOT','RBK',2),(132,'80.00','FOT','RBK',3),(133,'240.00','FOT','GRB',1),(134,'130.00','FOT','GRB',2),(135,'75.00','FOT','GRB',3),(136,'260.00','FOT','TWG',1),(137,'140.00','FOT','TWG',2),(138,'75.00','FOT','TWG',3),(139,'260.00','FOT','PTA',1),(140,'80.00','FOT','PTA',3),(141,'150.00','FOT','PTA',2),(142,'280.00','FOT','NLY',1),(143,'160.00','FOT','NLY',2),(144,'58.00','FOT','NLY',3),(145,'300.00','FOT','KRN',1),(146,'160.00','FOT','KRN',2),(147,'85.00','FOT','KRN',3),(148,'300.00','FOT','MTG',1),(149,'160.00','FOT','MTG',2),(150,'90.00','FOT','MTG',3),(151,'320.00','FOT','WEL',1),(152,'170.00','FOT','WEL',2),(153,'95.00','FOT','WEL',3),(154,'340.00','FOT','GNW',1),(155,'190.00','FOT','GNW',2),(156,'100.00','FOT','GNW',3),(157,'360.00','FOT','YPP',1),(158,'190.00','FOT','YPP',2),(159,'105.00','FOT','YPP',3),(160,'380.00','FOT','NAG',1),(161,'200.00','FOT','NAG',2),(162,'110.00','FOT','NAG',3),(163,'380.00','FOT','TIM',1),(164,'210.00','FOT','TIM',2),(165,'115.00','FOT','TIM',3),(166,'380.00','FOT','MHO',1),(167,'210.00','FOT','MHO',2),(168,'115.00','FOT','MHO',3),(169,'80.00','FOT','PRL',1),(170,'30.00','FOT','PRL',2),(171,'20.00','FOT','PRL',3),(172,'80.00','FOT','KAN',1),(173,'40.00','FOT','KAN',2),(174,'20.00','FOT','KAN',3),(175,'80.00','FOT','KAW',1),(176,'40.00','FOT','KAW',2),(177,'20.00','FOT','KAW',3),(178,'80.00','FOT','JLA',1),(179,'40.00','FOT','JLA',2),(180,'25.00','FOT','JLA',3),(181,'80.00','FOT','TUD',1),(182,'50.00','FOT','TUD',2),(183,'25.00','FOT','TUD',3),(184,'80.00','FOT','KUD',1),(185,'50.00','FOT','KUD',2),(186,'25.00','FOT','KUD',3),(187,'100.00','FOT','AWP',1),(188,'50.00','FOT','AWP',2),(189,'25.00','FOT','AWP',3),(190,'100.00','FOT','SED',1),(191,'50.00','FOT','SED',2),(192,'25.00','FOT','SED',3),(193,'100.00','FOT','LGM',1),(194,'60.00','FOT','LGM',2),(195,'30.00','FOT','LGM',3),(196,'120.00','FOT','IPZ',1),(197,'60.00','FOT','IPZ',2),(198,'30.00','FOT','IPZ',3),(199,'120.00','FOT','KTK',1),(200,'60.00','FOT','KTK',2),(201,'30.00','FOT','KTK',3),(202,'120.00','FOT','CAK',1),(203,'60.00','FOT','CAK',2),(204,'30.00','FOT','CAK',3),(205,'120.00','FOT','KUR',1),(206,'70.00','FOT','KUR',2),(207,'35.00','FOT','KUR',3),(208,'140.00','FOT','NGB',1),(209,'70.00','FOT','NGB',2),(210,'40.00','FOT','NGB',3),(211,'140.00','FOT','KAT',1),(212,'80.00','FOT','KAT',2),(213,'40.00','FOT','KAT',3),(214,'160.00','FOT','KCH',1),(215,'80.00','FOT','KCH',2),(216,'45.00','FOT','KCH',3),(217,'160.00','FOT','WKL',1),(218,'80.00','FOT','WKL',2),(219,'45.00','FOT','WKL',3),(220,'160.00','FOT','BLT',1),(221,'90.00','FOT','BLT',2),(222,'50.00','FOT','BLT',3),(223,'160.00','FOT','BSA',1),(224,'90.00','FOT','BSA',2),(225,'50.00','FOT','BSA',3),(226,'180.00','FOT','LWL',1),(227,'100.00','FOT','LWL',2),(228,'55.00','FOT','LWL',3),(229,'200.00','FOT','TDR',1),(230,'100.00','FOT','TDR',2),(231,'55.00','FOT','TDR',3),(232,'200.00','FOT','NAT',1),(233,'110.00','FOT','NAT',2),(234,'60.00','FOT','NAT',3),(235,'200.00','FOT','WHP',1),(236,'110.00','FOT','WHP',2),(237,'60.00','FOT','WHP',3),(238,'220.00','FOT','KWW',1),(239,'120.00','FOT','KWW',2),(240,'65.00','FOT','KWW',3),(241,'220.00','FOT','NPK',1),(242,'120.00','FOT','NPK',2),(243,'65.00','FOT','NPK',3),(244,'220.00','FOT','MDP',1),(245,'120.00','FOT','MDP',2),(246,'70.00','FOT','MDP',3),(247,'240.00','FOT','KYA',1),(248,'130.00','FOT','KYA',2),(249,'70.00','FOT','KYA',3),(250,'240.00','FOT','SWR',1),(251,'140.00','FOT','SWR',2),(252,'75.00','FOT','SWR',3),(253,'260.00','FOT','CHL',1),(254,'140.00','FOT','CHL',2),(255,'75.00','FOT','CHL',3),(256,'280.00','FOT','MNG',1),(257,'150.00','FOT','MNG',2),(258,'80.00','FOT','MNG',3),(259,'280.00','FOT','BGY',1),(260,'150.00','FOT','BGY',2),(261,'85.00','FOT','BGY',3),(262,'300.00','FOT','AKT',1),(263,'160.00','FOT','AKT',2),(264,'90.00','FOT','AKT',3),(265,'320.00','FOT','BOA',1),(266,'170.00','FOT','BOA',2),(267,'95.00','FOT','BOA',3),(268,'320.00','FOT','PCK',1),(269,'170.00','FOT','PCK',2),(270,'95.00','FOT','PCK',3),(271,'320.00','FOT','MNL',1),(272,'180.00','FOT','MNL',2),(273,'100.00','FOT','MNL',3),(274,'340.00','FOT','MGE',1),(275,'190.00','FOT','MGE',2),(276,'100.00','FOT','MGE',3),(277,'340.00','FOT','EPN',1),(278,'190.00','FOT','EPN',2),(279,'100.00','FOT','EPN',3),(280,'360.00','FOT','MKI',1),(281,'190.00','FOT','MKI',2),(282,'105.00','FOT','MKI',3),(283,'360.00','FOT','PVI',1),(284,'200.00','FOT','PVI',2),(285,'110.00','FOT','PVI',3),(286,'360.00','FOT','TDY',1),(287,'200.00','FOT','TDY',2),(288,'110.00','FOT','TDY',3),(289,'380.00','FOT','PTM',1),(290,'210.00','FOT','PTM',2),(291,'115.00','FOT','PTM',3),(292,'380.00','FOT','NOR',1),(293,'210.00','FOT','NOR',2),(294,'115.00','FOT','NOR',3),(295,'400.00','FOT','KPL',1),(296,'220.00','FOT','KPL',2),(297,'125.00','FOT','KPL',3),(298,'420.00','FOT','PNV',1),(299,'240.00','FOT','PNV',2),(300,'130.00','FOT','PNV',3),(301,'40.00','FOT','BSI',1),(302,'20.00','FOT','BSI',2),(303,'10.00','FOT','BSI',3),(304,'40.00','FOT','CRD',1),(305,'20.00','FOT','CRD',2),(306,'10.00','FOT','CRD',3),(307,'40.00','FOT','NHP',1),(308,'20.00','FOT','NHP',2),(309,'10.00','FOT','NHP',3),(310,'40.00','FOT','KPE',1),(311,'20.00','FOT','KPE',2),(312,'10.00','FOT','KPE',3),(313,'40.00','FOT','NUG',1),(314,'20.00','FOT','NUG',2),(315,'15.00','FOT','NUG',3),(316,'40.00','FOT','UHM',1),(317,'30.00','FOT','UHM',2),(318,'15.00','FOT','UHM',3),(319,'60.00','FOT','NWN',1),(320,'30.00','FOT','NWN',2),(321,'15.00','FOT','NWN',3),(322,'60.00','FOT','MAG',1),(323,'30.00','FOT','MAG',2),(324,'20.00','FOT','MAG',3),(325,'60.00','FOT','PAN',1),(326,'40.00','FOT','PAN',2),(327,'20.00','FOT','PAN',3),(328,'80.00','FOT','KOT',1),(329,'40.00','FOT','KOT',2),(330,'25.00','FOT','KOT',3),(331,'80.00','FOT','MPL',1),(332,'40.00','FOT','MPL',2),(333,'25.00','FOT','MPL',3),(334,'100.00','FOT','HMA',1),(335,'50.00','FOT','HMA',2),(336,'25.00','FOT','HMA',3),(337,'100.00','FOT','PNG',1),(338,'50.00','FOT','PNG',2),(339,'25.00','FOT','PNG',3),(340,'100.00','FOT','GGA',1),(341,'60.00','FOT','GGA',2),(342,'30.00','FOT','GGA',3),(343,'100.00','FOT','MGD',1),(344,'60.00','FOT','MGD',2),(345,'30.00','FOT','MGD',3),(346,'120.00','FOT','WAT',1),(347,'60.00','FOT','WAT',2),(348,'30.00','FOT','WAT',3),(349,'120.00','FOT','PDK',1),(350,'70.00','FOT','PDK',2),(351,'35.00','FOT','PDK',3),(352,'130.00','FOT','ARW',1),(353,'75.00','FOT','ARW',2),(354,'35.00','FOT','ARW',3),(355,'130.00','FOT','APT',1),(356,'75.00','FOT','APT',2),(357,'35.00','FOT','APT',3),(358,'130.00','FOT','UGL',1),(359,'75.00','FOT','UGL',2),(360,'35.00','FOT','UGL',3),(361,'140.00','FOT','PNW',1),(362,'80.00','FOT','PNW',2),(363,'40.00','FOT','PNW',3),(364,'150.00','FOT','GMA',1),(365,'85.00','FOT','GMA',2),(366,'45.00','FOT','GMA',3),(367,'150.00','FOT','MKP',1),(368,'85.00','FOT','MKP',2),(369,'45.00','FOT','MKP',3),(370,'160.00','FOT','WGG',1),(371,'90.00','FOT','WGG',2),(372,'45.00','FOT','WGG',3),(373,'170.00','FOT','KDG',1),(374,'95.00','FOT','KDG',2),(375,'50.00','FOT','KDG',3),(376,'180.00','FOT','KSG',1),(377,'100.00','FOT','KSG',2),(378,'50.00','FOT','KSG',3),(379,'180.00','FOT','PWP',1),(380,'100.00','FOT','PWP',2),(381,'55.00','FOT','PWP',3),(382,'200.00','FOT','AVS',1),(383,'110.00','FOT','AVS',2),(384,'60.00','FOT','AVS',3),(385,'40.00','FOT','SCR',1),(386,'20.00','FOT','SCR',2),(387,'10.00','FOT','SCR',3),(388,'40.00','FOT','KPN',1),(389,'20.00','FOT','KPN',2),(390,'10.00','FOT','KPN',3),(391,'40.00','FOT','KLP',1),(392,'20.00','FOT','KLP',2),(393,'10.00','FOT','KLP',3),(394,'40.00','FOT','BPT',1),(395,'20.00','FOT','BPT',2),(396,'10.00','FOT','BPT',3),(397,'40.00','FOT','WTE',1),(398,'20.00','FOT','WTE',2),(399,'10.00','FOT','WTE',3),(400,'40.00','FOT','DWL',1),(401,'20.00','FOT','DWL',2),(402,'10.00','FOT','DWL',3),(403,'40.00','FOT','MLV',1),(404,'20.00','FOT','MLV',2),(405,'15.00','FOT','MLV',3),(406,'60.00','FOT','RML',1),(407,'30.00','FOT','RML',2),(408,'15.00','FOT','RML',3),(409,'60.00','FOT','AGL',1),(410,'30.00','FOT','AGL',2),(411,'15.00','FOT','AGL',3),(412,'60.00','FOT','LNA',1),(413,'30.00','FOT','LNA',2),(414,'20.00','FOT','LNA',3),(415,'60.00','FOT','MRT',1),(416,'40.00','FOT','MRT',2),(417,'20.00','FOT','MRT',3),(418,'80.00','FOT','KOR',1),(419,'40.00','FOT','KOR',2),(420,'20.00','FOT','KOR',3),(421,'80.00','FOT','EYA',1),(422,'40.00','FOT','EYA',2),(423,'25.00','FOT','EYA',3),(424,'100.00','FOT','PND',1),(425,'50.00','FOT','PND',2),(426,'25.00','FOT','PND',3),(427,'100.00','FOT','PIN',1),(428,'50.00','FOT','PIN',2),(429,'25.00','FOT','PIN',3),(430,'120.00','FOT','WDA',1),(431,'60.00','FOT','WDA',2),(432,'30.00','FOT','WDA',3),(433,'140.00','FOT','KTN',1),(434,'70.00','FOT','KTN',2),(435,'40.00','FOT','KTN',3),(436,'140.00','FOT','KTS',1),(437,'80.00','FOT','KTS',2),(438,'40.00','FOT','KTS',3),(439,'160.00','FOT','KKD',1),(440,'80.00','FOT','KKD',2),(441,'45.00','FOT','KKD',3),(442,'160.00','FOT','PGN',1),(443,'90.00','FOT','PGN',2),(444,'45.00','FOT','PGN',3),(445,'160.00','FOT','PGS',1),(446,'90.00','FOT','PGS',2),(447,'50.00','FOT','PGS',3),(448,'160.00','FOT','MGN',1),(449,'90.00','FOT','MGN',2),(450,'50.00','FOT','MGN',3),(451,'180.00','FOT','BRL',1),(452,'100.00','FOT','BRL',2),(453,'55.00','FOT','BRL',3),(454,'180.00','FOT','HML',1),(455,'100.00','FOT','HML',2),(456,'55.00','FOT','HML',3),(457,'200.00','FOT','ALT',1),(458,'110.00','FOT','ALT',2),(459,'55.00','FOT','ALT',3),(460,'200.00','FOT','BNT',1),(461,'110.00','FOT','BNT',2),(462,'60.00','FOT','BNT',3),(463,'200.00','FOT','IDA',1),(464,'110.00','FOT','IDA',2),(465,'60.00','FOT','IDA',3),(466,'220.00','FOT','MWA',1),(467,'120.00','FOT','MWA',2),(468,'65.00','FOT','MWA',3),(469,'220.00','FOT','KDA',1),(470,'120.00','FOT','KDA',2),(471,'65.00','FOT','KDA',3),(472,'220.00','FOT','PYA',1),(473,'120.00','FOT','PYA',2),(474,'70.00','FOT','PYA',3),(475,'240.00','FOT','AUH',1),(476,'130.00','FOT','AUH',2),(477,'70.00','FOT','AUH',3),(478,'240.00','FOT','PGD',1),(479,'130.00','FOT','PGD',2),(480,'70.00','FOT','PGD',3),(481,'240.00','FOT','BPA',1),(482,'130.00','FOT','BPA',2),(483,'75.00','FOT','BPA',3),(484,'240.00','FOT','AND',1),(485,'140.00','FOT','AND',2),(486,'75.00','FOT','AND',3),(487,'260.00','FOT','KGD',1),(488,'140.00','FOT','KGD',2),(489,'75.00','FOT','KGD',3),(490,'260.00','FOT','ABA',1),(491,'140.00','FOT','ABA',2),(492,'75.00','FOT','ABA',3),(493,'260.00','FOT','MPA',1),(494,'140.00','FOT','MPA',2),(495,'80.00','FOT','MPA',3),(496,'280.00','FOT','AKU',1),(497,'150.00','FOT','AKU',2),(498,'80.00','FOT','AKU',3),(499,'280.00','FOT','KWE',1),(500,'160.00','FOT','KWE',2),(501,'80.00','FOT','KWE',3),(502,'280.00','FOT','TWT',1),(503,'160.00','FOT','TWT',2),(504,'85.00','FOT','TWT',3),(505,'280.00','FOT','SMA',1),(506,'160.00','FOT','SMA',2),(507,'85.00','FOT','SMA',3),(508,'300.00','FOT','HKD',1),(509,'160.00','FOT','HKD',2),(510,'85.00','FOT','HKD',3),(511,'300.00','FOT','TNA',1),(512,'160.00','FOT','TNA',2),(513,'90.00','FOT','TNA',3),(514,'300.00','FOT','KMK',1),(515,'170.00','FOT','KMK',2),(516,'90.00','FOT','KMK',3),(517,'300.00','FOT','DNA',1),(518,'170.00','FOT','DNA',2),(519,'90.00','FOT','DNA',3),(520,'320.00','FOT','RTG',1),(521,'170.00','FOT','RTG',2),(522,'95.00','FOT','RTG',3),(523,'320.00','FOT','BSH',1),(524,'170.00','FOT','BSH',2),(525,'95.00','FOT','BSH',3),(526,'320.00','FOT','GNT',1),(527,'180.00','FOT','GNT',2),(528,'95.00','FOT','GNT',3),(529,'320.00','FOT','PGM',1),(530,'180.00','FOT','PGM',2),(531,'100.00','FOT','PGM',3),(532,'320.00','FOT','RCH',1),(533,'180.00','FOT','RCH',2),(534,'100.00','FOT','RCH',3),(535,'340.00','FOT','GLE',1),(536,'180.00','FOT','GLE',2),(537,'100.00','FOT','GLE',3),(538,'340.00','FOT','KUG',1),(539,'105.00','FOT','KUG',3),(540,'340.00','FOT','UNW',1),(541,'190.00','FOT','KUG',2),(542,'190.00','FOT','UNW',2),(543,'105.00','FOT','UNW',3),(544,'380.00','FOT','TLP',1),(545,'200.00','FOT','TLP',2),(546,'105.00','FOT','TLP',3),(547,'380.00','FOT','HBD',1),(548,'200.00','FOT','HBD',2),(549,'110.00','FOT','HBD',3),(550,'380.00','FOT','KOG',1),(551,'200.00','FOT','KOG',2),(552,'110.00','FOT','KOG',3),(553,'380.00','FOT','KTL',1),(554,'200.00','FOT','KTL',2),(555,'110.00','FOT','KTL',3),(556,'380.00','FOT','ANM',1),(557,'210.00','FOT','ANM',2),(558,'115.00','FOT','ANM',3),(559,'380.00','FOT','MED',1),(560,'210.00','FOT','MED',2),(561,'115.00','FOT','MED',3),(562,'380.00','FOT','KMB',1),(563,'210.00','FOT','KMB',2),(564,'115.00','FOT','KMB',3),(565,'420.00','FOT','WLG',1),(566,'230.00','FOT','WLG',2),(567,'130.00','FOT','WLG',3),(568,'400.00','FOT','PLR',1),(569,'220.00','FOT','PLR',2),(570,'120.00','FOT','PLR',3),(571,'400.00','FOT','MIS',1),(572,'220.00','FOT','MIS',2),(573,'120.00','FOT','MIS',3),(574,'420.00','FOT','KMG',1),(575,'230.00','FOT','KMG',2),(576,'125.00','FOT','KMG',3),(577,'400.00','FOT','WLM',1),(578,'220.00','FOT','WLM',2),(579,'120.00','FOT','WLM',3),(580,'420.00','FOT','MTR',1),(581,'230.00','FOT','MTR',2),(582,'130.00','FOT','MTR',3),(583,'420.00','FOT','PLD',1),(584,'240.00','FOT','PLD',2),(585,'130.00','FOT','PLD',3);

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

insert  into `topup_agent`(`agent_reg_date_time`,`topup_agent_status_id`,`topup_agent_regfee_id`,`employee_nic`,`topup_agent_id`,`station_code`) values ('2017-03-25 21:13:22',1,2,'789548632v','T0001','FOT');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

insert  into `train`(`train_id`,`train_name`,`train_type_type_id`) values (3,'','INC'),(7,'','EXP'),(9,'','INC'),(15,'','EXP'),(19,'','EXP'),(21,'','INC'),(23,'','EXP'),(29,'','INC'),(31,'','INC'),(35,'','EXP'),(109,'','SEMI'),(124,'','EXP'),(125,'','SLOW'),(129,'','EXP'),(131,'','EXP'),(132,'','SLOW'),(133,'','SEMI'),(135,'','SLOW'),(136,'','SLOW'),(140,'Podimanike','INC'),(141,'','SLOW'),(143,'','SLOW'),(144,'','SLOW'),(147,'','SLOW'),(150,'','SLOW'),(151,'','SLOW'),(152,'','SEMI'),(154,'','SLOW'),(158,'','SLOW'),(162,'','SLOW'),(163,'','SLOW'),(164,'','SEMI'),(169,'','SEMI'),(170,'','SLOW'),(171,'','SLOW'),(172,'','EXP'),(302,'Yaldevi','INC'),(309,'','SLOW'),(310,'','SEMI'),(313,'','SLOW'),(356,'','EXP'),(518,'','SEMI'),(536,'','SLOW'),(648,'','SLOW'),(1005,'','EXP'),(4017,'','INC'),(4077,'','EXP'),(4085,'','EXP'),(4093,'','EXP'),(4458,'','SEMI'),(5452,'','EXP'),(6011,'','EXP');

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
