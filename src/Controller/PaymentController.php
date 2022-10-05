<?php
session_start();

require_once('../../bootstrap.php');
require_once('../Gateway/PaymentGateway.php');

use Src\Controller\PaymentGateway;

if (isset($_SESSION['step1Done']) && isset($_SESSION['step2Done']) && isset($_SESSION['step3Done']) && isset($_SESSION['step4Done']) && isset($_SESSION['step5Done']) && isset($_SESSION['step6Done']) && isset($_SESSION['step7Done'])) {
    if ($_SESSION['step1Done'] == true && $_SESSION['step2Done'] == true && $_SESSION['step3Done'] == true && $_SESSION['step4Done'] == true && $_SESSION['step5Done'] == true && $_SESSION['step6Done'] == true && $_SESSION['step7Done'] == true) {

        $payload = array(
            'tx_ref' => time(),
            'amount' => $_SESSION["step6"]['amount'],
            'country' => 'GH',
            'currency' => 'GHS',
            'payment_options' => 'mobilemoneyghana',
            'redirect_url' => 'https://localhost/rmu_admissions/purchase/purchase_confirm.php',
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

        //Orchid

        /*$form_price = $_SESSION["step6"]["amount"];
        $callback_url = "https://localhost/rmu_admissions/purchase/purchase_confirm.php";
        $trans_id = time();
        $network = $_SESSION["step7"]["momo_agent"];
        $landing_page = "https://localhost/rmu_admissions/purchase/purchase_confirm.php";

        $payload = array(
            "amount" => $form_price,
            "callback_url" => $callback_url,
            "exttrid" => $trans_id,
            "nw" => $network,
            "reference" => "Test payment",
            "service_id" => "XYZ",
            "trans_type" => "CTM",
            "nickname" => "RMU Admissions",
            "landing_page" => $landing_page,
            "ts" => "2022-10-05 07:21:43",
            "payment_mode" => "CRM",
            "currency_code" => "GHS",
            "currency_val" => "233"
        );

        $payUrl = "https://orchard-api.anmgw.com/third_party_request";
        $payload = json_encode($payload);
        $client_id = "";
        $client_secret = "";
        $signature = hash_hmac("sha256", $payload, $client_secret);
        $secretKey = $client_id . ":" . $signature;*/

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
