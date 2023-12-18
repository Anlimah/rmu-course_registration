-- -----------------------------------------------------
-- Schema rmu_student_mgt_db // youtube.com: wordoftruthministry, brian bolt
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `rmu_student_mgt_db` DEFAULT CHARACTER SET utf8 ;
USE `rmu_student_mgt_db` ;

-- -----------------------------------------------------
-- Table `rmu_student_mgt_db`.`academic_years`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rmu_student_mgt_db`.`academic_years` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `start_year` YEAR NOT NULL, 
  `end_year` YEAR NOT NULL,
  `name` VARCHAR(15) GENERATED ALWAYS AS (CONCAT(`start_year`, '-', `end_year`)) VIRTUAL,
  PRIMARY KEY (`id`)
);
CREATE INDEX academic_years_name_idx ON `rmu_student_mgt_db`.`academic_years` (`name`);
CREATE INDEX academic_years_start_year_idx ON `rmu_student_mgt_db`.`academic_years` (`start_year`);
CREATE INDEX academic_years_end_year_idx ON `rmu_student_mgt_db`.`academic_years` (`end_year`);

INSERT INTO `rmu_student_mgt_db`.`academic_years` (`start_year`, `end_year`) VALUES ('2023', '2024');

-- -----------------------------------------------------
-- Table `rmu_student_mgt_db`.`semesters`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rmu_student_mgt_db`.`semesters` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) NOT NULL UNIQUE,
  PRIMARY KEY (`id`)
);
CREATE INDEX semesters_name_idx ON `rmu_student_mgt_db`.`semesters` (`name`);
INSERT INTO `rmu_student_mgt_db`.`semesters` (`name`) VALUES ('SEMESTER 1', 'SEMESTER 2');

-- -----------------------------------------------------
-- Table `rmu_student_mgt_db`.`departments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rmu_student_mgt_db`.`departments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL UNIQUE,
  PRIMARY KEY (`id`)
);
CREATE INDEX departments_name_idx1 ON `rmu_student_mgt_db`.`departments` (`name`);

-- -----------------------------------------------------
-- Table `rmu_student_mgt_db`.`programs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rmu_student_mgt_db`.`programs` (
  `code` VARCHAR(25) NOT NULL UNIQUE,
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL UNIQUE,
  `duration` INT DEFAULT 0,
  `dur_format` VARCHAR(25) DEFAULT 'YEAR',
  `fk_deptID` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_programs_departments1` 
    FOREIGN KEY (`fk_deptID`) REFERENCES `rmu_student_mgt_db`.`departments` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX programs_name_idx1 ON `rmu_student_mgt_db`.`programs` (`name`);
CREATE INDEX programs_code_idx1 ON `rmu_student_mgt_db`.`programs` (`code`);
CREATE INDEX programs_duration_idx1 ON `rmu_student_mgt_db`.`programs` (`duration`);
CREATE INDEX programs_dur_format_idx1 ON `rmu_student_mgt_db`.`programs` (`dur_format`);

