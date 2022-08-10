<?php

namespace Src\Controller;

require_once('../bootstrap.php');

use Src\System\DatabaseMethods;
use Src\Controller\ExposeDataController;

class VoucherPurchase
{
    private $dm;
    private $expose;

    public function __construct()
    {
        $this->dm = new DatabaseMethods();
        $this->expose = new ExposeDataController();
    }

    private function genPin(int $length_pin = 9)
    {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result), 0, $length_pin);
    }

    private function genAppNumber(int $type, int $year)
    {
        $user_code = $this->dm->genCode(5);
        $app_number = 'RMU-' . (($type * 10000000) + ($year * 100000) + $user_code);
        return $app_number;
    }

    private function doesCodeExists($code)
    {
        $sql = "SELECT `id` FROM `applicants_login` WHERE `app_number`=:p";
        if ($this->dm->getID($sql, array(':p' => sha1($code)))) {
            return 1;
        }
        return 0;
    }

    private function savePurchaseDetails(int $pi, int $ft, int $pm, int $ap, $fn, $ln, $cn, $ea, $pn)
    {
        $sql = "INSERT INTO `purchase_detail`(`id`, `first_name`, `last_name`, `country`, `email_address`, `phone_number`, `form_type`, `payment_method`, `admission_period`) 
                VALUES(:ui, :fn, :ln, :cn, :ea, :pn, :ft, :pm, :ap)";
        $params = array(
            ':ui' => $pi,
            ':fn' => $fn,
            ':ln' => $ln,
            ':cn' => $cn,
            ':ea' => $ea,
            ':pn' => $pn,
            ':ft' => $ft,
            ':pm' => $pm,
            ':ap' => $ap,
        );
        if ($this->dm->inputData($sql, $params)) {
            return $pi;
        }
    }

    private function saveLoginDetails($app_number, $pin, $who)
    {
        $hashed_pin = password_hash($pin, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `applicants_login` (`app_number`, `pin`, `purchase_id`) VALUES(:a, :p, :b)";
        $params = array(':a' => sha1($app_number), ':p' => $hashed_pin, ':b' => $who);

        if ($this->dm->inputData($sql, $params)) {
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
        $pin = strtoupper($this->genPin());
        if ($this->saveLoginDetails($app_num, $pin, $who)) {
            return array('app_number' => $app_num, 'pin_number' => $pin);
        }
        return 0;
    }

    //Get and Set IDs for foreign keys

    private function getAdmissionPeriodID()
    {
        $sql = "SELECT `id` FROM `admission_period` WHERE `active` = 1;";
        return $this->dm->getID($sql);
    }

    private function getFormTypeID($form_type)
    {
        $sql = "SELECT `id` FROM `form_type` WHERE `name` LIKE '%$form_type%'";
        return $this->dm->getID($sql);
    }

    private function getPaymentMethodID($name)
    {
        $sql = "SELECT `id` FROM `payment_method` WHERE `name` LIKE '%$name%'";
        return $this->dm->getID($sql);
    }

    public function createApplicant($data)
    {
        if (!empty($data)) {
            $fn = $data['step1']['first_name'];
            $ln = $data['step1']['last_name'];
            $cn = $data['step1']['country'];
            $ea = $data['step2']['email_address'];
            $pn = $data['step4']['phone_number'];
            $ft = $data['step6']['form_type'];
            $pm = $data['step6']['pay_method'];
            $at = $data['step6']['app_type'];
            $ay = $data['step6']['app_year'];
            $pi = (int) $data['step6']['user'];

            $ap_id = $this->getAdmissionPeriodID();
            $ft_id = $this->getFormTypeID($ft);
            $pm_id = $this->getPaymentMethodID($pm);

            $purchase_id = $this->savePurchaseDetails($pi, $ft_id, $pm_id, $ap_id, $fn, $ln, $cn, $ea, $pn);
            if ($purchase_id) {
                $login_details = $this->genLoginDetails($purchase_id, $at, $ay);
                if (!empty($login_details)) {
                    $key = 'APPLICATION NUMBER: ' . $login_details['app_number'] . '    PIN: ' . $login_details['pin_number'];
                    $message = 'Your RMU Online Application login details ';
                    if ($this->expose->sendSMS($pn,  $key, $message)) {
                        return 1;
                    }
                }
            }/**/
        }

        return 0;
    }
}
