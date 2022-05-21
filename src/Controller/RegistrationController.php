<?php

namespace Src\Controller;

use Src\System\DatabaseMethods;

class RegistrationController extends DatabaseMethods
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

    public function sendSMS($recipient_number, $user_id)
    {
        $v_code = $this->genCode();
        //prepare SMS information
        //send SMS
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

    public function checkCode($user_id, $key = 0)
    {
        $sql = "";
        if ($key == 0) {
            $sql = "SELECT s.`id` FROM `statuses` AS s, `codes` AS c, `users` AS u 
				WHERE s.cid = c.id AND c.uid = u.id AND u.id = :u 
				AND s.`generated` = 1 AND s.`verified` = 0";
        } else {
            $sql = "SELECT s.`id` FROM `statuses` AS s, `codes` AS c, `users` AS u 
				WHERE s.cid = c.id AND c.uid = u.id AND u.id = :u 
				AND s.`generated` = 1 AND s.`verified` = 1";
        }

        return $this->getID($sql, array(':u' => $user_id));
    }

    public function verifyUserCode($user, $code)
    {
        $sql = "UPDATE `statuses` AS s, `codes` AS c, `users` AS u 
				SET s.`verified` = 1 
				WHERE s.cid = c.id AND c.uid = u.id AND u.id = :u AND c.`qr_code` = :q";
        $params = array(':u' => $user, ':q' => sha1($code));
        return $this->inputData($sql, $params);
    }

    private function doesCodeExists($sql, $params)
    {
        return $this->getID($sql, $params);
    }

    public function generateNewDepartureQRCode()
    {
        $rslt = 1;
        while ($rslt) {
            $v_code = $this->genCode(6);
            $sql = "SELECT `id` FROM `departure_codes` WHERE `code` = :c";
            $params = array(':c' => sha1($v_code));
            $rslt = $this->doesCodeExists($sql, $params);
        }

        $sql = "UPDATE `departure_codes` SET `status` = 0";
        if ($this->inputData($sql)) {
            $sql = "INSERT INTO `departure_codes` (`code`) VALUES(:c)";
            $params = array(':c' =>  sha1($v_code));
            return $this->inputData($sql, $params);
        } else {
            return 0;
        }
    }

    public function generateNewArrivalQRCode()
    {
        $rslt = 1;
        while ($rslt) {
            $arriveQRCode = $this->genCode(10);
            $sql = "SELECT `id` FROM `arrival_codes` WHERE `code` = :c";
            $params = array(':c' => sha1($arriveQRCode));
            $rslt = $this->doesCodeExists($sql, $params);
        }

        $sql = "UPDATE `arrival_codes` SET `status` = 0";
        if ($this->inputData($sql)) {
            $sql = "INSERT INTO `arrival_codes` (`code`) VALUES(:c)";
            $params = array(':c' => sha1($arriveQRCode));
            return $this->inputData($sql, $params);
        } else {
            return 0;
        }
    }

    public function getDepartureQRCode()
    {
        $sql = "SELECT `code` FROM `departure_codes` WHERE `status` = 1";
        return $this->getData($sql);
    }

    public function getArrivalQRCode()
    {
        $sql = "SELECT `code` FROM `arrival_codes` WHERE `status` = 1";
        return $this->getData($sql);
    }

    public function verifyQRCode($type, $code, $user)
    {
        if ($type == 1) {
            $sql = "SELECT `id` FROM `departure_codes` WHERE `status` = 1 AND `code` = :c";
            $params = array(':c' => $this->validateInput($code));
            $qrcID = $this->getID($sql, $params);
            if ($qrcID) {
                $sql = "INSERT INTO `travel_timeline` (`uid`,`did`) VALUES(:u, :d)";
                $params = array(':u' =>  $user, ':d' =>  $qrcID);
                return $this->inputData($sql, $params);
            } else {
                return 0;
            }
        } elseif ($type == 2) {
            $sql = "SELECT `code` FROM `arrival_codes` WHERE `status` = 1 AND `code` = :c";
            $params = array(':c' => $this->validateInput($code));
            $qrcID = $this->getID($sql, $params);
            if ($qrcID) {
                $sql = "INSERT INTO `travel_timeline` (`uid`,`aid`) VALUES(:u, :a)";
                $params = array(':u' =>  $user, ':a' =>  $qrcID);
                return $this->inputData($sql, $params);
            } else {
                return 0;
            }
        }
    }
}
