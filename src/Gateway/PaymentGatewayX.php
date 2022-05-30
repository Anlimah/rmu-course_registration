<?php

namespace Src\Controller;

require_once("../../bootstrap.php");

class PaymentGatewayX
{
    private $payload = null;
    private $curl_array = array();


    public function __construct($payload = array())
    {
        $this->payload = $payload;
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
                "Authorization: Bearer " . getenv('SECRET_KEY') . "",
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

    public function getTransferFee(float $amount = 0, string $currency = "GHS", string $type = "mobilemoney")
    {
        $this->url = "https://api.flutterwave.com/v3/transfers/fee?amount=$amount&currency=$currency&type=$type";
        $this->request = "GET";
        return $this->initiatePayment();
    }

    public function makePayment()
    {
        $this->url = "https://api.flutterwave.com/v3/payments";
        $this->request = "POST";
        return $this->initiatePayment();
    }

    public function verifyTransaction(mixed $transactionID)
    {
        $this->url = "https://api.flutterwave.com/v3/transactions/{$transactionID}/verify";
        $this->request = "GET";
        return $this->initiatePayment();
    }
}
