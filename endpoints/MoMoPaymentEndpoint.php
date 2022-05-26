<?php

// Prevent direct access to this class
define("BASEPATH", 1);

require_once("../bootstrap.php");
require("../vendor/flutterwavedev/flutterwave-v3/library/MobileMoney.php");

use Flutterwave\MobileMoney;

//The data variable holds the payload
$data = array(
    "order_id" => "USS_URG_89245453s2323",
    "amount" => "1500",
    "type" => "mobile_money_ghana",
    "currency" => "GH",
    "email" => "ekene@flw.com",
    "phone_number" => "054709929220",
    "fullname" => "John Madakin",
    "client_ip" => "154.123.220.1",
    "device_fingerprint" => "62wd23423rq324323qew1",
    "meta" => [
        "flightID" => "213213AS"
    ]
);

$payment = new MobileMoney();
$result = $payment->mobilemoney($data);
$id = $result['data']['id'];
$verify = $payment->verifyTransaction($id);
$print_r($result);
