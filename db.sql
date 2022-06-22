
DROP TABLE IF EXISTS `applicant_application_type`;
DROP TABLE IF EXISTS `applicant_verification`;

DROP TABLE IF EXISTS `applicant_details`; 
CREATE TABLE `applicant_details` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `email_address` VARCHAR(50) UNIQUE NOT NULL,
    `phone_number` VARCHAR(10) NOT NULL,
    `submitted_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS `application_type`;
CREATE TABLE `application_type` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(50) NOT NULL,
    `amount` DECIMAL(6,2) NOT NULL
);
INSERT INTO `application_type`(`title`, `amount`) VALUES ("Masters", 250), ("Degree/diploma", 180), ("Short courses", 150);

DROP TABLE IF EXISTS `verifiy_phone_number`;
CREATE TABLE `verifiy_phone_number` (
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

DROP TABLE IF EXISTS `program_types`;
CREATE TABLE `program_types` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `added_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS `programs`;
CREATE TABLE `programs` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `added_at` DATETIME DEFAULT CURRENT_TIMESTAMP
    `prog_type_id` INT NOT NULL,
    CONSTRAINT `fk_prog_type_id` FOREIGN KEY (`prog_type_id`) REFERENCES `program_types`(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
);

DROP TABLE IF EXISTS `applicants_login`;
CREATE TABLE `applicants_login` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `app_number` VARCHAR(255) NOT NULL,
    `pin` VARCHAR(6) NOT NULL,
    `type` VARCHAR(6) NOT NULL, -- 
    `added_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `applicant_id` INT NOT NULL,
    `prog_type_id` INT NOT NULL,
    CONSTRAINT `fk_applicant_login` FOREIGN KEY (`applicant_id`) REFERENCES `applicant_details`(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_prog_type_id` FOREIGN KEY (`prog_type_id`) REFERENCES `applicant_details`(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
);




