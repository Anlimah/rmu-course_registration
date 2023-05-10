/*
Tables for system users
*/

DROP TABLE IF EXISTS `sys_users_privileges`;
DROP TABLE IF EXISTS `sys_users`;
DROP TABLE IF EXISTS `activity_logs`;

CREATE TABLE `sys_users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_name` VARCHAR(100) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` VARCHAR(20) NOT NULL,
    `added_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP()
);

ALTER TABLE `sys_users` 
ADD COLUMN `first_name` VARCHAR(30) NOT NULL AFTER `id`, 
ADD COLUMN `last_name` VARCHAR(30) NOT NULL AFTER `first_name`;

INSERT INTO `sys_users` (`first_name`, `last_name`, `user_name`, `password`, `role`) VALUES 
('Francis','Anlimah', 'y.m.ratty7@gmail.com', '$2y$10$jmxuunWRqwB2KgT2jIypwufas3dPtqT9f21gdKT9lOOlNGNQCqeMC', 'Developer');

CREATE TABLE `sys_users_privileges` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    CONSTRAINT `fk_sys_users_id` FOREIGN KEY (`user_id`) REFERENCES `sys_users`(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    `select` BOOLEAN NOT NULL DEFAULT 0,
    `insert` BOOLEAN NOT NULL DEFAULT 0,
    `update` BOOLEAN NOT NULL DEFAULT 0,
    `delete` BOOLEAN NOT NULL DEFAULT 0,
    `added_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP()
);

INSERT INTO `sys_users_privileges` (`user_id`, `select`,`insert`,`update`,`delete`) VALUES(1, 1, 1, 1, 1);

CREATE TABLE `activity_logs` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `operation` ENUM('INSERT', 'UPDATE', 'DELETE') NOT NULL,
  `description` TEXT NOT NULL,
  `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  INDEX `user_id` (`user_id`),
  INDEX `operation` (`operation`),
  INDEX `timestamp` (`timestamp`)
);



/*
Tables for form purchase
*/
DROP TABLE IF EXISTS `admission_period`;
CREATE TABLE `admission_period` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `start_date` DATE NOT NULL,
    `end_date` DATE NOT NULL,
    `info` TEXT,
    `active` TINYINT DEFAULT 0,
    `deadline` DATE
);
INSERT INTO `admission_period`(`start_date`,`end_date`, `active`) VALUES('2022-07-01', '2022-10-01', 1);

DROP TABLE IF EXISTS `form_type`;
CREATE TABLE `form_type` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL
    -- `amount` DECIMAL(6,2) NOT NULL -- moved to form_price tbl
);
ALTER TABLE `form_type` ADD COLUMN `alt_name` VARCHAR(15);
INSERT INTO `form_type`(`name`, `alt_name`) VALUES 
("Masters", "Postgraduate"), ("Degree", "Undergraduate"), 
("Diploma", "Undergraduate"), ("Short courses", "short courses");

DROP TABLE IF EXISTS `form_price`;
CREATE TABLE `form_price` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `form_type` INT NOT NULL,
    `admin_period` INT NOT NULL,
    `amount` DECIMAL(6,2) NOT NULL,
    CONSTRAINT `fk_form_price_type` FOREIGN KEY (`form_type`) REFERENCES `form_type`(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_admin_p_f_price` FOREIGN KEY (`admin_period`) REFERENCES `admission_period`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);
ALTER TABLE `form_price` ADD COLUMN `name` VARCHAR(120) AFTER `form_type`;

INSERT INTO `form_price` (`amount`, `form_type`, `admin_period`)  VALUES 
(1, 1, 1), (1, 2, 1), (1, 3, 1), (1, 4, 1);

DROP TABLE IF EXISTS `vendor_details`;
CREATE TABLE `vendor_details` (
    `id` INT(11) PRIMARY KEY,
    `user_id` INT(11) NOT NULL,
    `type` VARCHAR(10) NOT NULL,
    `vendor_name` VARCHAR(50) NOT NULL,
    `tin` VARCHAR(15) NOT NULL,
    `email_address` VARCHAR(100),
    `country_name` VARCHAR(30),
    `country_code` VARCHAR(30) NOT NULL,
    `phone_number` VARCHAR(13) NOT NULL,
    `address` VARCHAR(50),
    `added_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP()
);

