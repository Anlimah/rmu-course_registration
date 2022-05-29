<?php

namespace Src\Controller;

class PaymentGateway
{
    private $url = null;
    private $request = null;
    private $payload = null;
    private $secret_key = null;

    private $curl_array = array();


    public function __construct($secret, $url, $request, $payload = array())
    {
        $this->url = $url;
        $this->request = $request;
        $this->payload = $payload;
        $this->secret_key = $secret;
    }

    private function setCURL_Array()
    {
        if ($this->request == 'GET') $this->payload = array();

        $this->curl_array = array(
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $this->request,
            CURLOPT_POSTFIELDS => json_encode($this->payload),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $this->secret_key . "",
                "Content-Type: application/json"
            ),
        );
    }

    public function initiatePayment()
    {
        $this->setCURL_Array();
        $curl = curl_init();
        curl_setopt_array($curl, $this->curl_array);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public static function destroyAllSessions()
    {

        unset($_SESSION['step1']);
        unset($_SESSION['step2']);
        unset($_SESSION['step3']);
        unset($_SESSION['step4']);
        unset($_SESSION['step5']);
        unset($_SESSION['step6']);
        unset($_SESSION['step1Done']);
        unset($_SESSION['step2Done']);
        unset($_SESSION['step3Done']);
        unset($_SESSION['step4Done']);
        unset($_SESSION['step5Done']);
        unset($_SESSION['step6Done']);

        session_unset();
        session_destroy();
        session_write_close();
    }
}
