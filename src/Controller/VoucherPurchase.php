<?php

namespace Src\Controller;

require_once('../bootstrap.php');

use Twilio\Rest\Client;

use Src\System\DatabaseMethods;

class VoucherPurchase extends DatabaseMethods
{
    public function verifyEmailAddress($email, $code)
    {
        $sql = "SELECT `id` FROM `verify_email_address` WHERE `email_address`=:e AND `code`=:c";
        return $this->getID($sql, array(':e' => $email, ':c' => $code));
    }

    public function verifyPhoneNumber($number, $code)
    {
        $sql = "SELECT `id` FROM `verify_phone_number` WHERE `phone_number`=:p AND `code`=:c";
        return $this->getID($sql, array(':p' => $number, ':c' => $code));
    }

    private function genPin(int $length_pin = 9)
    {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result), 0, $length_pin);
    }

    private function genAppNumber(int $type, int $year)
    {
        $user_code = $this->genCode(5);
        $app_number = 'RMU-' . (($type * 10000000) + ($year * 100000) + $user_code);
        return $app_number;
    }

    private function doesCodeExists($code)
    {
        $sql = "SELECT `id` FROM `applicants_login` WHERE `app_number`=:p";
        if ($this->getID($sql, array(':p' => sha1($code)))) {
            return 1;
        }
        return 0;
    }

    private function saveLoginDetails($app_number, $pin)
    {
        $hashed_pin = password_hash($pin, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `applicants_login` (`app_number`, `pin`) VALUES(:a, :p)";
        $params = array(':a' => sha1($app_number), ':p' => $hashed_pin);
        if ($this->inputData($sql, $params)) {
            return 1;
        }
        return 0;
    }

    public function genLoginDetails(int $who, int $type, int $year)
    {
        $rslt = 1;
        while ($rslt) {
            $app_num = $this->genAppNumber($type, $year);
            $rslt = $this->doesCodeExists($app_num);
        }
        $pin = $this->genPin();
        if ($this->saveLoginDetails($who, $app_num, $pin)) {
            return array('app_number' => $app_num, 'pin_number' => $pin);
        }
        return 0;
    }
}
