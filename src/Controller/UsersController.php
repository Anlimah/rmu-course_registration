<?php

namespace Src\Controller;

require_once('../bootstrap.php');

use Twilio\Rest\Client;

use Src\System\DatabaseMethods;

class UsersController extends DatabaseMethods
{
    public function sendEmail($recipient_email, $user_id)
    {
        //generate code and store hash version of code
        $v_code = $this->generateCode($user_id);
        if ($v_code) {
            //prepare mail info
            $first_name = $this->getApplicantsName($user_id)[0]["first_name"];
            $headers = 'From: ' . 'y.m.ratty7@gmail.com';
            $subject = 'RMU Admmisions Form Purchase: Code Verification';
            $message = 'Hi ' . $first_name . ', <br> Your verification code is <b>' . $v_code . '</b>';

            //send mail
            return mail($recipient_email, $subject, $message, $headers);
        }
        return 0;
    }

    public function sendSMS($recipient_number, $ISD = '+233')
    {
        $v_code = $this->genCode(4);

        $sid = getenv('TWILIO_SID');
        $token = getenv('TWILIO_TKN');
        $client = new Client($sid, $token);

        //prepare SMS message
        $to = $ISD . $recipient_number;
        $account_phone = '19785232220';
        $from = array('from' => $account_phone, 'body' => 'Your RMU code is ' . $v_code);

        //send SMS
        $response = $client->messages->create($to, $from);
        if ($response->sid) {
            $_SESSION['sms_code'] = $v_code;
            $_SESSION['sms_sid'] = $response->sid;
            if (isset($_SESSION['sms_code']) && !empty($_SESSION['sms_code']) && isset($_SESSION['sms_sid']) && !empty($_SESSION['sms_sid'])) return 1;
        } else {
            return 0;
        }
    }

    public function getFormPrice(string $form_type)
    {
        if (!empty($form_type)) {
            return $this->getData("SELECT amount FROM application_type WHERE title LIKE '%$form_type%'");
        }
    }

    public function saveApplicantDetails($fn, $ln, $pn, $ea)
    {
        $sql = "INSERT INTO `applicant_details` (`first_name`, `last_name`, `phone_number`, `email_address`)  
				VALUES(:f, :l, :n, :e)";
        $params = array(':f' => $fn, ':l' => $ln, ':n' => $pn, ':e' => $ea);
        if ($this->inputData($sql, $params)) {
            $user = $this->checkUser($pn, $ea);
            if ($user) {
                return $user; //return user ID
            } else {
                return 0; // error occured
            }
        }
    }

    private function getApplicantsName($user_id)
    {
        $sql = "SELECT `first_name`, `last_name` FROM `applicant_details` WHERE `id`=:i";
        return $this->getData($sql, array(':i' => $user_id));
    }

    public function checkUser($pn, $ea)
    {
        $sql = "SELECT `id` FROM `applicant_details` WHERE `phone_number`=:p AND `email_address`=:e";
        $params = array(':p' => $pn, ':e' => $ea);
        return $this->getID($sql, $params);
    }

    public function addUserData($fn, $ln, $ea, $pn, $pp, $bn)
    {
        if ($this->checkUser($pp, $bn)) {
            return -1; // user already exist
        } else {
            $sql = "INSERT INTO `users`(`firstName`, `lastName`, `emailAddress`, `phoneNumber`, `passportNumber`, `bookNumber`)  
						VALUES(:f, :l, :e, :n, :p, :b)";
            $params = array(':f' => $fn, ':l' => $ln, ':e' => $ea, ':n' => $pn, ':p' => $pp, ':b' => $bn);
            if ($this->inputData($sql, $params)) {
                $user = $this->checkUser($pp, $bn);
                if ($user) {
                    return 1; //return user ID
                } else {
                    return 0; // error occured
                }
            }
        }
    }

    //get one student data(uses student db id)
    public function getProfileInfo($user)
    {
        $sql = "SELECT * FROM `users` WHERE `id` = :u";
        $params = array(':u' => $user);
        return $this->getData($sql, $params);
    }

    //get one student data(uses student db id)
    public function getAllProInfo()
    {
        $sql = "SELECT * FROM `applicant_details`";
        return $this->getData($sql);
    }

    public function generateCode($user_id)
    {
        $rslt = 1;
        while ($rslt) {
            $code = $this->genCode();
            $rslt = $this->isCodeExists($user_id, $code);
        }
        $sql = "INSERT INTO `applicant_verification` (`applicant_id`, `code`) VALUES(:u, :c)";
        $params = array(':u' => $user_id, ':c' => sha1($code));
        if ($this->inputData($sql, $params)) {
            if ($this->isCodeExists($user_id, $code)) {
                return $code;
            }
            return 0;
        }
        return 0;
    }

    public function isCodeExists($user_id, $code)
    {
        $sql = "SELECT `id` FROM `applicant_verification` WHERE applicant_id = :u AND code = :c";
        $params = array(':u' => $user_id, ':c' => sha1($code));
        if ($this->getID($sql, $params)) {
            return 1;
        }
        return 0;
    }

    private function doesCodeExists($sql, $params)
    {
        return $this->getID($sql, $params);
    }

    /**
     * Application Login
     * 
     * 
     */

    public function verifyAppDetails(mixed $appNumber, int $pinCode)
    {
        $sql = "SELECT `id` FROM `applicant_details` WHERE `phone_number`=:a AND `email_address`=:p";
        $params = array(':a' => $appNumber, ':p' => $pinCode);
        return $this->getID($sql, $params);
    }
}
