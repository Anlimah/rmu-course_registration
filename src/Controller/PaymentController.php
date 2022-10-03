<?php
session_start();

require_once('../../bootstrap.php');
require_once('../Gateway/PaymentGateway.php');

use Src\Controller\PaymentGateway;

if (isset($_SESSION['step1Done']) && isset($_SESSION['step2Done']) && isset($_SESSION['step3Done']) && isset($_SESSION['step4Done']) && isset($_SESSION['step5Done']) && isset($_SESSION['step6Done'])) {
    if ($_SESSION['step1Done'] == true && $_SESSION['step2Done'] == true && $_SESSION['step3Done'] == true && $_SESSION['step4Done'] == true && $_SESSION['step5Done'] == true && $_SESSION['step6Done'] == true) {

        $payload = array(
            'tx_ref' => time(),
            'amount' => $_SESSION["step6"]['amount'],
            'country' => 'GH',
            'currency' => 'GHS',
            'payment_options' => 'mobilemoneyghana',
            'redirect_url' => 'https://admissions.rmuictonline.com/purchase/purchase_confirm.php',
            'customer' => array(
                'name' => $_SESSION["step1"]['first_name'] . " " . $_SESSION["step1"]['last_name'],
                'email' => $_SESSION["step2"]['email_address'],
                'phone_number' => $_SESSION["step4"]['phone_number'],
            ),
            'meta' => array(
                'user' => $_SESSION["step6"]['user'],
                'price' => $_SESSION["step6"]['amount'],
                'app_type' => $_SESSION["step6"]['app_type'],
                'app_year' => $_SESSION["step6"]['app_year'],
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
        $response = json_decode($pay->initiatePayment());

        if ($response->status == 'success') {
            //$_SESSION['processing'] = true;
            header("Location: " . $response->data->link);
        } else {
            echo 'Payment processing failed!';
            //5531886652142950  09/32   564     3310    12345
            //5399838383838381	470	3310	10/31	12345
            //4187427415564246	828	3310	09/32	12345

            // Insufficient funds: 5258585922666506	883	3310	09/31	12345
            // Incorrect PIN	5399834697894723	883	3310	09/31	12345
        }
    }
}
