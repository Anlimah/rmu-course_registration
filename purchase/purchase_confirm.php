<?php
session_start();

require_once('../bootstrap.php');
require_once('../src/Gateway/OrchardPaymentGateway.php');
require_once('../src/Controller/VoucherPurchase.php');

use Src\Controller\OrchardPaymentGateway;
use Src\Controller\VoucherPurchase;

if (isset($_GET['status']) && !empty($_GET['status']) && isset($_GET['transaction_id']) && !empty($_GET['transaction_id']) && $_GET['status'] == '015') {
    $trans_id = $_GET['transaction_id'];
    $service_id = getenv('ORCHARD_SERVID');

    $payload = json_encode(array(
        "exttrid" => $trans_id,
        "trans_type" => "TSC",
        "service_id" => $service_id
    ));

    $client_id = getenv('ORCHARD_CLIENT');
    $client_secret = getenv('ORCHARD_SECRET');
    $signature = hash_hmac("sha256", $payload, $client_secret);

    $secretKey = $client_id . ":" . $signature;
    $payUrl = "https://orchard-api.anmgw.com/checkTransaction";
    $request_verb = 'POST';

    try {
        $pay = new OrchardPaymentGateway($secretKey, $payUrl, $request_verb, $payload);
        //$response = json_decode($pay->initiatePayment());
        $response = $pay->initiatePayment();
        echo $response;
        /*if ($response->status == 'success') {
            if ($response->data->meta->price >= $response->data->charged_amount && $response->data->processor_response == 'successful') {
                echo 'Payment was successful!<br><hr><br>';

                $voucher = new VoucherPurchase();
                if ($voucher->createApplicant($_SESSION)) {
                    echo '<span style="color:red;"><b>Please do not close this page yet.</b></span><br><br>';
                    echo 'An email with your <b>Application Number</b> and <b>PIN Code</b> and has been sent to you!<br>';
                    echo 'Please confirm and proceed to the <a href="../apply"><b>online applicatioin portal</b></a> to complete your application process.<br>';
                    //echo 'Or <a href="resend.php?link=' . sha1(md5($url)) . '">Resend</a> <b>Application Number</b> and <b>PIN Code</b> if not received.';
                    //header('Location: purchase_step1.php?status=success');
                }
            }
        } else {
            //code
        }*/

        //print_r(json_encode($response));
    } catch (\Exception $e) {
        throw $e;
    }
} else {
    echo 'Payment processing failed!';
    //header('Location: purchase_step1.php?status=cancelled');
}

//OrchardPaymentGateway::destroyAllSessions(); //Kill all sessions