ALTER TABLE `vendor_details` 
DROP COLUMN `vendor_name`,
DROP COLUMN `country_code`,
DROP COLUMN `country_name`,
ADD COLUMN `user_id` INT(11),
CHANGE COLUMN `email_address` `company` VARCHAR(30);

INSERT INTO `vendor_details`(`id`, `type`, `tin`, `phone_number`, `company`, `address`, `user_id`) 
VALUES (1665605087, 'ONLINE', 'RMU', '233555351068', 'RMU', 'Nungua', 1);

DROP TABLE IF EXISTS `vendor_login`;
CREATE TABLE `vendor_login` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_name` VARCHAR(255) UNIQUE NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    
    `vendor` INT(11) NOT NULL,
    CONSTRAINT `fk_vendor_login` FOREIGN KEY (`vendor`) REFERENCES `vendor_details`(`id`) ON UPDATE CASCADE ON DELETE CASCADE,

    `added_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP()
);

INSERT INTO `vendor_login`(`vendor`,`user_name`,`password`) VALUES 
(1665605866, 'd8ded753c6fd237dc576c1846382387e7e739337', '$2y$10$jmxuunWRqwB2KgT2jIypwufas3dPtqT9f21gdKT9lOOlNGNQCqeMC'),
(1665605341, 'bc4f6e0e173b58999ff3cd1253cc97c1924ecc2e', '$2y$10$jmxuunWRqwB2KgT2jIypwufas3dPtqT9f21gdKT9lOOlNGNQCqeMC');

DROP TABLE IF EXISTS `purchase_detail`; 
CREATE TABLE `purchase_detail` (
    `id` INT(11) PRIMARY KEY,

    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `email_address` VARCHAR(100),
    `country_name` VARCHAR(30) NOT NULL,
    `country_code` VARCHAR(30) NOT NULL,
    `phone_number` VARCHAR(15) NOT NULL,
    `amount` DECIMAL(6,2) NOT NULL,

    `app_number` VARCHAR(10) NOT NULL,
    `pin_number` VARCHAR(10) NOT NULL,

    `status` VARCHAR(10) DEFAULT 'PENDING', -- added
    `device_info` VARCHAR(200), -- added
    `ip_address` VARCHAR(15), -- added
    `added_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
    
    `vendor` INT(11) NOT NULL, -- added
    `form_type` INT NOT NULL,
    `admission_period` INT(11) NOT NULL, -- added
    `payment_method` VARCHAR(20),

    CONSTRAINT `fk_purchase_vendor_details` FOREIGN KEY (`vendor`) REFERENCES `vendor_details`(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_purchase_form_type` FOREIGN KEY (`form_type`) REFERENCES `form_type`(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_purchase_admission_period` FOREIGN KEY (`admission_period`) REFERENCES `admission_period`(`id`) ON UPDATE CASCADE ON DELETE CASCADE

);

ALTER TABLE `purchase_detail` 
DROP COLUMN IF EXISTS `device_info`,
DROP COLUMN IF EXISTS `ip_address`,
ADD COLUMN IF NOT EXISTS `service_rate` DECIMAL(6,2) DEFAULT 0.0 AFTER `amount`,
ADD COLUMN IF NOT EXISTS `service_charge` DECIMAL(6,2) GENERATED ALWAYS AS (`amount` * `service_rate`) AFTER `service_rate`;

DROP TABLE IF EXISTS `payment_method`; 
CREATE TABLE `payment_method` (
    `id` INT AUTO_INCREMENT UNIQUE,
    `name` VARCHAR(15) PRIMARY KEY
);
INSERT INTO payment_method (`name`) VALUES('MOMO'), ('CARD'), ('CASH');

ALTER TABLE purchase_detail 
ADD CONSTRAINT `fk_purchase_payment_method` FOREIGN KEY (`payment_method`) REFERENCES payment_method (`name`) ON UPDATE CASCADE;
         

DROP TABLE IF EXISTS `applicants_login`;
CREATE TABLE `applicants_login` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `app_number` VARCHAR(255) UNIQUE NOT NULL,
    `pin` VARCHAR(255) NOT NULL,
    `added_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
    
    `purchase_id` INT NOT NULL,
    CONSTRAINT `fk_purchase_id` FOREIGN KEY (`purchase_id`) REFERENCES `purchase_detail`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);

ALTER TABLE `applicants_login` 
ADD COLUMN `deleted` TINYINT(1) DEFAULT 1 AFTER `pin`;
/*
Tables for applicants form registration
*/

DROP TABLE IF EXISTS `programs`;
CREATE TABLE `programs` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `type` INT NOT NULL,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
    CONSTRAINT `fk_prog_form_type` FOREIGN KEY (`type`) REFERENCES `form_type`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);
