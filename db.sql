DROP TABLE IF EXISTS `applicant_details`; 
CREATE TABLE `applicant_details` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `email_address` VARCHAR(50) NOT NULL,
    `phone_number` VARCHAR(10) NOT NULL,
    `submitted_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS `application_type`;
CREATE TABLE `application_type` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(50) NOT NULL,
    `amount` DECIMAL(6,2) NOT NULL
);
INSERT INTO `application_type`(`title`, `amount`) VALUES
('Degree', 150), ('Diploma', 120), ('Masters', 280);

DROP TABLE IF EXISTS `applicant_application_type`;
CREATE TABLE `applicant_application_type` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `applicant_id` INT NOT NULL,
    `app_type_id` INT NOT NULL,
    CONSTRAINT `fk_applicant` FOREIGN KEY (`applicant_id`) REFERENCES `applicant_details`(`id`) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `fk_app_type` FOREIGN KEY (`app_type_id`) REFERENCES `application_type`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS `applicant_verification`;
CREATE TABLE `applicant_verification` (
    `id` INT(11) AUTO_INCREMENT PRIMARY KEY,
    `code` VARCHAR(6) NOT NULL,
    `status` TINYINT DEFAULT 0,
    `applicant_id` INT NOT NULL,
    CONSTRAINT `fk_verify_app` FOREIGN KEY (`applicant_id`) REFERENCES `applicant_details`(`id`) ON UPDATE CASCADE ON DELETE CASCADE
);