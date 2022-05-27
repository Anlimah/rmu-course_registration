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

    private function setCURL_Array($state)
    {
        if ($state == 'verify') {
            $this->payload = array();
        }
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

    public function initiatePayment($state)
    {
        $this->setCURL_Array($state);
        $curl = curl_init();
        curl_setopt_array($curl, $this->curl_array);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
        return $this->curl_array;
    }
}
