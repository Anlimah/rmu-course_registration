<?php
session_start();

require_once('../bootstrap.php');

/*$payment_opts = '';

if ($_SESSION["step6"]['pay_method'] == 'Momo') {
    $payment_opts = 'mobilemoneyghana';
} else {
    $payment_opts = 'account, mobilemoneyghana, banktransfer';
}*/

$payload = array(
    'tx_ref' => time(),
    'amount' => $_SESSION["step6"]['amount'],
    'country' => 'GH',
    'currency' => 'GHS',
    'payment_options' => 'card,barter,mobilemoneyghana,banktransfer,account',
    'redirect_url' => 'https://localhost/rmu_admissions/purchase/purchase_confirm.php',
    'customer' => array(
        'name' => $_SESSION["step1"]['first_name'] . " " . $_SESSION["step1"]['last_name'],
        'email' => $_SESSION["step2"]['email_address'],
        'phone_number' => $_SESSION["step4"]['phone_number'],
    ),
    'customizations' => array(
        'title' => 'RMU admission form',
        'logo' => 'https://i0.wp.com/galexgh.com/wp-content/uploads/2020/05/download-3.jpeg?fit=225%2C225&ssl=1',
        'pay_button_text' => 'Pay for forms',
        'description' => 'Paying ' . $_SESSION["step6"]["amount"] . ' for ' . $_SESSION["step6"]["form_type"] . ' application forms.',
    ),

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

$response = json_decode(curl_exec($curl));
curl_close($curl);

if ($response->status == 'success') {
    header("Location: " . $response->data->link);
} else {
    echo 'Payment processing failed!';
}
