<?php
session_start();

require_once('../../bootstrap.php');
require_once('../Gateway/PaymentGateway.php');

use Src\Controller\PaymentGateway;

$payload = array(
    'tx_ref' => time(),
    'amount' => $_SESSION["step6"]['amount'],
    'country' => 'GH',
    'currency' => 'GHS',
    'payment_options' => '',
    'redirect_url' => 'https://localhost/rmu_admissions/purchase/purchase_confirm.php',
    'customer' => array(
        'name' => $_SESSION["step1"]['first_name'] . " " . $_SESSION["step1"]['last_name'],
        'email' => $_SESSION["step2"]['email_address'],
        'phone_number' => $_SESSION["step4"]['phone_number'],
    ),
    'meta' => array(
        'price' => $_SESSION["step6"]['amount'],
    ),
    'customizations' => array(
        'title' => 'RMU admission form',
        'logo' => 'https://i0.wp.com/galexgh.com/wp-content/uploads/2020/05/download-3.jpeg?fit=225%2C225&ssl=1',
        'pay_button_text' => 'Pay for forms',
        'description' => 'Paying ' . $_SESSION["step6"]["amount"] . ' for ' . $_SESSION["step6"]["form_type"] . ' application forms.',
    ),
);

$secretKey = getenv('SECRET_KEY');
$payUrl = 'https://api.flutterwave.com/v3/payments';
$request = 'POST';

$pay = new PaymentGateway($secretKey, $payUrl, $request, $payload);
$response = json_decode($pay->initiatePayment('main'));

if ($response->status == 'success') {
    header("Location: " . $response->data->link);
} else {
    echo 'Payment processing failed!';
}
