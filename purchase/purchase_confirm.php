<?php
session_start();

require_once('../bootstrap.php');
require_once('../src/Gateway/PaymentGateway.php');

use Src\Controller\PaymentGateway;


/*if ($response->status == 'success') {
    header("Location: " . $response->data->link);
} else {
    echo 'Payment processing failed!';
}*/

if (isset($_GET['status']) && !empty($_GET['status']) && $_GET['status'] == 'cancelled') {
    /*session_unset();
    session_destroy();
    session_write_close();*/
    echo 'Payment process was cancelled';
} elseif (isset($_GET['status']) && !empty($_GET['status']) && $_GET['status'] == 'successful') {
    $transRef = $_GET['tx_ref'];
    $transID = $_GET['transaction_id'];

    $secretKey = getenv('SECRET_KEY');
    $payUrl = "https://api.flutterwave.com/v3/transactions/{$transID}/verify";
    $request = 'GET';

    $pay = new PaymentGateway($secretKey, $payUrl, $request, array());
    $response = $pay->initiatePayment('verify');
    echo '<pre>' . $response . '</pre>';
}
