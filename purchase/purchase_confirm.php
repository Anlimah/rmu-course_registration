<?php
session_start();

require_once('../bootstrap.php');
require_once('../src/Gateway/PaymentGateway.php');

use Src\Controller\PaymentGateway;

if (isset($_GET['status']) && !empty($_GET['status']) && $_GET['status'] == 'cancelled') {
    echo 'Payment processing was cancelled';
    PaymentGateway::destroyAllSessions();
    //header('Location: purchase_step1.php');

} elseif (isset($_GET['status']) && !empty($_GET['status']) && $_GET['status'] == 'successful') {
    $transRef = $_GET['tx_ref'];
    $transID = $_GET['transaction_id'];

    $secretKey = getenv('SECRET_KEY');
    $payUrl = "https://api.flutterwave.com/v3/transactions/{$transID}/verify";
    $request = 'GET';

    $pay = new PaymentGateway($secretKey, $payUrl, $request, array());
    $response = json_decode($pay->initiatePayment());

    if ($response->status == 'success') {
        if ($response->data->meta->price >= $response->data->charged_amount) {
            echo 'Payment was successful!';
        }
    } else {
        //code
    }
}
