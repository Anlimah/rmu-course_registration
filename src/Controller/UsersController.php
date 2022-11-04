<?php

namespace Src\Controller;

use Src\System\DatabaseMethods;
use Src\Controller\ExposeDataController;

class UsersController
{
    private $dm;
    private $expose;

    public function __construct()
    {
        $this->dm = new DatabaseMethods();
        $this->expose = new ExposeDataController();
    }

    public function verifyEmailAddress($email, $code)
    {
        $sql = "SELECT `id` FROM `verify_email_address` WHERE `email_address`=:e AND `code`=:c";
        return $this->dm->getID($sql, array(':e' => $email, ':c' => $code));
    }

    public function verifyPhoneNumber($number, $code)
    {
        $sql = "SELECT `id` FROM `verify_phone_number` WHERE `phone_number`=:p AND `code`=:c";
        return $this->dm->getID($sql, array(':p' => $number, ':c' => $code));
    }

    public function validateEmail($input)
    {
        if (empty($input)) {
            die("Invalid email address!");
        }
        $user_email = htmlentities(htmlspecialchars($input));
        $sanitized_email = filter_var($user_email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {
            die("Invalid email address!" . $sanitized_email);
        }
        return $user_email;
    }

    public function validateInput($input)
    {
        if (empty($input)) {
            die("Invalid input!");
        }
        $user_input = htmlentities(htmlspecialchars($input));
        $validated_input = (bool) preg_match('/^[A-Za-z0-9]/', $user_input);
        if ($validated_input) {
            return $user_input;
        }
        die("Invalid input!");
    }

    public function validatePhone($input)
    {
        if (empty($input)) {
            die("Provide a phone number!");
        }
        $user_input = htmlentities(htmlspecialchars($input));
        $validated_input = (bool) preg_match('/^[0-9]/', $user_input);
        if ($validated_input) {
            return $user_input;
        }
        die("Invalid phone number!");
    }

    public function validateDate($date)
    {
        if (strtotime($date) === false) {
            die("Invalid date!");
        }
        list($year, $month, $day) = explode('-', $date);
        if (checkdate($month, $day, $year)) {
            return $date;
        }
    }

    public function validateImage($files)
    {
        if (!isset($files['file']['error']) || !empty($files["pics"]["name"])) {
            $allowedFileType = ['image/jpeg', 'image/png', 'image/jpg'];
            for ($i = 0; $i < count($files["pics"]["name"]); $i++) {
                $check = getimagesize($files["pics"]["tmp_name"][$i]);
                if ($check !== false && in_array($files["pics"]["type"][$i], $allowedFileType)) {
                    return $files;
                }
            }
        }
        die("Invalid file uploaded!");
    }

    public function validateText($input)
    {
        if (empty($input)) die("Input required!");

        $user_input = htmlentities(htmlspecialchars($input));
        $validated_input = (bool) preg_match('/^[A-Za-z]/', $user_input);

        if ($validated_input) return $user_input;
        die("Invalid Input!");
    }

    public function validateInputTextOnly($input)
    {
        if (empty($input)) {
            return array("status" => "error", "message" => "required");
        }

        $user_input = htmlentities(htmlspecialchars($input));
        $validated_input = (bool) preg_match('/^[A-Za-z]/', $user_input);

        if ($validated_input) {
            return array("status" => "success", "message" => $user_input);
        }

        return array("status" => "error", "message" => "invalid");
    }

    public function validateInputTextNumber($input)
    {
        if (empty($input)) {
            return array("status" => "error", "message" => "required");
        }

        $user_input = htmlentities(htmlspecialchars($input));
        $validated_input = (bool) preg_match('/^[A-Za-z0-9]/', $user_input);

        if ($validated_input) {
            return array("status" => "success", "message" => $user_input);
        }

        return array("status" => "error", "message" => "invalid");
    }

    public function validateYearData($input)
    {
        if (empty($input) || strtoupper($input) == "YEAR") {
            return array("status" => "error", "message" => "required");
        }

        if ($input < 1990 || $input > 2022) {
            return array("status" => "error", "message" => "invalid");
        }

        $user_input = htmlentities(htmlspecialchars($input));
        $validated_input = (bool) preg_match('/^[0-9]/', $user_input);

        if ($validated_input) {
            return array("status" => "success", "message" => $user_input);
        }

        return array("status" => "error", "message" => "invalid");
    }

    public function validateGrade($input)
    {
        if (empty($input) || strtoupper($input) == "GRADE") {
            return array("status" => "error", "message" => "required");
        }

        if (strlen($input) < 1 || strlen($input) > 2) {
            return array("status" => "error", "message" => "invalid");
        }

        $user_input = htmlentities(htmlspecialchars($input));
        return array("status" => "success", "message" => $user_input);
    }

    public function getFormPrice(string $form_type)
    {
        return $this->dm->getData("SELECT `amount` FROM `form_type` WHERE `name` LIKE '%$form_type%'");
    }

    public function getAdminYearCode()
    {
        $sql = "SELECT EXTRACT(YEAR FROM (SELECT `start_date` FROM admission_period)) AS 'year'";
        $year = (string) $this->dm->getData($sql)[0]['year'];
        return (int) substr($year, 2, 2);
    }

    /**
     * Application Login
     * 
     * 
     */

    public function verifyLoginDetails($app_number, $pin)
    {
        $sql = "SELECT `pin`, `id`, `purchase_id` FROM `applicants_login` WHERE `app_number` = :a";
        $data = $this->dm->getData($sql, array(':a' => sha1($app_number)));
        if ($data) {
            if (!empty($data[0]["pin"])) {
                if (password_verify($pin, $data[0]["pin"])) {

                    // Get application form type
                    $sql2 = "SELECT `form_type` FROM `purchase_detail` WHERE `id` = :a";
                    $data2 = $this->dm->getData($sql2, array(':a' => $data[0]["purchase_id"]));

                    if ($data2) {
                        return array("id" => $data[0]["id"], "type" => $data2[0]["form_type"]);
                    }
                }
            }
        }
        return 0;
    }

    public function hasSubmittedForm($user_id)
    {
        $sql = "SELECT `id` FROM `form_sections_chek` WHERE `app_login` = :a 
                AND `personal`=1 AND `education`=1 
                AND `programme`=1 AND `uploads`=1 AND `declaration`=1";
        return $this->dm->getID($sql, array(':a' => $user_id));
    }

    public function updateApplicantPhoto($value, $user_id)
    {
        $sql = "UPDATE `personal_information` SET `photo` = :v WHERE `app_login` = :a";
        return $this->dm->inputData($sql, array(':v' => $value, ':a' => $user_id));
    }

    public function updateApplicantInfo($what, $value, $user_id)
    {
        $sql = "UPDATE `personal_information` SET `$what` = :v WHERE `app_login` = :a";
        $this->dm->inputData($sql, array(':v' => $value, ':a' => $user_id));
    }

    public function updateAcademicInfo($what, $value, $s_number, $user_id)
    {
        $sql = "UPDATE `academic_background` SET `$what` = :v WHERE `s_number` = :s AND  `app_login` = :a";
        $this->dm->inputData($sql, array(':v' => $value, ':s' => $s_number, ':a' => $user_id));
    }

    public function updatePrevUniInfo($what, $value, $user_id)
    {
        $sql = "UPDATE `previous_uni_records` SET `$what` = :v WHERE `app_login` = :a";
        $this->dm->inputData($sql, array(':v' => $value, ':a' => $user_id));
    }

    public function updateProgramInfo($what, $value, $user_id)
    {
        $sql = "UPDATE `program_info` SET `$what` = :v WHERE `app_login` = :a";
        $this->dm->inputData($sql, array(':v' => $value, ':a' => $user_id));
    }

    public function updateHowYouKnowUs($what, $value, $user_id)
    {
        $sql = "UPDATE `heard_about_us` SET `$what` = :v WHERE `app_login` = :a";
        return $this->dm->inputData($sql, array(':v' => $value, ':a' => $user_id));
    }

    public function updateApplicationStatus($what, $user_id)
    {
        $sql = "UPDATE `form_sections_chek` SET `$what` = 1 WHERE `app_login` = :a";
        return $this->dm->inputData($sql, array(':a' => $user_id));
    }

    //GET
    public function getApplicationStatus($user_id)
    {
        $sql = "SELECT `personal`, `education`, `programme`, `uploads`, `declaration` 
                FROM `form_sections_chek` WHERE `app_login` = :a";
        return $this->dm->getData($sql, array(':a' => $user_id));
    }

    public function fetchApplicantPersI($user_id)
    {
        $sql = "SELECT `prefix`, `first_name`, `middle_name`, `last_name`, `suffix`, 
                `gender`, `dob`, `marital_status`, `nationality`, `country_res`, 
                `disability`, `photo`, `country_birth`, `spr_birth`, `city_birth`, 
                `english_native`, `other_language`, `postal_addr`, `postal_town`, 
                `postal_spr`, `postal_country`, `phone_no1_code`, `phone_no1`, `phone_no2_code`, `phone_no2`, `email_addr`, 
                `p_prefix`, `p_first_name`, `p_last_name`, `p_occupation`, `p_phone_no_code`, `p_phone_no`, 
                `p_email_addr` FROM `personal_information` WHERE `app_login` = :a";
        return $this->dm->getData($sql, array(':a' => $user_id));
    }

    public function fetchApplicantAcaB($user_id)
    {
        $sql = "SELECT `school_name`, `s_number`, `country`, `region`, `city`, `cert_type`, 
                `month_started`, `year_started`, `month_completed`, `year_completed`, 
                `index_number`, `course_of_study` 
                FROM `academic_background` WHERE `app_login` = :a";
        return $this->dm->getData($sql, array(':a' => $user_id));
    }

    public function fetchApplicantProgI($user_id)
    {
        $sql = "SELECT * FROM `program_info` WHERE `app_login` = :a";
        return $this->dm->getData($sql, array(':a' => $user_id));
    }

    public function fetchApplicantPreUni($user_id)
    {
        $sql = "SELECT `pre_uni_rec`, `name_of_uni`, `program`, `month_enrolled`, `year_enrolled`, 
                `completed`, `month_completed`, `year_completed`, `state`, `reasons` 
                FROM `previous_uni_records` WHERE `app_login` = :a";
        return $this->dm->getData($sql, array(':a' => $user_id));
    }

    public function fetchHowYouKnowUs($user_id)
    {
        $sql = "SELECT `medium`, `description` FROM `heard_about_us` WHERE `app_login` = :a";
        return $this->dm->getData($sql, array(':a' => $user_id));
    }

    public function fetchEducationHistory($serial_number, $user_id)
    {
        $sql1 = "SELECT `s_number`, `school_name`, `country`, `region`, `city`, 
                `cert_type`, `index_number`, `month_started`, `year_started`, 
                `month_completed`, `year_completed`, `course_of_study` 
                FROM `academic_background` WHERE `s_number` = :sn AND `app_login` = :id";
        $params = array(":sn" => $serial_number, ":id" => $user_id);
        $aca_data = $this->dm->getData($sql1, $params);

        if (!empty($aca_data)) {
            $sql2 = "SELECT h.`id`, h.`type`, h.`subject`, h.`grade` 
                    FROM `academic_background` AS a, `high_school_results` AS h 
                    WHERE h.`acad_back_id` = a.`id` AND a.`s_number` = :sn";
            $params = array(":sn" => $serial_number);
            $grade_data = $this->dm->getData($sql2, $params);

            if (!empty($aca_data)) {
                return array("aca" => $aca_data, "courses" => $grade_data);
            }
            return 0;
        }
        return 0;
    }

    public function fetchGrades($cert_type)
    {
        $sql = "SELECT `grade` FROM `grades` WHERE `type`=:t";
        return $this->dm->getData($sql, array(':t' => $cert_type));
    }

    public function fetchCourses($type)
    {
        $sql = "SELECT `id`, `course` FROM `high_shcool_courses` WHERE `type`= :t";
        return $this->dm->getData($sql, array(':t' => $type));
    }

    public function fetchElectiveSubjects($course_name)
    {
        $sql = "SELECT s.`id`, s.`subject` FROM `high_shcool_courses` AS c, `high_sch_elective_subjects` AS s 
                WHERE c.`id`= s.`course` AND c.`course` = :c";
        return $this->dm->getData($sql, array(':c' => $course_name));
    }

    public function getApplicationType($user_id)
    {
        $sql = "SELECT `purchase_detail`.`form_type` FROM `purchase_detail`, `applicants_login`
        WHERE `applicants_login`.`purchase_id` = `purchase_detail`.`id` AND `applicants_login`.`id` = :a";
        return $this->dm->getData($sql, array(':a' => $user_id));
    }

    public function getTotalAppEduHist($user_id)
    {
        $sql = "SELECT COUNT(`id`) AS total FROM `academic_background` WHERE `app_login` = :a";
        return $this->dm->getData($sql, array(':a' => $user_id));
    }

    public function getFormValidationStatus($user_id)
    {
        $sql = "SELECT `id` FROM `form_sections_chek` WHERE `app_login` = :a 
                AND `personal`=1 AND `education`=1 AND `programme`=1 AND `uploads`=1";
        return $this->dm->getID($sql, array(':a' => $user_id));
    }

    public function verifyForm($column)
    {
        $str = "UPDATE `form_sections_chek` SET $column = 1 WHERE `id` = :i";
        $this->dm->inputData($str);
    }

    private function doesCodeExists($code)
    {
        $sql = "SELECT `id` FROM `academic_background` WHERE `s_number`=:s";
        if ($this->dm->getID($sql, array(':s' => sha1($code)))) {
            return 1;
        }
        return 0;
    }

    public function saveEducation($sn, $cn, $rg, $ci, $ct, $im, $ms, $ys, $mc, $yc, $cs, $ar, $al)
    {
        $rslt = 1;
        while ($rslt) {
            $serial_number = $this->expose->genCode();
            $rslt = $this->doesCodeExists($serial_number);
        }

        $sql = "INSERT INTO `academic_background` (`s_number`, `school_name`, `country`, 
                `region`, `city`, `cert_type`, `index_number`, `month_started`, `year_started`, 
                `month_completed`, `year_completed`, `course_of_study`, `awaiting_result`, `app_login`) 
                VALUES (:sr, :sn, :cn, :rg, :ci, :ct, :im, :ms, :ys, :mc, :yc, :cs, :ar, :al)";

        $params = array(
            ":sr" => $serial_number, ":sn" => $sn, ":cn" => $cn, ":rg" => $rg,
            ":ci" => $ci, ":ct" => $ct, ":im" => $im, ":ms" => $ms, ":ys" => $ys,
            ":mc" => $mc, ":yc" => $yc, ":cs" => $cs, ":ar" => $ar, ":al" => $al
        );

        if ($this->dm->inputData($sql, $params)) {
            $sql = "SELECT `id` FROM `academic_background` WHERE `s_number`=:s";
            return $this->dm->getID($sql, array(':s' => $serial_number));
        }

        return 0;
    }

