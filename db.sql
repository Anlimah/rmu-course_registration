USE `rmu_admissions`;

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
    `code` VARCHAR(255) NOT NULL,
    `submitted_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS `verify_email_address`;
CREATE TABLE `verify_email_address` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `email_address` VARCHAR(255) NOT NULL,
    `code` VARCHAR(255) NOT NULL,
    `submitted_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS `purchase_detail`; 
CREATE TABLE `purchase_detail` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `country` VARCHAR(50) NOT NULL,
    `email_address` VARCHAR(255) NOT NULL,
    `phone_number` VARCHAR(10) NOT NULL,
    `form_type` INT NOT NULL,
    `payment_method` INT NOT NULL,
    `submitted_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_form_type` FOREIGN KEY (`form_type`) REFERENCES `form_type`(`id`) ON UPDATE CASCADE,
    CONSTRAINT `fk_payment_method` FOREIGN KEY (`payment_method`) REFERENCES `payment_method`(`id`) ON UPDATE CASCADE
);

/*DROP TABLE IF EXISTS `payment_log`;
CREATE TABLE `payment_log` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `purchase_detail` INT NOT NULL,
    CONSTRAINT `fk_purchase_detail_log` FOREIGN KEY (`purchase_detail`) REFERENCES `purchase_detail`(`id`) ON UPDATE CASCADE
)*/

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
INSERT INTO `programs`(`type`, `name`) VALUES 
(1, 'MSc. Environmental Engineering'), (1, 'MA. Ports and Shipping Administration'), 
(2, 'BSc. Computer Science'), (2, 'BSc. Electrical Engineering'), (2, 'BSc. Marine Engineering'),
(2, 'Diploma Computer Engineering'), (2, 'Diploma Electrical Engineering'), (2, 'Diploma Marine Engineering'),
(3, 'Marine Engine Mechanic'), (3, 'Marine Refrigeration Mechanic');

DROP TABLE IF EXISTS `halls`;
CREATE TABLE `halls` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `added_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO `halls`(`name`) VALUES ('Cadet Hostel'), ('Non-cadet Hostel');


/*Application Data*/
DROP TABLE IF EXISTS `personal_information`;
CREATE TABLE `personal_information` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,

    -- Legal Name
    `prefix` VARCHAR(10),
    `first_name` VARCHAR(100) NOT NULL,
    `middle_name` VARCHAR(100),
    `last_name` VARCHAR(100) NOT NULL,
    `suffix` VARCHAR(10),

    -- Personal Details
    `gender` VARCHAR(7) NOT NULL,
    `dob` DATE NOT NULL,
    `marital_status` VARCHAR(25) NOT NULL,
    `nationality` VARCHAR(25) NOT NULL,
    `country_res` VARCHAR(25) NOT NULL,
    `disability` VARCHAR(25) NOT NULL,
    `photo` VARCHAR(25) NOT NULL,

    -- Place of birth
    `country_birth` VARCHAR(25) NOT NULL,
    `spr_birth` VARCHAR(25) NOT NULL,
    `city_birth` VARCHAR(25) NOT NULL,

    -- Languages Spoken
    `english_native` TINYINT NOT NULL,
    `other_language` VARCHAR(25),

    -- Address
    `postal_addr` VARCHAR(255) NOT NULL,
    `postal_town` VARCHAR(50) NOT NULL,
    `postal_spr` VARCHAR(50) NOT NULL,
    `postal_country` VARCHAR(50) NOT NULL,

    -- Contact
    `phone_no1` VARCHAR(13) NOT NULL,
    `phone_no2` VARCHAR(13),
    `email_addr` VARCHAR(50) NOT NULL,
    
    -- Alternate/Parent/Guardian Information

    -- Legal Name
    `p_prefix` VARCHAR(10),
    `p_first_name` VARCHAR(100) NOT NULL,
    `p_last_name` VARCHAR(100) NOT NULL,
    `p_occupation` VARCHAR(50),

    -- Contact
    `p_phone_no` VARCHAR(13) NOT NULL,
    `p_email_addr` VARCHAR(50) NOT NULL,

    `app_login` INT NOT NULL,

    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_app_login` FOREIGN KEY (`app_login`) REFERENCES `applicants_login`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS `academic_background`;
CREATE TABLE `academic_background` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `school` VARCHAR(100) NOT NULL,
    `cert_type` VARCHAR(50) NOT NULL,
    `month_completed` VARCHAR(2) NOT NULL,
    `year_completed` VARCHAR(4) NOT NULL,
    `index_number` VARCHAR(50),
    `certificate` VARCHAR(50) NOT NULL,
    `transcript` VARCHAR(50),
    `app_id` INT NOT NULL,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_app_id_acadBack` FOREIGN KEY (`app_id`) REFERENCES `applicants_login`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS `wassce`;
CREATE TABLE `wassce` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `course` VARCHAR(100) NOT NULL,
    `grade` VARCHAR(2) NOT NULL,
    `acad_back_id` INT NOT NULL -- Referencing academic background
);

DROP TABLE IF EXISTS `secondary_school`;
CREATE TABLE `secondary_school` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `school` VARCHAR(100) NOT NULL,
    `completed` DATE NOT NULL,
    `cert_type` VARCHAR(50) NOT NULL,
    `app_id` INT NOT NULL,
    `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_app_id_acadBack` FOREIGN KEY (`app_id`) REFERENCES `applicants_login`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);








