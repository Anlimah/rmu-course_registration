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

    public function genLoginDetails($app_number, int $type, int $year)
    {
        while (true) {
            $app_num = $this->genAppNumber($type, $year);
            $sql = "SELECT `id` FROM `applicants_login` WHERE `app_number`=:p";
            if (empty($this->getID($sql, array(':p' => $app_number)))) {
                break;
            }
        }

        return array(
            'app_number' => $app_num,
            'pin_number' => $this->genPin()
        );
    }
}