    public function saveCoreSubjectGrades($math, $english, $science, $social)
    {
        $sql = "INSERT INTO `core_subjects_grades` (`school_name`, `country`, 
                `region`, `city`, `cert_type`, `index_number`, `month_started`, `year_started`, 
                `month_completed`, `year_completed`, `course_of_study`,`app_login`) 
                VALUES (:m, :e, :i, :s)";
        $params = array(":m" => $math, ":e" => $english, ":i" => $science, ":s" => $social);
        return $this->dm->inputData($sql, $params);
    }

    public function saveElectiveSubjectGrades($ej1, $ejg1, $ej2, $ejg2, $ej3, $ejg3, $ej4, $ejg4)
    {
        $sql = "INSERT INTO `elective_subjects_grades` (`school_name`, `country`, 
                `region`, `city`, `cert_type`, `index_number`, `month_started`, `year_started`, 
                `month_completed`, `year_completed`, `course_of_study`,`app_login`) 
                VALUES (:s1, :g1, :s2, :g2, :s3, :g3, :s4, :g4)";
        $params = array(
            ":s1" => $ej1, ":g1" => $ejg1, ":s2" => $ej2, ":g2" => $ejg2,
            ":s3" => $ej3, ":g3" => $ejg3, ":s4" => $ej4, ":g4" => $ejg4
        );
        return $this->dm->inputData($sql, $params);
    }

    public function saveSubjectAndGrades($subjects = array(), $aca_id)
    {
        if (!empty($subjects)) {
            $sql = "INSERT INTO `high_school_results` (`type`, `subject`, `grade`, `acad_back_id`) VALUES (:t, :s, :g, :ai)";

            // add core subjects
            for ($i = 0; $i < count($subjects["core"]); $i++) {
                $params = array(":t" => "core", ":s" => $subjects["core"][$i]["subject"], ":g" => $subjects["core"][$i]["grade"], ":ai" =>  $aca_id);
                $this->dm->inputData($sql, $params);
            }

            // add elective subjects
            for ($i = 0; $i < count($subjects["elective"]); $i++) {
                $params = array(":t" => "elective", ":s" => $subjects["elective"][$i]["subject"], ":g" => $subjects["elective"][$i]["grade"], ":ai" =>  $aca_id);
                $this->dm->inputData($sql, $params);
            }

            return 1;
        }
        return 0;
    }

    public function deleteEducationHistory($serial_number, $education_id)
    {
        $sql = "DELETE FROM `academic_background` WHERE `s_number` = :sn AND `app_login` = :id";
        $params = array(":sn" => $serial_number, ":id" => $education_id);
        return $this->dm->inputData($sql, $params);
    }

    public function saveDocuments($type, $filename, $user_id)
    {
        $sql = "INSERT INTO `applicant_uploads`(`type`, `file_name`, `app_login`) VALUES (:t, :f, :a)";
        $params = array(":t" => $type, ":f" => $filename, ":a" => $user_id);
        return $this->dm->inputData($sql, $params);
    }

    public function fetchUploadedDocs($user_id)
    {
        $sql = "SELECT u.* FROM `applicant_uploads` AS u WHERE `app_login` = :a";
        return $this->dm->getData($sql, array(':a' => $user_id));
    }

    public function deleteUploadedFile($serial_number, $user_id)
    {
        $data = [];
        $sql1 = "SELECT `file_name` FROM `applicant_uploads` WHERE `id` = :sn AND `app_login` = :id";
        $params = array(":sn" => $serial_number, ":id" => $user_id);
        $file_name = $this->dm->getData($sql1, $params);

        if (!empty($file_name))
            $file = "../apply/docs/" . $file_name[0]["file_name"];

        if (file_exists($file)) {
            $sql2 = "DELETE FROM `applicant_uploads` WHERE `id` = :sn AND `app_login` = :id";
            if ($this->dm->inputData($sql2, $params)) {
                if (unlink($file)) {
                    $data["success"] = true;
                    $data["message"] = "The file was deleted successfully!";
                } else {
                    $data["success"] = false;
                    $data["message"] = "An error occurred in file deletion";
                }
            } else {
                $data["success"] = false;
                $data["message"] = "An error occurred in file deletion";
            }
        } else {
            $data["success"] = false;
            $data["message"] = "The file you are trying to delete does not exist";
        }
        return $data;
    }

    public function fetchApplicantPhoto($user_id)
    {
        $sql = "SELECT `photo` FROM `personal_information` WHERE `app_login` = :a";
        return $this->dm->getData($sql, array(':a' => $user_id));
    }
}
