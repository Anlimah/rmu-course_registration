<?php

namespace Src\Controller;

use Src\System\DatabaseMethods;

class ExposeDataController
{
    private $dm;

    public function __construct()
    {
        $this->dm = new DatabaseMethods();
    }

    public function getFormTypes()
    {
        return $this->dm->getData("SELECT * FROM `form_type`");
    }

    public function getPaymentMethods()
    {
        return $this->dm->getData("SELECT * FROM `payment_method`");
    }

    public function getPrograms($type)
    {
        $sql = "SELECT * FROM `programs` WHERE `type` = :t";
        $param = array(":t" => $type);
        return $this->dm->getData($sql, $param);
    }

    public function getHalls()
    {
        return $this->dm->getData("SELECT * FROM `halls`");
    }

    public function genCode($length = 6)
    {
        $digits = $length;
        return rand(pow(10, $digits - 1), pow(10, $digits) - 1);
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
}
