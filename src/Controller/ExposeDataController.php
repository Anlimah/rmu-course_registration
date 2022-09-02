<?php

namespace Src\Controller;

use Twilio\Rest\Client;
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

    public function sendEmail($recipient_email, $user_id)
    {
        //generate code and store hash version of code
        $v_code = $this->dm->genCode($user_id);
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
}
