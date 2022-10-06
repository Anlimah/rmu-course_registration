<?php
session_start();

require_once('../../bootstrap.php');
require_once('../Gateway/OrchardPaymentGateway.php');

use Src\Controller\OrchardPaymentGateway;

if (isset($_SESSION['step1Done']) && isset($_SESSION['step2Done']) && isset($_SESSION['step3Done']) && isset($_SESSION['step4Done']) && isset($_SESSION['step5Done']) && isset($_SESSION['step6Done']) && isset($_SESSION['step7Done'])) {
    if ($_SESSION['step1Done'] == true && $_SESSION['step2Done'] == true && $_SESSION['step3Done'] == true && $_SESSION['step4Done'] == true && $_SESSION['step5Done'] == true && $_SESSION['step6Done'] == true && $_SESSION['step7Done'] == true) {

        $form_price = $_SESSION["step6"]["amount"];
        $momo_number = $_SESSION["step7"]["momo_number"];
        $callback_url = "https://admissions.rmuictonline.com/purchase/purchase_confirm.php";
        $trans_id = time();
        $network = $_SESSION["step7"]["momo_agent"];
        $landing_page = "https://admissions.rmuictonline.com/purchase/payment-checkpoint.php";
        $service_id = getenv('ORCHARD_SERVID');
        /*
            "landing_page" => $landing_page,
            "payment_mode" => "CRM",
            "currency_code" => "GHS",
            "currency_val" => "233"
        */

        $payload = json_encode(array(
            "customer_number" => $momo_number,
            "amount" => $form_price,
            "exttrid" => $trans_id,
            "reference" => "Test payment",
            "trans_type" => "CTM",
            "nw" => $network,
            "callback_url" => "$callback_url",
            "service_id" => $service_id,
            "ts" => date("Y-m-d H:i:s"),
            "nickname" => "RMU Admissions"
        ));

        $client_id = getenv('ORCHARD_CLIENT');
        $client_secret = getenv('ORCHARD_SECRET');
        $signature = hash_hmac("sha256", $payload, $client_secret);

        $secretKey = $client_id . ":" . $signature;
        $payUrl = "https://orchard-api.anmgw.com/sendRequest";
        $request_verb = 'POST';

        $pay = new OrchardPaymentGateway($secretKey, $payUrl, $request_verb, $payload);
        $response = $pay->initiatePayment();
        echo $response;
        /*if ($response->resp_code == "015") {
            header("Location: " . $callback_url . "?status=" . $response->resp_code . "&msg=" . $response->resp_code);
        } else {
            echo 'Payment processing failed!';
        }*/
    }
}
