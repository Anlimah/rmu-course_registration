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

    private function savePurchaseDetails($user, $fn, $ln, $cn, $ea, $pn, $ft, $pm, $ap)
    {
        $sql = "INSERT INTO `purchase_detail`(`user_id`, `first_name`, `last_name`, `country`, `email_address`, `phone_number`, `form_type`, `payment_method`, `admission_period`) 
                VALUES(:ui, :fn, :ln, :cn, :ea, :pn, $ft, $pm, $ap)";
        $params = array(
            ':ui' => $user,
            ':fn' => $fn,
            ':ln' => $ln,
            ':cn' => $cn,
            ':ea' => $ea,
            ':pn' => $pn
        );
        return $this->inputData($sql, $params);
    }

    private function saveLoginDetails($app_number, $pin, $who)
    {
        $hashed_pin = password_hash($pin, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `applicants_login` (`app_number`, `pin`, `purchase_id`) VALUES(:a, :p, :b)";
        $params = array(':a' => sha1($app_number), ':p' => $hashed_pin, ':b' => $who);

        if ($this->inputData($sql, $params)) {
            return 1;
        }
        return 0;
    }

    private function genLoginDetails(int $who, int $type, int $year)
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

    private function getAdmissionPeriodID()
    {
        $sql = "SELECT `id` FROM `admission_period` WHERE `active` = :a";
        return $this->getID($sql, array(':a' => 1));
    }

    private function getFormTypeID($form_type)
    {
        $sql = "SELECT `id` FROM `form_type` WHERE `name` LIKE '%$form_type%'";
        return $this->getID($sql);
    }

    public function createApplicant($data)
    {
        $fn = $data['step1']['first_name'];
        $ln = $data['step1']['last_name'];
        $cn = $data['step1']['country'];
        $ea = $data['step2']['email_address'];
        $pn = $data['step4']['phone_number'];
        $ft = $data['step6']['form_type'];
        $pm = $data['step6']['pay_method'];
        $at = $data['step6']['app_type'];
        $ay = $data['step6']['app_year'];
        $ui = $data['step6']['user'];

        $ap_id = $this->getAdmissionPeriodID();
        $ft_id = $this->getFormTypeID($ft);

        if ($this->savePurchaseDetails($ui, $fn, $ln, $cn, $ea, $pn, $ft_id, $pm, $ap_id)) {
            echo 1;
            $purchase_id = $this->getAdmissionPeriodID();
            $data = $this->genLoginDetails($purchase_id, $at, $ay);
            if (!empty($data)) {
                return $data;
            }
        }

        return 0; /**/
    }
}
