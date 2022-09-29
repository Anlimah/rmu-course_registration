<?php

namespace Src\Controller;

use Twilio\Rest\Client;

use Src\System\DatabaseMethods;

class UsersController extends DatabaseMethods
{

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

    public function sendEmail($recipient_email, $user_id)
    {
        //generate code and store hash version of code
        $v_code = $this->genCode($user_id);
        if ($v_code) {
            //prepare mail info
            $headers = 'From: ' . 'y.m.ratty7@gmail.com';
            $subject = 'RMU Admmisions Form Purchase: Code Verification';
            $message = 'Hi, <br> your verification code is <b>' . $v_code . '</b>';

            //send mail
            return mail($recipient_email, $subject, $message, $headers);
        }
        return 0;
    }

    public function sendSMS($recipient_number, $otp_code, $message, $ISD = '+233')
    {

        $sid = getenv('TWILIO_SID');
        $token = getenv('TWILIO_TKN');
        $client = new Client($sid, $token);

        //prepare SMS message
        $to = $ISD . $recipient_number;
        $account_phone = '19785232220';
        $from = array('from' => $account_phone, 'body' => $message . ' ' . $otp_code);

        //send SMS
        $response = $client->messages->create($to, $from);
        if ($response->sid) {
            $_SESSION['sms_code'] = $otp_code;
            $_SESSION['sms_sid'] = $response->sid;
            if (isset($_SESSION['sms_code']) && !empty($_SESSION['sms_code']) && isset($_SESSION['sms_sid']) && !empty($_SESSION['sms_sid'])) return 1;
        } else {
            return 0;
        }
    }

    public function getFormPrice(string $form_type)
    {
        return $this->getData("SELECT `amount` FROM `form_type` WHERE `name` LIKE '%$form_type%'");
    }

    public function getAdminYearCode()
    {
        $sql = "SELECT EXTRACT(YEAR FROM (SELECT `start_date` FROM admission_period)) AS 'year'";
        $year = (string) $this->getData($sql)[0]['year'];
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
        $data = $this->getData($sql, array(':a' => sha1($app_number)));

        if ($data) {
            if (!empty($data[0]["pin"])) {
                if (password_verify($pin, $data[0]["pin"])) {

                    // Get application form type
                    $sql2 = "SELECT `form_type` FROM `purchase_detail` WHERE `id` = :a";
                    $data2 = $this->getData($sql2, array(':a' => $data[0]["purchase_id"]));

                    if ($data2) {
                        return array("id" => $data[0]["id"], "type" => $data2[0]["form_type"]);
                    }
                }
            }
        }
        return 0;
    }

    public function updateApplicantInfo($what, $value, $user_id)
    {
        $sql = "UPDATE `personal_information` SET `$what` = :v WHERE `app_login` = :a";
        $this->inputData($sql, array(':v' => $value, ':a' => $user_id));
    }

    public function updateAcademicInfo($what, $value, $s_number, $user_id)
    {
        $sql = "UPDATE `academic_background` SET `$what` = :v WHERE `s_number` = :s AND  `app_login` = :a";
        $this->inputData($sql, array(':v' => $value, ':s' => $s_number, ':a' => $user_id));
    }

    public function updatePrevUniInfo($what, $value, $user_id)
    {
        $sql = "UPDATE `previous_uni_records` SET `$what` = :v WHERE `app_login` = :a";
        $this->inputData($sql, array(':v' => $value, ':a' => $user_id));
    }

    public function updateProgramInfo($what, $value, $user_id)
    {
        $sql = "UPDATE `program_info` SET `$what` = :v WHERE `app_login` = :a";
        $this->inputData($sql, array(':v' => $value, ':a' => $user_id));
    }

    //GET
    public function fetchApplicantPersI($user_id)
    {
        $sql = "SELECT `prefix`, `first_name`, `middle_name`, `last_name`, `suffix`, 
                `gender`, `dob`, `marital_status`, `nationality`, `country_res`, 
                `disability`, `photo`, `country_birth`, `spr_birth`, `city_birth`, 
                `english_native`, `other_language`, `postal_addr`, `postal_town`, 
                `postal_spr`, `postal_country`, `phone_no1`, `phone_no2`, `email_addr`, 
                `p_prefix`, `p_first_name`, `p_last_name`, `p_occupation`, `p_phone_no`, 
                `p_email_addr` FROM `personal_information` WHERE `app_login` = :a";
        return $this->getData($sql, array(':a' => $user_id));
    }

    public function fetchApplicantAcaB($user_id)
    {
        $sql = "SELECT `school_name`, `s_number`, `country`, `region`, `city`, `cert_type`, 
                `month_started`, `year_started`, `month_completed`, `year_completed`, 
                `index_number`, `course_of_study` 
                FROM `academic_background` WHERE `app_login` = :a";
        return $this->getData($sql, array(':a' => $user_id));
    }