ALTER TABLE `programs` 
ADD COLUMN `weekend` TINYINT DEFAULT 0 AFTER `type`,
ADD COLUMN `group` CHAR(1) AFTER `weekend`;

INSERT INTO `programs`(`type`, `name`, `weekend`, `group`) VALUES 
-- NB: M -> Masters, A -> Eng programs, B -> Non-eng programs
(1, 'M.SC. RENEWABLE ENERGY (NEW PROGRAMME)', 1, 'M'),
(1, 'M.SC. BIO-PROCESSING', 1, 'M'),
(1, 'M.SC. ENVIRONMENTAL ENGINEERING', 1, 'M'),
(1, 'M.A. PORTS AND SHIPPING ADMINISTRATION', 1, 'M'),

(2, 'B.SC. NAUTICAL SCIENCE', 0, 'A'),
(2, 'B.SC. MARINE ENGINEERING', 0, 'A'),
(2, 'B.SC. MECHANICAL ENGINEERING', 1, 'A'),
(2, 'B.SC. COMPUTER ENGINEERING', 1, 'A'),
(2, 'B.SC. COMPUTER SCIENCE', 1, 'A'),
(2, 'B.SC. ELECTRICAL/ELECTRONIC ENGINEERING', 1, 'A'),
(2, 'B.SC. ACCOUNTING', 0, 'B'),
(2, 'B.SC. INFORMATION TECHNOLOGY', 1, 'B'),
(2, 'B.SC. PORT AND SHIPPING ADMINISTRATION', 1, 'B'),
(2, 'B.SC. LOGISTICS MANAGEMENT', 1, 'B'),

(3, 'DIPLOMA IN BANKING TECHNOLOGY AND ACCOUNTING', 0, 'B'),
(3, 'DIPLOMA IN COMPUTERIZED ACCOUNTING', 0, 'B'),
(3, 'DIPLOMA IN INFORMATION TECHNOLOGY', 0, 'B');

DROP TABLE IF EXISTS `halls`;
CREATE TABLE `halls` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP()
);
INSERT INTO `halls`(`name`) VALUES ('Cadet Hostel'), ('Non-cadet Hostel');

DROP TABLE IF EXISTS `grades`;
CREATE TABLE `grades` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `grade` VARCHAR(2) NOT NULL,
    `type` VARCHAR(15)
);
INSERT INTO `grades`(`grade`, `type`) VALUES 
('A1', 'WASSCE'), ('B2', 'WASSCE'), ('B3', 'WASSCE'), ('C4', 'WASSCE'), ('C5', 'WASSCE'), 
('C6', 'WASSCE'), ('D7', 'WASSCE'), ('E8', 'WASSCE'), ('F9', 'WASSCE'),
('A1', 'NECO'), ('B2', 'NECO'), ('B3', 'NECO'), ('C4', 'NECO'), ('C5', 'NECO'), 
('C6', 'NECO'), ('D7', 'NECO'), ('E8', 'NECO'), ('F9', 'NECO'),
('A', 'SSSCE'), ('B', 'SSSCE'), ('C', 'SSSCE'), ('D', 'SSSCE'), ('E', 'SSSCE'), ('F', 'SSSCE'),
('A', 'GBCE'), ('B', 'GBCE'), ('C', 'GBCE'), ('D', 'GBCE'), ('E', 'GBCE'), ('F', 'GBCE');

DROP TABLE IF EXISTS `high_shcool_courses`;
CREATE TABLE `high_shcool_courses` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `type` VARCHAR(10),
    `course` VARCHAR(25) NOT NULL
);

