-- -----------------------------------------------------
-- Schema rmu_student_mgt_db // youtube.com: wordoftruthministry, brian bolt
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `rmu_student_mgt_db` DEFAULT CHARACTER SET utf8 ;
USE `rmu_student_mgt_db` ;

-- -----------------------------------------------------
-- Table `academic_years`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `academic_years` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(15) NOT NULL UNIQUE,
  `start_year` YEAR NOT NULL,
  `end_year` YEAR NOT NULL,
  PRIMARY KEY (`id`)
);
CREATE INDEX name_academic_years_idx ON `academic_years` (`name`);
CREATE INDEX start_year_academic_years_idx ON `academic_years` (`start_year`);
CREATE INDEX end_year_academic_years_idx ON `academic_years` (`end_year`);
INSERT INTO `academic_years` (`name`, `start_year`, `end_year`) VALUES ('2023 - 2024', '2023', '2024');

-- -----------------------------------------------------
-- Table `semesters`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `semesters` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) NOT NULL UNIQUE,
  PRIMARY KEY (`id`)
);
CREATE INDEX name_semesters_idx ON `semesters` (`name`);
INSERT INTO `semesters` (`name`) VALUES ('SEMESTER 1'), ('SEMESTER 2');

-- -----------------------------------------------------
-- Table `departments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `departments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL UNIQUE,
  PRIMARY KEY (`id`)
);
CREATE INDEX name_departments_idx1 ON `departments` (`name`);

-- -----------------------------------------------------
-- Table `programs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `programs` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `code` VARCHAR(25) NOT NULL UNIQUE,
  `duration` INT DEFAULT 0,
  `dur_format` VARCHAR(25) DEFAULT 'YEAR',
  `fk_deptID` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_programs_departments1` 
    FOREIGN KEY (`fk_deptID`) REFERENCES `departments` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX name_programs_idx1 ON `programs` (`name`);
CREATE INDEX code_programs_idx1 ON `programs` (`code`);
CREATE INDEX duration_programs_idx1 ON `programs` (`duration`);
CREATE INDEX dur_format_programs_idx1 ON `programs` (`dur_format`);

-- -----------------------------------------------------
-- Table `courses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `courses` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(10) NOT NULL UNIQUE,
  `name` VARCHAR(255) NOT NULL,
  `credit_hours` INT DEFAULT 0,
  `fk_deptID` INT NOT NULL,
  `added_at` 
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_courses_departments1` 
    FOREIGN KEY (`fk_deptID`) REFERENCES `departments` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX code_courses_idx1 ON `courses` (`code`);
CREATE INDEX name_courses_idx1 ON `courses` (`name`);
CREATE INDEX credit_hours_courses_idx1 ON `courses` (`credit_hours`);

