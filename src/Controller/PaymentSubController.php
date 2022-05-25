<?php

namespace Src\Controller;

require_once("../../bootstrap.php");


class PaymentSubController
{

    //private $db;

    /*public function __construct($reqMethod, $where, $when)
    {
        //$this->db = $db;
        $this->reqMethod = $reqMethod;
        $this->where = $where;
        $this->when = $when;

        $this->videoGateway = new VideoGateway();
    }*/


    /**
     * @param string
     * @param int
     * @return array
     */
    public function getBanks($code, $fetchByCode = 0)
    {
        $baseUrl = "";
        if ($fetchByCode) {
            $baseUrl = "https://api.flutterwave.com/v3/banks/" . $code . "/branches";
        } else {
            $baseUrl = "https://api.flutterwave.com/v3/banks/" . $code;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $baseUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . getenv('SECRET_KEY')
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    /**
     * @param string
     * @param array
     */
    function getURL($url, $data = array())
    {
        $urlArr = explode('?', $url);
        $params = array_merge($_GET, $data);
        $new_query_string = http_build_query($params) . '&' . $urlArr[1];
        $newUrl = $urlArr[0] . '?' . $new_query_string;
        return $newUrl;
    }
}

$meh = new PaymentSubController();
