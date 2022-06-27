/*
Tables for form purchase
*/
DROP TABLE IF EXISTS `form_type`;
CREATE TABLE `form_type` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL,
    `amount` DECIMAL(6,2) NOT NULL
);
INSERT INTO `form_type`(`name`, `amount`) VALUES ("Masters", 250), ("Degree/diploma", 180), ("Short courses", 120);

DROP TABLE IF EXISTS `payment_method`;
CREATE TABLE `payment_method` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL
);
INSERT INTO `payment_method`(`name`) VALUES ("Credit Card"), ("Mobile Money"), ("Direct Deposit");

DROP TABLE IF EXISTS `verify_phone_number`;
CREATE TABLE `verify_phone_number` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `phone_number` VARCHAR(16) NOT NULL,
    `code` VARCHAR(6) NOT NULL,
    `submitted_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS `verify_email_address`;
CREATE TABLE `verify_email_address` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `email_address` VARCHAR(255) NOT NULL,
    `code` VARCHAR(6) NOT NULL,
    `submitted_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS `purchase_detail`; 
CREATE TABLE `purchase_detail` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `gender` CHAR(1) NOT NULL,
    `dob` DATE NOT NULL,
    `country` VARCHAR(50) NOT NULL,
    `email_address` VARCHAR(255) NOT NULL,
    `phone_number` VARCHAR(10) NOT NULL,
    `form_type` INT NOT NULL,
    `payment_method` INT NOT NULL,
    `submitted_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_form_type` FOREIGN KEY (`form_type`) REFERENCES `form_type`(`id`) ON UPDATE CASCADE,
    CONSTRAINT `fk_payment_method` FOREIGN KEY (`payment_method`) REFERENCES `payment_method`(`id`) ON UPDATE CASCADE
);

DROP TABLE IF EXISTS `applicants_login`;
CREATE TABLE `applicants_login` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `app_number` VARCHAR(50) UNIQUE NOT NULL,
    `pin` VARCHAR(6) NOT NULL,
    `added_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `purchase_detail` INT NOT NULL,
    CONSTRAINT `fk_purchase_detail` FOREIGN KEY (`purchase_detail`) REFERENCES `purchase_detail`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);

/*
Tables for applicants form registration
*/
DROP TABLE IF EXISTS `programs`;
CREATE TABLE `programs` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `type` INT NOT NULL,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `added_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_prog_form_type` FOREIGN KEY (`type`) REFERENCES `form_type`(`id`) ON UPDATE CASCADE
);
INSERT INTO `programs`(`type`, `name`) 
VALUES (2, 'BSc. Computer Science'), (2, 'BSc. Electrical Engineering'), (2, 'BSc. Marine Engineering'),
(2, 'Diploma Computer Engineering'), (2, 'Diploma Electrical Engineering'), (2, 'Diploma Marine Engineering'),
(1, 'MSc. Environmental Engineering'), (1, 'MA. Ports and Shipping Administration'), 
(3, 'Marine Engine Mechanic'), (3, 'Marine Refrigeration Mechanic');

DROP TABLE IF EXISTS `halls`;
CREATE TABLE `halls` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `added_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO `halls`(`name`) VALUES ('Cadet Hostel'), ('Non-cadet Hostel');