-- -----------------------------------------------------
-- Table `classes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `classes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(10) NOT NULL UNIQUE,
  `fk_progID` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_classes_programs1`
    FOREIGN KEY (`fk_progID`) REFERENCES `programs` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX name_classes_idx1 ON `classes` (`name`);

-- -----------------------------------------------------
-- Table `courses_classes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `courses_classes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fk_courseID` INT NOT NULL,
  `fk_classID` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_courses_classes_courses1`
    FOREIGN KEY (`fk_courseID`) REFERENCES `courses` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_courses_classes_classes1`
    FOREIGN KEY (`fk_classID`) REFERENCES `classes` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table `students`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `students` (
  `index_number` VARCHAR(10) NOT NULL,
  `app_number` VARCHAR(10) NOT NULL UNIQUE,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `first_name` VARCHAR(255) NOT NULL,
  `middle_name` VARCHAR(255),
  `last_name` VARCHAR(255) NOT NULL,
  `suffix` VARCHAR(10),
  `gender` VARCHAR(1) DEFAULT 'F',
  `dob` DATE NOT NULL,
  `nationality` VARCHAR(25) NOT NULL,
  `photo` VARCHAR(25) NOT NULL,
  `date_admitted` DATE DEFAULT CURRENT_DATE(),
  `term_admitted` VARCHAR(15) NOT NULL,
  `stream_admitted` VARCHAR(15) NOT NULL,
  `fk_deptID` INT NOT NULL,
  `fk_progID` INT NOT NULL,
  `fk_classID` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`index_number`),
  CONSTRAINT `fk_students_departments1` 
    FOREIGN KEY (`fk_deptID`) REFERENCES `departments` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_programs1` 
    FOREIGN KEY (`fk_progID`) REFERENCES `programs` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_classes1` 
    FOREIGN KEY (`fk_classID`) REFERENCES `classes` (`name`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX app_number_students_idx1 ON `students` (`app_number`);
CREATE INDEX email_students_idx1 ON `students` (`email`);
CREATE INDEX first_name_students_idx1 ON `students` (`first_name`);
CREATE INDEX last_name_students_idx1 ON `students` (`last_name`);
CREATE INDEX gender_students_idx1 ON `students` (`gender`);
CREATE INDEX dob_students_idx1 ON `students` (`dob`);
CREATE INDEX nationality_students_idx1 ON `students` (`nationality`);
CREATE INDEX date_admitted_students_idx1 ON `students` (`date_admitted`);
CREATE INDEX term_admitted_students_idx1 ON `students` (`term_admitted`);
CREATE INDEX stream_admitted_students_idx1 ON `students` (`stream_admitted`);

-- -----------------------------------------------------
-- Table `students_courses_registered`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `students_courses_registered` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fk_academic_yearID` INT NOT NULL,
  `fk_semesterID` INT NOT NULL,
  `fk_courseID` INT NOT NULL,
  `fk_studentID` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_students_courses_registered_academic_years1`
    FOREIGN KEY (`fk_academic_yearID`) REFERENCES `academic_years` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_courses_registered_semesters1` 
    FOREIGN KEY (`fk_semesterID`) REFERENCES `semesters` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_courses_registered_courses1` 
    FOREIGN KEY (`fk_courseID`) REFERENCES `courses` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_courses_registered_students1` 
    FOREIGN KEY (`fk_studentID`) REFERENCES `students` (`index_number`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table `staff`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `staff` (
  `staff_number` VARCHAR(20) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `first_name` VARCHAR(255) NOT NULL,
  `middle_name` VARCHAR(255),
  `last_name` VARCHAR(255) NOT NULL,
  `suffix` VARCHAR(10),
  `gender` VARCHAR(1) DEFAULT 'F',
  `role` VARCHAR(15) NOT NULL,
  `fk_deptID` INT NOT NULL,
  PRIMARY KEY (`staff_number`),
  CONSTRAINT `fk_staff_departments1`
    FOREIGN KEY (`fk_deptID`) REFERENCES `departments` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX staff_idx1 ON `staff` (`staff_number`, `email`, `fname`, `lname`, `role`);

-- -----------------------------------------------------
-- Table `lecturers_courses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `lecturers_courses` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fk_staffID` VARCHAR(20) NOT NULL,
  `fk_courseID` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_lecturers_courses_staff1`
    FOREIGN KEY (`fk_staffID`) REFERENCES `staff` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lecturers_courses_courses1`
    FOREIGN KEY (`fk_courseID`) REFERENCES `courses` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table `quizzes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quizzes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `total_mark` DECIMAL(4,1) NOT NULL,
  `pass_mark` DECIMAL(4,1) NOT NULL,
  `start_datetime` DATETIME NOT NULL,
  `duration` INT NOT NULL,
  `fk_academic_yearID` INT NOT NULL,
  `fk_semesterID` INT NOT NULL,
  `fk_courseID` INT NOT NULL,
  `fk_staffID` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_quizzes_courses_registered_academic_years1`
    FOREIGN KEY (`fk_academic_yearID`) REFERENCES `academic_years` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_quizzes_courses_registered_semesters1` 
    FOREIGN KEY (`fk_semesterID`) REFERENCES `semesters` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_quizzes_courses1`
    FOREIGN KEY (`fk_courseID`) REFERENCES `courses` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_quizzes_staff1`
    FOREIGN KEY (`fk_staffID`) REFERENCES `staff` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX title_quizzes_idx1 ON `quizzes` (`title`);
CREATE INDEX total_mark_quizzes_idx1 ON `quizzes` (`total_mark`);
CREATE INDEX pass_mark_quizzes_idx1 ON `quizzes` (`pass_mark`);
CREATE INDEX start_datetime_quizzes_idx1 ON `quizzes` (`start_datetime`);
CREATE INDEX end_datetime_quizzes_idx1 ON `quizzes` (`end_datetime`);

-- -----------------------------------------------------
-- Table `questions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `questions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `question` LONGTEXT NOT NULL,
  `marks` INT NOT NULL,
  `type` VARCHAR(25) NOT NULL,
  `fk_courseID` INT NOT NULL,
  `fk_staffID` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_questions_courses1`
    FOREIGN KEY (`fk_courseID`) REFERENCES `courses` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_questions_staff1`
    FOREIGN KEY (`fk_staffID`) REFERENCES `staff` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX question_questions_idx1 ON `questions` (`question`);
CREATE INDEX marks_questions_idx1 ON `questions` (`marks`);
CREATE INDEX type_questions_idx1 ON `questions` (`type`);

-- -----------------------------------------------------
-- Table `answers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `answers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `option` TEXT(500) NOT NULL,
  `right_answer` VARCHAR(255) NULL,
  `fk_questID` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_answers_questions1`
    FOREIGN KEY (`fk_questID`) REFERENCES `questions` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);
CREATE INDEX option_answers_idx1 ON `answers` (`option`);
CREATE INDEX right_answer_answers_idx1 ON `answers` (`right_answer`);

-- -----------------------------------------------------
-- Table `quizzes_questions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `quizzes_questions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fk_quizID` INT NOT NULL,
  `fk_questID` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_quizzes_questions_quizzes1`
    FOREIGN KEY (`fk_quizID`) REFERENCES `quizzes` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_quizzes_questions_questions1`
    FOREIGN KEY (`fk_questID`) REFERENCES `questions` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table `students_quizzes_responses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `students_quizzes_responses` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fk_quizID` INT NOT NULL,
  `fk_questID` INT NOT NULL,
  `fk_ansID` INT NOT NULL,
  `fk_studentID` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_students_quizzes_responses_quizzes1`
    FOREIGN KEY (`fk_quizID`) REFERENCES `quizzes` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_quizzes_responses_questions1`
    FOREIGN KEY (`fk_questID`) REFERENCES `questions` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_quizzes_responses_answers1`
    FOREIGN KEY (`fk_ansID`) REFERENCES `answers` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_quizzes_responses_students1`
    FOREIGN KEY (`fk_studentID`) REFERENCES `students` (`index_number`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- -----------------------------------------------------
-- Table `students_quizzes_stats`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `students_quizzes_stats` (
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
    FOREIGN KEY (`fk_quizID`) REFERENCES `quizzes` (`id`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_students_quizzes_stats_students1`
    FOREIGN KEY (`fk_studentID`) REFERENCES `students` (`index_number`) 
    ON DELETE NO ACTION ON UPDATE NO ACTION
);