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
        if ($this->inputData($sql, array(':v' => $value, ':a' => $user_id))) {
            return 1;
        }
        return 0;
    }

    public function updateAcademicInfo($what, $value, $user_id)
    {
        $sql = "UPDATE `academic_background` SET `$what` = :v WHERE `app_login` = :a";
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
        $sql = "SELECT `school`, `cert_type`, `month_completed`, `year_completed`, 
                `index_number`, `certificate`, `transcript` 
                FROM `academic_background` WHERE `app_login` = :a";
        return $this->getData($sql, array(':a' => $user_id));
    }

    public function fetchApplicantProgI($user_id)
    {
        $sql = "SELECT * FROM `program_info` WHERE 1";
        return $this->getData($sql, array());
    }

    public function fetchApplicantPreUni($user_id)
    {
        $sql = "SELECT `name_of_uni`, `program`, `month_enrolled`, `year_enrolled`, 
                `completed`, `month_completed`, `year_completed`, `state`, `reasons` 
                FROM `previous_uni_records` WHERE `app_login` = :a";
        return $this->getData($sql, array(':a' => $user_id));
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

    public function saveEducation()
    {
        return json_encode(array("response" => "ok"));
    }
}