    public function fetchApplicantProgI($user_id)
    {
        $sql = "SELECT * FROM `program_info` WHERE `app_login` = :a";
        return $this->getData($sql, array(':a' => $user_id));
    }

    public function fetchApplicantPreUni($user_id)
    {
        $sql = "SELECT `pre_uni_rec`, `name_of_uni`, `program`, `month_enrolled`, `year_enrolled`, 
                `completed`, `month_completed`, `year_completed`, `state`, `reasons` 
                FROM `previous_uni_records` WHERE `app_login` = :a";
        return $this->getData($sql, array(':a' => $user_id));
    }

    public function fetchEducationHistory($serial_number, $user_id)
    {
        $sql1 = "SELECT `s_number`, `school_name`, `country`, `region`, `city`, 
                `cert_type`, `index_number`, `month_started`, `year_started`, 
                `month_completed`, `year_completed`, `course_of_study` 
                FROM `academic_background` WHERE `s_number` = :sn AND `app_login` = :id";
        $params = array(":sn" => $serial_number, ":id" => $user_id);
        $aca_data = $this->getData($sql1, $params);

        if (!empty($aca_data)) {
            $sql2 = "SELECT h.`id`, h.`type`, h.`subject`, h.`grade` 
                    FROM `academic_background` AS a, `high_school_results` AS h 
                    WHERE h.`acad_back_id` = a.`id` AND a.`s_number` = :sn";
            $params = array(":sn" => $serial_number);
            $grade_data = $this->getData($sql2, $params);

            if (!empty($aca_data)) {
                return array("aca" => $aca_data, "courses" => $grade_data);
            }
            return 0;
        }
        return 0;
    }

    public function getApplicationType($user_id)
    {
        $sql = "SELECT `purchase_detail`.`form_type` FROM `purchase_detail`, `applicants_login`
        WHERE `applicants_login`.`purchase_id` = `purchase_detail`.`id` AND `applicants_login`.`id` = :a";
        return $this->getData($sql, array(':a' => $user_id));
    }

    public function verify_form($uri)
    {
    }

    private function doesCodeExists($code)
    {
        $sql = "SELECT `id` FROM `academic_background` WHERE `s_number`=:s";
        if ($this->getID($sql, array(':s' => sha1($code)))) {
            return 1;
        }
        return 0;
    }

    public function saveEducation($sn, $cn, $rg, $ci, $ct, $im, $ms, $ys, $mc, $yc, $cs, $al)
    {
        $rslt = 1;
        while ($rslt) {
            $serial_number = $this->genCode();
            $rslt = $this->doesCodeExists($serial_number);
        }

        $sql = "INSERT INTO `academic_background` (`s_number`, `school_name`, `country`, 
                `region`, `city`, `cert_type`, `index_number`, `month_started`, `year_started`, 
                `month_completed`, `year_completed`, `course_of_study`,`app_login`) 
                VALUES (:sr, :sn, :cn, :rg, :ci, :ct, :im, :ms, :ys, :mc, :yc, :cs, :al)";

        $params = array(
            ":sr" => $serial_number, ":sn" => $sn, ":cn" => $cn, ":rg" => $rg,
            ":ci" => $ci, ":ct" => $ct, ":im" => $im,
            ":ms" => $ms, ":ys" => $ys, ":mc" => $mc, ":yc" => $yc, ":cs" => $cs, ":al" => $al
        );

        if ($this->inputData($sql, $params)) {
            $sql = "SELECT `id` FROM `academic_background` WHERE `s_number`=:s";
            return $this->getID($sql, array(':s' => $serial_number));
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
        return $this->inputData($sql, $params);
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
        return $this->inputData($sql, $params);
    }

    public function saveSubjectAndGrades($subjects = array(), $aca_id)
    {
        if (!empty($subjects)) {
            $sql = "INSERT INTO `high_school_results` (`type`, `subject`, `grade`, `acad_back_id`) VALUES (:t, :s, :g, :ai)";

            // add core subjects
            for ($i = 0; $i < count($subjects["core"]); $i++) {
                $params = array(":t" => "core", ":s" => $subjects["core"][$i]["subject"], ":g" => $subjects["core"][$i]["grade"], ":ai" =>  $aca_id);
                $this->inputData($sql, $params);
            }

            // add elective subjects
            for ($i = 0; $i < count($subjects["elective"]); $i++) {
                $params = array(":t" => "elective", ":s" => $subjects["elective"][$i]["subject"], ":g" => $subjects["elective"][$i]["grade"], ":ai" =>  $aca_id);
                $this->inputData($sql, $params);
            }

            return 1;
        }
        return 0;
    }

    public function deleteEducationHistory($serial_number, $education_id)
    {
        $sql = "DELETE FROM `academic_background` WHERE `s_number` = :sn AND `app_login` = :id";
        $params = array(":sn" => $serial_number, ":id" => $education_id);
        return $this->inputData($sql, $params);
    }
}