INSERT INTO `high_shcool_courses`(`type`, `course`) VALUES 
("secondary", "BUSINESS"), 
("secondary", "GENERAL ARTS"), 
("secondary", "GENERAL SCIENCE"), 
("secondary", "HOME ECONOMICS"), 
("secondary", "VISUAL ARTS"), 
("technical", "TECHNICAL");

DROP TABLE IF EXISTS `high_sch_subjects`;
CREATE TABLE `high_sch_subjects` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `type` VARCHAR(10) NOT NULL,
    `subject` VARCHAR(25) NOT NULL
);

INSERT INTO `high_sch_subjects`(`type`, `subject`) VALUES 
("core", "CORE MATHEMATICS"), 
("core", "ENGLISH LANGUAGE"), 
("core", "INTEGRATED SCIENCE"), 
("core", "SOCIAL STUDIES"), 
("secondary", "PRINCIPLE OF COSTING"),
("secondary", "ACCOUNTING"), 
("secondary", "BUSINESS MANAGEMENT"), 
("secondary", "PRINCIPLE OF COSTING"), 
("secondary", "ELECTIVE MATHS"),
("secondary", "LITERATURE IN ENGLISH"), 
("secondary", "GEOGRAPHY"), 
("secondary", "HISTORY"), 
("secondary", "GOVERNMENT"), 
("secondary", "RELIGIOUS STUDIES"),
("secondary", "PHYSICS"), 
("secondary", "CHEMISTRY"), 
("secondary", "BIOLOGY"),
("secondary", "MANAGEMENT IN LIVING"), 
("secondary", "FOOD AND NUTRITION"), 
("secondary", "GENERAL KNOWLEDGE IN ARTS"), 
("secondary", "TEXTILE"),
("secondary","GRAPHIC DESIGN"), 
("secondary", "LITERATURE IN ENGLISH"), 
("secondary", "FRENCH"),
("secondary", "ECONOMICS"), 
("secondary", "BASKETRY"), 
("secondary", "LEATHER WORK"), 
("secondary", "PICTURE MAKING"), 
("secondary", "CERAMICS AND SCULPTURE"),
("technical", 'Building Construction Technology'), 
("technical", 'Carpentry And Joinery'), 
("technical", 'Catering'), 
("technical", 'Electrical Installation Work'), 
("technical", 'Electronics'), 
("technical", 'Fashion And Design'), 
("technical", 'General Textiles'), 
("technical", 'Industrial Mechanics'), 
("technical", 'Mechanical Engineering Craft Practice'), 
("technical", 'Metal Work'), 
("technical", 'Photography'), 
("technical", 'Plumbing Craft'), 
("technical", 'Printing Craft'), 
("technical", 'Welding And Fabrication'), 
("technical", 'Wood Work');

/*Application Data*/

DROP TABLE IF EXISTS `applicant_uploads`;
CREATE TABLE `applicant_uploads` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `type` VARCHAR(25), -- photo, certificate, transcript
    `file_name` VARCHAR(50),
    `app_login` INT NOT NULL,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),
    CONSTRAINT `fk_uploaded_files` FOREIGN KEY (`app_login`) REFERENCES `applicants_login`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);

ALTER TABLE `applicant_uploads` 
ADD COLUMN `edu_code` INT(11) AFTER `type`,
ADD COLUMN `linked_to` INT(11) AFTER `file_name`;

