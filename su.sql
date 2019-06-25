-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema SU
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema SU
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `SU` DEFAULT CHARACTER SET latin1 ;
USE `SU` ;

-- -----------------------------------------------------
-- Table `SU`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SU`.`roles` (
  `role_id` TINYINT(4) NOT NULL,
  `role_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`role_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `SU`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SU`.`users` (
  `user_id` TINYINT(4) NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(60) NOT NULL,
  `name` VARCHAR(60) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `hashed_password` VARCHAR(255) NOT NULL,
  `role` TINYINT(4) NOT NULL,
  `creation_date` DATETIME NULL DEFAULT NULL,
  `last_access` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `users_ibfk_1`
    FOREIGN KEY (`role`)
    REFERENCES `SU`.`roles` (`role_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `SU`.`images`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SU`.`images` (
  `image_id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `add_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` TINYINT(4) NOT NULL,
  `status` ENUM('published', 'not-published') NULL DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  CONSTRAINT `images_ibfk_1`
    FOREIGN KEY (`user_id`)
    REFERENCES `SU`.`users` (`user_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `SU`.`articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SU`.`articles` (
  `article_id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `body` TEXT NULL DEFAULT NULL,
  `creation_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image_id` SMALLINT(6) NULL DEFAULT NULL,
  `admin_id` TINYINT(4) NOT NULL,
  `status` ENUM('published', 'archived', 'new') NULL DEFAULT NULL,
  `last_modified` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`article_id`),
  CONSTRAINT `articles_ibfk_1`
    FOREIGN KEY (`admin_id`)
    REFERENCES `SU`.`users` (`user_id`),
  CONSTRAINT `articles_ibfk_2`
    FOREIGN KEY (`image_id`)
    REFERENCES `SU`.`images` (`image_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `SU`.`contact_form`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SU`.`contact_form` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
  `full_name` VARCHAR(80) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone_number` VARCHAR(20) NOT NULL,
  `message` TINYTEXT NOT NULL,
  `submission_date` DATETIME NOT NULL,
  `flag` ENUM('new', 'viewd', 'to-be-replied', 'replied', 'ignored') NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `SU`.`events`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SU`.`events` (
  `event_id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
  `start_date` DATETIME NOT NULL,
  `end_date` DATETIME NOT NULL,
  `location` VARCHAR(30) NOT NULL,
  `article_id` SMALLINT(6) NULL DEFAULT NULL,
  PRIMARY KEY (`event_id`),
  CONSTRAINT `events_ibfk_1`
    FOREIGN KEY (`article_id`)
    REFERENCES `SU`.`articles` (`article_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `SU`.`types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SU`.`types` (
  `type_id` TINYINT(4) NOT NULL AUTO_INCREMENT,
  `parent` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`type_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `SU`.`menu_items`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SU`.`menu_items` (
  `id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `link` VARCHAR(2083) NOT NULL,
  `admin_id` TINYINT(4) NOT NULL,
  `parent_id` TINYINT(4) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `menu_items_ibfk_1`
    FOREIGN KEY (`parent_id`)
    REFERENCES `SU`.`types` (`type_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `SU`.`pages_titles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SU`.`pages_titles` (
  `page_id` TINYINT(4) NOT NULL,
  `page_title` VARCHAR(60) NULL DEFAULT NULL,
  `page_url` VARCHAR(2100) NULL DEFAULT NULL,
  `user_id` TINYINT(4) NULL DEFAULT NULL,
  `creation_date` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`page_id`),
  CONSTRAINT `pages_titles_ibfk_1`
    FOREIGN KEY (`user_id`)
    REFERENCES `SU`.`users` (`user_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `SU`.`site_info`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SU`.`site_info` (
  `id` TINYINT(4) NOT NULL,
  `site_name` VARCHAR(60) NULL DEFAULT NULL,
  `site_domain` VARCHAR(255) NULL DEFAULT NULL,
  `contact_email` VARCHAR(255) NULL DEFAULT NULL,
  `phone_number` VARCHAR(20) NULL DEFAULT NULL,
  `creation_date` DATETIME NULL DEFAULT NULL,
  `physical_address` VARCHAR(300) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
