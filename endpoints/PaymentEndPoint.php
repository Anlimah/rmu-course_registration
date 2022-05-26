<?php
session_start();
// Prevent direct access to this class
define("BASEPATH", 1);
require_once('../bootstrap.php');

$payment_opts = '';

if ($_SESSION["step6"]['pay_method'] == 'Momo') {
    $payment_opts = 'mobilemoneyghana';
} else {
    $payment_opts = 'card, account, mobilemoneyghana, banktransfer';
}

$payload = array(
    'first_name' => $_SESSION["step1"]['first_name'],
    'last_name' => $_SESSION["step1"]['last_name'],
    'email' => $_SESSION["step2"]['email_address'],
    'amount' => $_SESSION["step6"]['amount'],
    'country' => 'GH',
    'phone_number' => $_SESSION["step4"]['phone_number'],
    'payment_options' => $payment_opts,
    'currency' => 'GHS',
    'tx_ref' => time(),
    'customizations' => array(
        'title' => 'Payment sample',
        'description' => 'Paying ' . $_SESSION["step6"]["amount"] . ' for ' . $_SESSION["step6"]["form_type"] . ' application forms.',
    ),
    'redirect_url' => 'https://localhost/rmu_admissions/purchase/purchase_confirm.php',
);

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($payload),
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer " . getenv('SECRET_KEY') . "",
        "Content-Type: application/json"
    ),
));

$response = curl_exec($curl);

curl_close($curl);
echo '<pre>' . $response . '</pre>';