DROP TABLE IF EXISTS `personal_information`;
CREATE TABLE `personal_information` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,

    -- Legal Name
    `prefix` VARCHAR(10),
    `first_name` VARCHAR(100),
    `middle_name` VARCHAR(100),
    `last_name` VARCHAR(100),
    `suffix` VARCHAR(10),

    -- Personal Details
    `gender` VARCHAR(7),
    `dob` DATE,
    `marital_status` VARCHAR(25),
    `nationality` VARCHAR(25),
    `country_res` VARCHAR(25),
    `disability` TINYINT,
    `disability_descript` VARCHAR(25),
    `photo` VARCHAR(25),

    -- Place of birth
    `country_birth` VARCHAR(25),
    `spr_birth` VARCHAR(25),
    `city_birth` VARCHAR(25),

    -- Languages Spoken
    `english_native` TINYINT,
    `other_language` VARCHAR(25),

    -- Address
    `postal_addr` VARCHAR(255),
    `postal_town` VARCHAR(50),
    `postal_spr` VARCHAR(50),
    `postal_country` VARCHAR(50),

    -- Contact
    `phone_no1_code` VARCHAR(5),
    `phone_no1` VARCHAR(13),
    `phone_no2_code` VARCHAR(5),
    `phone_no2` VARCHAR(13),
    `email_addr` VARCHAR(50),
    
    -- Alternate/Parent/Guardian Information

    -- Legal Name
    `p_prefix` VARCHAR(10),
    `p_first_name` VARCHAR(100),
    `p_last_name` VARCHAR(100),
    `p_occupation` VARCHAR(50),
    `p_phone_no_code` VARCHAR(5),
    `p_phone_no` VARCHAR(13),
    `p_email_addr` VARCHAR(50),

    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),

    `app_login` INT NOT NULL,
    CONSTRAINT `fk_app_pf` FOREIGN KEY (`app_login`) REFERENCES `applicants_login`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);

ALTER TABLE `personal_information` ADD COLUMN `speaks_english` TINYINT AFTER `english_native`;

DROP TABLE IF EXISTS `academic_background`;
CREATE TABLE `academic_background` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `s_number` INT(11) UNIQUE NOT NULL,

    -- Certificate info
    `school_name` VARCHAR(100),
    `country` VARCHAR(100),
    `region` VARCHAR(100),
    `city` VARCHAR(100),
    
    `cert_type` VARCHAR(20),
    `index_number` VARCHAR(20),
    `month_started` VARCHAR(3),
    `year_started` VARCHAR(4),
    `month_completed` VARCHAR(3),
    `year_completed` VARCHAR(4),
    
    `course_of_study` VARCHAR(100),
    `awaiting_result` TINYINT DEFAULT 0,

    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),

    `app_login` INT NOT NULL,
    CONSTRAINT `fk_app_aca_bac` FOREIGN KEY (`app_login`) REFERENCES `applicants_login`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);

ALTER TABLE `academic_background` 
ADD COLUMN `other_cert_type` VARCHAR(100) AFTER `cert_type`,
ADD COLUMN `other_course_studied` VARCHAR(100) AFTER `course_of_study`;

DROP TABLE IF EXISTS `high_school_results`;
CREATE TABLE `high_school_results` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `type` VARCHAR(10) DEFAULT 'core',
    `subject` VARCHAR(100) NOT NULL,
    `grade` VARCHAR(2) NOT NULL,
    `acad_back_id` INT NOT NULL, -- Referencing academic background
    CONSTRAINT `fk_grades_aca_bac` FOREIGN KEY (`acad_back_id`) REFERENCES `academic_background`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS `program_info`;
CREATE TABLE `program_info` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,

    -- programs
    `first_prog` VARCHAR(100),
    `second_prog` VARCHAR(100),

    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),

    `app_login` INT NOT NULL,   
    CONSTRAINT `fk_app_prog_info` FOREIGN KEY (`app_login`) REFERENCES `applicants_login`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);

ALTER TABLE `program_info` 
ADD COLUMN `application_term` VARCHAR(15) AFTER `second_prog`, 
ADD COLUMN `study_stream` VARCHAR(15) AFTER `application_term`; 

DROP TABLE IF EXISTS `previous_uni_records`;
CREATE TABLE `previous_uni_records` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `pre_uni_rec` TINYINT DEFAULT 0,   
    `name_of_uni` VARCHAR(150),   
    `program` VARCHAR(150),  

    `month_enrolled` VARCHAR(3),
    `year_enrolled` VARCHAR(4),
    `completed` TINYINT DEFAULT 0,
    `month_completed` VARCHAR(3),
    `year_completed` VARCHAR(4),

    `state` VARCHAR(25),
    `reasons` TEXT,

    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP(),

    `app_login` INT NOT NULL,   
    CONSTRAINT `fk_app_prev_uni` FOREIGN KEY (`app_login`) REFERENCES `applicants_login`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS `form_sections_chek`;
