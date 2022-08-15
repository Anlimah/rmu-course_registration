<?php

namespace Src\Controller;

require_once('../bootstrap.php');

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
        $year = (string) $this->getData("SELECT EXTRACT(YEAR FROM (SELECT `start_date` FROM admission_period)) AS 'year'")[0]['year'];
        return (int) substr($year, 2, 2);
    }

    /**
     * Application Login
     * 
     * 
     */

    public function verifyLoginDetails($app_number, $pin)
    {
        $sql = "SELECT `pin`, `id` FROM `applicants_login` WHERE `app_number` = :a";
        $hashed_pin = $this->getData($sql, array(':a' => sha1($app_number)));

        if ($hashed_pin) {
            if (!empty($hashed_pin[0]["pin"])) {
                if (password_verify($pin, $hashed_pin[0]["pin"])) {
                    return $hashed_pin[0]["id"];
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
        if ($this->inputData($sql, array(':v' => $value, ':a' => $user_id))) {
            return 1;
        }
        return 0;
    }

    public function fetchApplicantPersI($user_id)
    {
        $sql = "SELECT * FROM `personal_information` WHERE `app_login` = :a";
        return $this->getData($sql, array(':a' => sha1($user_id)));
    }

    public function fetchApplicantAcaB($user_id)
    {
        $sql = "SELECT * FROM `academic_background` WHERE `app_login` = :a";
        return $this->getData($sql, array(':a' => sha1($user_id)));
    }

    public function fetchApplicantProgI($user_id)
    {
        $sql = "SELECT * FROM `program_info` WHERE `app_login` = :a";
        return $this->getData($sql, array(':a' => sha1($user_id)));
    }

    public function fetchApplicantPreUni($user_id)
    {
        $sql = "SELECT * FROM `previous_uni_records` WHERE `app_login` = :a";
        return $this->getData($sql, array(':a' => sha1($user_id)));
    }
}
