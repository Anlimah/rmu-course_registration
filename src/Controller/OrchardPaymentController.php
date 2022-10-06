<?php
session_start();

require_once('../../bootstrap.php');
require_once('../Gateway/OrchardPaymentGateway.php');

use Src\Controller\OrchardPaymentGateway;

if (isset($_SESSION['step1Done']) && isset($_SESSION['step2Done']) && isset($_SESSION['step3Done']) && isset($_SESSION['step4Done']) && isset($_SESSION['step5Done']) && isset($_SESSION['step6Done']) && isset($_SESSION['step7Done'])) {
    if ($_SESSION['step1Done'] == true && $_SESSION['step2Done'] == true && $_SESSION['step3Done'] == true && $_SESSION['step4Done'] == true && $_SESSION['step5Done'] == true && $_SESSION['step6Done'] == true && $_SESSION['step7Done'] == true) {

        $form_price = $_SESSION["step6"]["amount"];
        $callback_url = "https://admissions.rmuictonline.com/purchase/purchase_confirm.php";
        $trans_id = time();
        $network = $_SESSION["step7"]["momo_agent"];
        $landing_page = "https://admissions.rmuictonline.com/purchase/payment-checkpoint.php";
        $service_id = 2216;
        /*
        
            "landing_page" => $landing_page,
            "payment_mode" => "CRM",
            "currency_code" => "GHS",
            "currency_val" => "233"
        */

        $date = date("Y-m-d H:i:s");
        echo $date . "<br>";
        $payload = json_encode(array(
            "customer_number" => "233554603299",
            "amount" => $form_price,
            "exttrid" => $trans_id,
            "reference" => "Test payment",
            "trans_type" => "CTM",
            "nw" => $network,
            "callback_url" => $callback_url,
            "service_id" => $service_id,
            "ts" => $date,
            "nickname" => "RMU Admissions"
        ));

        $client_id = getenv('ORCHARD_CLIENT');
        $client_secret = getenv('ORCHARD_SECRET');
        $signature = hash_hmac("sha256", $payload, $client_secret);

        $secretKey = $client_id . ":" . $signature;
        $payUrl = "https://orchard-api.anmgw.com/sendRequest";
        $request_verb = 'POST';

        $pay = new OrchardPaymentGateway($secretKey, $payUrl, $request_verb, $payload);
        //echo $pay . "<br>";
        //echo json_decode($payload)->ts;
        $response = $pay->initiatePayment();/**/
        echo $response . "<br>";
        /*if ($response["resp_code"] == "015") {
            //$_SESSION['processing'] = true;
            header("Location: " . $callback_url);
        } else {
            echo 'Payment processing failed!';
            //5531886652142950  09/32   564     3310    12345
            //5399838383838381	470	3310	10/31	12345
            //4187427415564246	828	3310	09/32	12345

            // Insufficient funds: 5258585922666506	883	3310	09/31	12345
            // Incorrect PIN	5399834697894723	883	3310	09/31	12345
        }*/
    }
}