CREATE TABLE `form_sections_chek` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `personal` TINYINT DEFAULT 0,
    `education` TINYINT DEFAULT 0,
    `programme` TINYINT DEFAULT 0,
    `uploads` TINYINT DEFAULT 0,
    `declaration` TINYINT DEFAULT 0,
    `app_login` INT NOT NULL,   
    CONSTRAINT `fk_app_form_sec_check` FOREIGN KEY (`app_login`) REFERENCES `applicants_login`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);

ALTER TABLE `form_sections_chek` 
ADD COLUMN `admitted` TINYINT DEFAULT 0 AFTER `declaration`,
ADD COLUMN `first_prog_qualified` TINYINT AFTER `admitted`,
ADD COLUMN `second_prog_qualified` TINYINT AFTER `first_prog_qualified`;

DROP TABLE IF EXISTS `heard_about_us`;
CREATE TABLE `heard_about_us` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `medium` VARCHAR(50) NOT NULL,
    `description` VARCHAR(50),
    `app_login` INT NOT NULL,   
    CONSTRAINT `fk_heard_abt_us` FOREIGN KEY (`app_login`) REFERENCES `applicants_login`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS `broadsheets`;
CREATE TABLE `broadsheets` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `admin_period` INT NOT NULL,
    CONSTRAINT `fk_admin_broadsheets` FOREIGN KEY (`admin_period`) REFERENCES `admission_period`(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    
    `app_login` INT NOT NULL,
    CONSTRAINT `fk_app_broadsheets` FOREIGN KEY (`app_login`) REFERENCES `applicants_login`(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    
    `program_id` INT NOT NULL,
    CONSTRAINT `fk_program_broadsheets` FOREIGN KEY (`program_id`) REFERENCES `programs`(`id`) ON UPDATE CASCADE ON DELETE CASCADE,

    `required_core_passed` INT NOT NULL,
    `any_one_core_passed` INT NOT NULL,
    `total_core_score` INT NOT NULL,

    `any_three_elective_passed` INT NOT NULL,
    `total_elective_score` INT NOT NULL,

    `total_score` INT NOT NULL,

    `program_choice` VARCHAR(15) NOT NULL
);

/*
    Restructuring DB according to sections in and questions
*/

/* Website Pages */
DROP TABLE IF EXISTS `web_pages`;
CREATE TABLE `web_pages` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    -- `upgid` VARCHAR(255) UNIQUE NOT NULL,
    `page_name` VARCHAR(150) NOT NULL UNIQUE
);
INSERT INTO `web_pages`(`page_name`) VALUES
('Use of Information'),('Personal Information'),('Education Background'),
('Programme Information'),('Uploads'),('Declaration');

/*Page Sections*/
DROP TABLE IF EXISTS `page_sections`;
CREATE TABLE `page_sections` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    -- `ustid` VARCHAR(255) UNIQUE NOT NULL,
    `name` VARCHAR(150) NOT NULL UNIQUE,
    `description` VARCHAR(255),
    `page` INT NOT NULL,   
    CONSTRAINT `fk_page_section` FOREIGN KEY (`page`) REFERENCES `web_pages`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);
INSERT INTO `page_sections`(`name`, `page`) VALUES   
('Legal Name', 1),
('Personal Details', 1),
('Place of Birth', 1),
('Language', 1),
('Address', 1),
('Contact', 1),
('Parent/Guardian', 1),
('Education', 2),
('Programmes', 3),
('Passport Picture', 4),
('Certificates', 4),
('Transcripts', 4);

/*Section Questions*/
DROP TABLE IF EXISTS `section_questions`;
CREATE TABLE `section_questions` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    -- `uqtid` VARCHAR(255) UNIQUE NOT NULL,
    `question` VARCHAR(255) NOT NULL,
    `type` VARCHAR(25) NOT NULL DEFAULT 'text', -- text, dropdown, radio, checkbox, date, etc.
    `place_holder` VARCHAR(25),
    `required` TINYINT DEFAULT 1,
    `section` INT NOT NULL,
    CONSTRAINT `fk_section_question` FOREIGN KEY (`section`) REFERENCES `page_sections`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);
