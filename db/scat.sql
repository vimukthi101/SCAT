-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema scat
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `scat` ;

-- -----------------------------------------------------
-- Schema scat
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `scat` DEFAULT CHARACTER SET utf8 ;
USE `scat` ;

-- -----------------------------------------------------
-- Table `scat`.`name`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scat`.`name` ;

CREATE TABLE IF NOT EXISTS `scat`.`name` (
  `name_id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(20) NOT NULL,
  `second_name` VARCHAR(20) NULL,
  `last_name` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`name_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scat`.`address`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scat`.`address` ;

CREATE TABLE IF NOT EXISTS `scat`.`address` (
  `address_id` INT NOT NULL AUTO_INCREMENT,
  `address_no` VARCHAR(10) NOT NULL,
  `address_lane` VARCHAR(40) NOT NULL,
  `address_city` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`address_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scat`.`employee`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scat`.`employee` ;

CREATE TABLE IF NOT EXISTS `scat`.`employee` (
  `contact_no` VARCHAR(10) NULL,
  `nic` VARCHAR(10) NOT NULL,
  `address_id` INT NOT NULL,
  `name_id` INT NOT NULL,
  `password` VARCHAR(32) NOT NULL,
  `previous_password` VARCHAR(32) NOT NULL,
  `status` INT NOT NULL DEFAULT 1,
  `login_attempt` INT NOT NULL DEFAULT 0,
  `internal` INT NOT NULL DEFAULT 0,
  `employee_email` VARCHAR(100) NOT NULL,
  UNIQUE INDEX `nic_UNIQUE` (`nic` ASC),
  INDEX `fk_employee_address1_idx` (`address_id` ASC),
  INDEX `fk_employee_name1_idx` (`name_id` ASC),
  PRIMARY KEY (`nic`),
  CONSTRAINT `fk_employee_address1`
    FOREIGN KEY (`address_id`)
    REFERENCES `scat`.`address` (`address_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_employee_name1`
    FOREIGN KEY (`name_id`)
    REFERENCES `scat`.`name` (`name_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scat`.`station`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scat`.`station` ;

CREATE TABLE IF NOT EXISTS `scat`.`station` (
  `station_code` VARCHAR(10) NOT NULL,
  `station_name` VARCHAR(45) NOT NULL,
  `station_card_id` INT NOT NULL,
  `employee_nic` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`station_code`),
  INDEX `fk_station_employee1_idx` (`employee_nic` ASC),
  CONSTRAINT `fk_station_employee1`
    FOREIGN KEY (`employee_nic`)
    REFERENCES `scat`.`employee` (`nic`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scat`.`card`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scat`.`card` ;

CREATE TABLE IF NOT EXISTS `scat`.`card` (
  `card_no` VARCHAR(16) NOT NULL,
  `pin` INT(4) NOT NULL,
  `station_station_code` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`card_no`),
  INDEX `fk_card_station1_idx` (`station_station_code` ASC),
  CONSTRAINT `fk_card_station1`
    FOREIGN KEY (`station_station_code`)
    REFERENCES `scat`.`station` (`station_code`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scat`.`commuter`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scat`.`commuter` ;

CREATE TABLE IF NOT EXISTS `scat`.`commuter` (
  `nic` VARCHAR(10) NOT NULL,
  `contact_no` VARCHAR(10) NULL,
  `registered_date_time` DATETIME NOT NULL,
  `status` INT NOT NULL,
  `credit` DECIMAL(7,2) NOT NULL DEFAULT 0.00,
  `address_address_id` INT NOT NULL,
  `card_card_no` VARCHAR(16) NOT NULL,
  `name_name_id` INT NOT NULL,
  PRIMARY KEY (`nic`),
  INDEX `fk_commuter_address1_idx` (`address_address_id` ASC),
  INDEX `fk_commuter_card1_idx` (`card_card_no` ASC),
  INDEX `fk_commuter_name1_idx` (`name_name_id` ASC),
  CONSTRAINT `fk_commuter_address1`
    FOREIGN KEY (`address_address_id`)
    REFERENCES `scat`.`address` (`address_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_commuter_card1`
    FOREIGN KEY (`card_card_no`)
    REFERENCES `scat`.`card` (`card_no`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_commuter_name1`
    FOREIGN KEY (`name_name_id`)
    REFERENCES `scat`.`name` (`name_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scat`.`topup_agent_status`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scat`.`topup_agent_status` ;

CREATE TABLE IF NOT EXISTS `scat`.`topup_agent_status` (
  `topup_agent_status_id` INT NOT NULL AUTO_INCREMENT,
  `topup_agent_status` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`topup_agent_status_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scat`.`topup_agent_regfee`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scat`.`topup_agent_regfee` ;

CREATE TABLE IF NOT EXISTS `scat`.`topup_agent_regfee` (
  `topup_agent_regfee_id` INT NOT NULL AUTO_INCREMENT,
  `topup_agent_regfee` DECIMAL(7,2) NOT NULL,
  PRIMARY KEY (`topup_agent_regfee_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scat`.`topup_agent`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scat`.`topup_agent` ;

CREATE TABLE IF NOT EXISTS `scat`.`topup_agent` (
  `agent_reg_date_time` DATETIME NOT NULL,
  `topup_agent_status_id` INT NOT NULL,
  `topup_agent_regfee_id` INT NOT NULL,
  `employee_nic` VARCHAR(10) NOT NULL,
  `topup_agent_id` VARCHAR(45) NOT NULL,
  INDEX `fk_topup_agent_topup_agent_status1_idx` (`topup_agent_status_id` ASC),
  INDEX `fk_topup_agent_topup_agent_regfee1_idx` (`topup_agent_regfee_id` ASC),
  INDEX `fk_topup_agent_employee1_idx` (`employee_nic` ASC),
  PRIMARY KEY (`topup_agent_id`),
  CONSTRAINT `fk_topup_agent_topup_agent_status1`
    FOREIGN KEY (`topup_agent_status_id`)
    REFERENCES `scat`.`topup_agent_status` (`topup_agent_status_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_topup_agent_topup_agent_regfee1`
    FOREIGN KEY (`topup_agent_regfee_id`)
    REFERENCES `scat`.`topup_agent_regfee` (`topup_agent_regfee_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_topup_agent_employee1`
    FOREIGN KEY (`employee_nic`)
    REFERENCES `scat`.`employee` (`nic`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scat`.`train_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scat`.`train_type` ;

CREATE TABLE IF NOT EXISTS `scat`.`train_type` (
  `type_id` INT NOT NULL AUTO_INCREMENT,
  `type_name` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`type_id`),
  UNIQUE INDEX `type_name_UNIQUE` (`type_name` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scat`.`train`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scat`.`train` ;

CREATE TABLE IF NOT EXISTS `scat`.`train` (
  `train_id` INT NOT NULL,
  `train_name` VARCHAR(20) NULL,
  `train_type_type_id` INT NOT NULL,
  PRIMARY KEY (`train_id`),
  INDEX `fk_train_train_type1_idx` (`train_type_type_id` ASC),
  CONSTRAINT `fk_train_train_type1`
    FOREIGN KEY (`train_type_type_id`)
    REFERENCES `scat`.`train_type` (`type_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scat`.`ticket`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scat`.`ticket` ;

CREATE TABLE IF NOT EXISTS `scat`.`ticket` (
  `ticket_id` INT NOT NULL AUTO_INCREMENT,
  `ticket_fee` DECIMAL(6,2) NOT NULL,
  `station_in_station_code` VARCHAR(10) NOT NULL,
  `station_out_station_code` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`ticket_id`),
  INDEX `fk_ticket_station1_idx` (`station_in_station_code` ASC),
  INDEX `fk_ticket_station2_idx` (`station_out_station_code` ASC),
  CONSTRAINT `fk_ticket_station1`
    FOREIGN KEY (`station_in_station_code`)
    REFERENCES `scat`.`station` (`station_code`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ticket_station2`
    FOREIGN KEY (`station_out_station_code`)
    REFERENCES `scat`.`station` (`station_code`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scat`.`payment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scat`.`payment` ;

CREATE TABLE IF NOT EXISTS `scat`.`payment` (
  `payment_id` INT NOT NULL AUTO_INCREMENT,
  `ticket_id` INT NOT NULL,
  `payment_date_time` DATETIME NOT NULL,
  `no_of_tickets` INT NOT NULL,
  `commuter_nic` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`payment_id`),
  INDEX `ticket_id_idx` (`ticket_id` ASC),
  INDEX `fk_payment_commuter1_idx` (`commuter_nic` ASC),
  CONSTRAINT `ticket_id`
    FOREIGN KEY (`ticket_id`)
    REFERENCES `scat`.`ticket` (`ticket_id`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_payment_commuter1`
    FOREIGN KEY (`commuter_nic`)
    REFERENCES `scat`.`commuter` (`nic`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scat`.`recharge`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scat`.`recharge` ;

CREATE TABLE IF NOT EXISTS `scat`.`recharge` (
  `topup_id` INT NOT NULL AUTO_INCREMENT,
  `recharge_date_time` DATETIME NOT NULL,
  `amount` DECIMAL(7,2) NOT NULL,
  `card_card_no` VARCHAR(16) NOT NULL,
  `employee_nic` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`topup_id`),
  INDEX `fk_recharge_card1_idx` (`card_card_no` ASC),
  INDEX `fk_recharge_employee1_idx` (`employee_nic` ASC),
  CONSTRAINT `fk_recharge_card1`
    FOREIGN KEY (`card_card_no`)
    REFERENCES `scat`.`card` (`card_no`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_recharge_employee1`
    FOREIGN KEY (`employee_nic`)
    REFERENCES `scat`.`employee` (`nic`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scat`.`card_request_status`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scat`.`card_request_status` ;

CREATE TABLE IF NOT EXISTS `scat`.`card_request_status` (
  `status_id` INT NOT NULL AUTO_INCREMENT,
  `status_type` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`status_id`),
  UNIQUE INDEX `status_type_UNIQUE` (`status_type` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scat`.`card_request`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scat`.`card_request` ;

CREATE TABLE IF NOT EXISTS `scat`.`card_request` (
  `request_id` INT NOT NULL AUTO_INCREMENT,
  `no_of_cards_requested` INT NOT NULL,
  `no_of_cards_sent` INT NOT NULL,
  `station_station_code` VARCHAR(10) NOT NULL,
  `card_request_status_status_id` INT NOT NULL,
  PRIMARY KEY (`request_id`),
  INDEX `fk_card_request_station1_idx` (`station_station_code` ASC),
  INDEX `fk_card_request_card_request_status1_idx` (`card_request_status_status_id` ASC),
  CONSTRAINT `fk_card_request_station1`
    FOREIGN KEY (`station_station_code`)
    REFERENCES `scat`.`station` (`station_code`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_card_request_card_request_status1`
    FOREIGN KEY (`card_request_status_status_id`)
    REFERENCES `scat`.`card_request_status` (`status_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scat`.`employee_position`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scat`.`employee_position` ;

CREATE TABLE IF NOT EXISTS `scat`.`employee_position` (
  `position_id` INT NOT NULL AUTO_INCREMENT,
  `position` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`position_id`),
  UNIQUE INDEX `position_UNIQUE` (`position` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scat`.`timetable`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scat`.`timetable` ;

CREATE TABLE IF NOT EXISTS `scat`.`timetable` (
  `timetable_id` INT NOT NULL AUTO_INCREMENT,
  `train_time` DATETIME NOT NULL,
  `train_train_id` INT NOT NULL,
  `employee_nic` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`timetable_id`),
  INDEX `fk_timetable_train1_idx` (`train_train_id` ASC),
  INDEX `fk_timetable_employee1_idx` (`employee_nic` ASC),
  CONSTRAINT `fk_timetable_train1`
    FOREIGN KEY (`train_train_id`)
    REFERENCES `scat`.`train` (`train_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_timetable_employee1`
    FOREIGN KEY (`employee_nic`)
    REFERENCES `scat`.`employee` (`nic`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scat`.`topup_agent_payment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scat`.`topup_agent_payment` ;

CREATE TABLE IF NOT EXISTS `scat`.`topup_agent_payment` (
  `topup_agent_payment_fee` DECIMAL(7,2) NOT NULL,
  `topup_agent_payment_status` INT NOT NULL,
  `employee_nic` VARCHAR(10) NOT NULL,
  `topup_agent_payment_date` DATETIME NOT NULL,
  `topup_agent_payment_id` INT NOT NULL AUTO_INCREMENT,
  INDEX `fk_topup_agent_payment_employee1_idx` (`employee_nic` ASC),
  PRIMARY KEY (`topup_agent_payment_id`),
  CONSTRAINT `fk_topup_agent_payment_employee1`
    FOREIGN KEY (`employee_nic`)
    REFERENCES `scat`.`employee` (`nic`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scat`.`staff`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scat`.`staff` ;

CREATE TABLE IF NOT EXISTS `scat`.`staff` (
  `employee_id` VARCHAR(10) NOT NULL,
  `employee_position_position_id` INT NOT NULL,
  `employee_nic` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`employee_id`),
  INDEX `fk_staff_employee_position1_idx` (`employee_position_position_id` ASC),
  INDEX `fk_staff_employee1_idx` (`employee_nic` ASC),
  CONSTRAINT `fk_staff_employee_position1`
    FOREIGN KEY (`employee_position_position_id`)
    REFERENCES `scat`.`employee_position` (`position_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_staff_employee1`
    FOREIGN KEY (`employee_nic`)
    REFERENCES `scat`.`employee` (`nic`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