-- -----------------------------------------------------
-- Table `rmu_student_mgt_db`.`courses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rmu_student_mgt_db`.`courses` (
  `code` VARCHAR(10) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `credit_hours` INT DEFAULT 0,
  `fk_deptID` INT NOT NULL,
  PRIMARY KEY (`code`),
  CONSTRAINT `fk_courses_departments1` 
    FOREIGN KEY (`fk_deptID`) REFERENCES `rmu_student_mgt_db`.`departments` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX courses_name_idx1 ON `rmu_student_mgt_db`.`courses` (`name`);
CREATE INDEX courses_credit_hours_idx1 ON `rmu_student_mgt_db`.`courses` (`credit_hours`);

-- -----------------------------------------------------
-- Table `rmu_student_mgt_db`.`classes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rmu_student_mgt_db`.`classes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(10) NOT NULL UNIQUE,
  `fk_progID` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_classes_programs1`
    FOREIGN KEY (`fk_progID`) REFERENCES `rmu_student_mgt_db`.`programs` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX classes_name_idx1 ON `rmu_student_mgt_db`.`classes` (`name`);

-- -----------------------------------------------------
-- Table `rmu_student_mgt_db`.`courses_classes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rmu_student_mgt_db`.`courses_classes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fk_courseID` VARCHAR(10) NOT NULL,
  `fk_classID` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_courses_classes_courses1`
    FOREIGN KEY (`fk_courseID`) REFERENCES `rmu_student_mgt_db`.`courses` (`code`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_courses_classes_classes1`
    FOREIGN KEY (`fk_classID`) REFERENCES `rmu_student_mgt_db`.`classes` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table `rmu_student_mgt_db`.`students`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rmu_student_mgt_db`.`students` (
  `index_number` VARCHAR(10) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `phone_number` VARCHAR(15) NOT NULL UNIQUE,
  `first_name` VARCHAR(255) NOT NULL,
  `middle_name` VARCHAR(255),
  `last_name` VARCHAR(255) NOT NULL,
  `gender` VARCHAR(1) DEFAULT 'F',
  `date_admitted` DATE DEFAULT CURRENT_DATE(),
  `term_admitted` VARCHAR(15) DEFAULT 'AUGUST',
  `stream_admitted` VARCHAR(15) DEFAULT 'REGULAR',
  `fk_deptID` INT NOT NULL,
  `fk_progID` INT NOT NULL,
  `fk_classID` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`index_number`),
  CONSTRAINT `fk_students_departments1` 
    FOREIGN KEY (`fk_deptID`) REFERENCES `rmu_student_mgt_db`.`departments` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_programs1` 
    FOREIGN KEY (`fk_progID`) REFERENCES `rmu_student_mgt_db`.`programs` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_classes1` 
    FOREIGN KEY (`fk_classID`) REFERENCES `rmu_student_mgt_db`.`classes` (`name`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX students_email_idx1 ON `rmu_student_mgt_db`.`students` (`email`);
CREATE INDEX students_phone_number_idx1 ON `rmu_student_mgt_db`.`students` (`phone_number`);
CREATE INDEX students_fname_idx1 ON `rmu_student_mgt_db`.`students` (`first_name`);
CREATE INDEX students_lname_idx1 ON `rmu_student_mgt_db`.`students` (`last_name`);
CREATE INDEX students_gender_idx1 ON `rmu_student_mgt_db`.`students` (`gender`);
CREATE INDEX students_date_idx1 ON `rmu_student_mgt_db`.`students` (`date_admitted`);
CREATE INDEX students_term_idx1 ON `rmu_student_mgt_db`.`students` (`term_admitted`);
CREATE INDEX students_stream_idx1 ON `rmu_student_mgt_db`.`students` (`stream_admitted`);

-- -----------------------------------------------------
-- Table `rmu_student_mgt_db`.`students_courses_registered`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rmu_student_mgt_db`.`students_courses_registered` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fk_academic_yearID` INT NOT NULL,
  `fk_semesterID` INT NOT NULL,
  `fk_courseID` VARCHAR(10) NOT NULL,
  `fk_studentID` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_students_courses_registered_academic_years1`
    FOREIGN KEY (`fk_academic_yearID`) REFERENCES `rmu_student_mgt_db`.`academic_years` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_courses_registered_semesters1` 
    FOREIGN KEY (`fk_semesterID`) REFERENCES `rmu_student_mgt_db`.`semesters` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_courses_registered_courses1` 
    FOREIGN KEY (`fk_courseID`) REFERENCES `rmu_student_mgt_db`.`courses` (`code`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_courses_registered_students1` 
    FOREIGN KEY (`fk_studentID`) REFERENCES `rmu_student_mgt_db`.`students` (`index_number`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table `rmu_student_mgt_db`.`staff`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rmu_student_mgt_db`.`staff` (
  `staff_number` VARCHAR(20) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `first_name` VARCHAR(255) NOT NULL,
  `last_name` VARCHAR(255) NOT NULL,
  `gender` VARCHAR(1) DEFAULT 'F',
  `role` VARCHAR(15) NOT NULL,
  `fk_deptID` INT NOT NULL,
  PRIMARY KEY (`staff_number`),
  CONSTRAINT `fk_staff_departments1`
    FOREIGN KEY (`fk_deptID`) REFERENCES `rmu_student_mgt_db`.`departments` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX staff_email_idx1 ON `rmu_student_mgt_db`.`staff` (`email`);
CREATE INDEX staff_fname_idx1 ON `rmu_student_mgt_db`.`staff` (`first_name`);
CREATE INDEX staff_lname_idx1 ON `rmu_student_mgt_db`.`staff` (`last_name`);
CREATE INDEX staff_gender_idx1 ON `rmu_student_mgt_db`.`staff` (`gender`);
CREATE INDEX staff_role_idx1 ON `rmu_student_mgt_db`.`staff` (`role`);

-- -----------------------------------------------------
-- Table `rmu_student_mgt_db`.`lecturers_courses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rmu_student_mgt_db`.`lecturers_courses` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fk_academic_yearID` INT NOT NULL,
  `fk_semesterID` INT NOT NULL,
  `fk_staffID` VARCHAR(20) NOT NULL,
  `fk_courseID` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`),,
  CONSTRAINT `lecturers_courses_academic_years1`
    FOREIGN KEY (`fk_academic_yearID`) REFERENCES `rmu_student_mgt_db`.`academic_years` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `lecturers_courses_semesters1` 
    FOREIGN KEY (`fk_semesterID`) REFERENCES `rmu_student_mgt_db`.`semesters` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lecturers_courses_staff1`
    FOREIGN KEY (`fk_staffID`) REFERENCES `rmu_student_mgt_db`.`staff` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lecturers_courses_courses1`
    FOREIGN KEY (`fk_courseID`) REFERENCES `rmu_student_mgt_db`.`courses` (`code`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table `rmu_student_mgt_db`.`quizzes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rmu_student_mgt_db`.`quizzes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `total_mark` DECIMAL(4,1) NOT NULL,
  `pass_mark` DECIMAL(4,1) NOT NULL,
  `start_datetime` DATETIME NOT NULL,
  `duration` INT NOT NULL,
  `fk_courseID` VARCHAR(10) NOT NULL,
  `fk_staffID` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_quizzes_courses1`
    FOREIGN KEY (`fk_courseID`) REFERENCES `rmu_student_mgt_db`.`courses` (`code`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_quizzes_staff1`
    FOREIGN KEY (`fk_staffID`) REFERENCES `rmu_student_mgt_db`.`staff` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX quizzes_idx1 ON `rmu_student_mgt_db`.`quizzes` (
    `title`, `total_mark`, `pass_mark`, `start_datetime`, `end_datetime`, `duration`
);

-- -----------------------------------------------------
-- Table `rmu_student_mgt_db`.`questions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rmu_student_mgt_db`.`questions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `question` LONGTEXT NOT NULL,
  `marks` INT NOT NULL,
  `type` VARCHAR(25) NOT NULL,
  `fk_courseID` VARCHAR(10) NOT NULL,
  `fk_staffID` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_questions_courses1`
    FOREIGN KEY (`fk_courseID`) REFERENCES `rmu_student_mgt_db`.`courses` (`code`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_questions_staff1`
    FOREIGN KEY (`fk_staffID`) REFERENCES `rmu_student_mgt_db`.`staff` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX questions_idx1 ON `rmu_student_mgt_db`.`questions` (`question`, `marks`, `type`);

-- -----------------------------------------------------
-- Table `rmu_student_mgt_db`.`answers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rmu_student_mgt_db`.`answers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `option` TEXT(500) NOT NULL,
  `right_answer` VARCHAR(255) NULL,
  `fk_questID` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_answers_questions1`
    FOREIGN KEY (`fk_questID`) REFERENCES `rmu_student_mgt_db`.`questions` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX answers_idx1 ON `rmu_student_mgt_db`.`answers` (`option`, `right_answer`);

-- -----------------------------------------------------
-- Table `rmu_student_mgt_db`.`quizzes_questions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rmu_student_mgt_db`.`quizzes_questions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fk_quizID` INT NOT NULL,
  `fk_questID` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_quizzes_questions_quizzes1`
    FOREIGN KEY (`fk_quizID`) REFERENCES `rmu_student_mgt_db`.`quizzes` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_quizzes_questions_questions1`
    FOREIGN KEY (`fk_questID`) REFERENCES `rmu_student_mgt_db`.`questions` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table `rmu_student_mgt_db`.`students_quizzes_responses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rmu_student_mgt_db`.`students_quizzes_responses` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fk_quizID` INT NOT NULL,
  `fk_questID` INT NOT NULL,
  `fk_ansID` INT NOT NULL,
  `fk_studentID` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_students_quizzes_responses_quizzes1`
    FOREIGN KEY (`fk_quizID`) REFERENCES `rmu_student_mgt_db`.`quizzes` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_quizzes_responses_questions1`
    FOREIGN KEY (`fk_questID`) REFERENCES `rmu_student_mgt_db`.`questions` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_quizzes_responses_answers1`
    FOREIGN KEY (`fk_ansID`) REFERENCES `rmu_student_mgt_db`.`answers` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_quizzes_responses_students1`
    FOREIGN KEY (`fk_studentID`) REFERENCES `rmu_student_mgt_db`.`students` (`index_number`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table `rmu_student_mgt_db`.`students_quizzes_stats`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rmu_student_mgt_db`.`students_quizzes_stats` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `total_mark` DECIMAL(4,1) NOT NULL,
  `pass_mark` DECIMAL(4,1) NOT NULL,
  `score_obtained` INT NOT NULL DEFAULT 0,
  `score_percent` DECIMAL(4,1) GENERATED ALWAYS AS ((`score_obtained` / `total_mark`) * 100) VIRTUAL,
  `grade` VARCHAR(2)  GENERATED ALWAYS AS (
    CASE
      WHEN `score_percent` >= 80 THEN 'A+'
      WHEN `score_percent` >= 76 THEN 'A-'
      WHEN `score_percent` >= 70 THEN 'B+'
      WHEN `score_percent` >= 66 THEN 'B'
      WHEN `score_percent` >= 60 THEN 'C'
      WHEN `score_percent` >= 50 THEN 'D'
      WHEN `score_percent` >= 46 THEN 'E'
      WHEN `score_percent` <= 45 THEN 'F'
    END
  ) VIRTUAL,
  `passed` TINYINT(1) GENERATED ALWAYS AS (
    CASE
      WHEN `score_obtained` >= `pass_mark` THEN 1
      WHEN `score_obtained` < `pass_mark` THEN 0
    END
  ) VIRTUAL,
  `fk_quizID` INT NOT NULL,
  `fk_studentID` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_students_quizzes_stats_quizzes1`
    FOREIGN KEY (`fk_quizID`) REFERENCES `rmu_student_mgt_db`.`quizzes` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_quizzes_stats_students1`
    FOREIGN KEY (`fk_studentID`) REFERENCES `rmu_student_mgt_db`.`students` (`index_number`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);