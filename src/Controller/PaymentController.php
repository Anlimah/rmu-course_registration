<?php
// Prevent direct access to this class
define("BASEPATH", 1);

require_once("../../bootstrap.php");

include('../../vendor/flutterwavedev/flutterwave-v3/library/rave.php');
include('../../vendor/flutterwavedev/flutterwave-v3/library/raveEventHandlerInterface.php');

use Flutterwave\Rave;

$URL = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$getData = $_GET;
$postData = $_POST;
$publicKey = $_SERVER['PUBLIC_KEY'];
$secretKey = $_SERVER['SECRET_KEY'];
$success_url = $postData['successurl'];
$failure_url = $postData['failureurl'];
$env = $_SERVER['ENV'];

if ($postData['amount']) {
    $_SESSION['publicKey'] = $publicKey;
    $_SESSION['secretKey'] = $secretKey;
    $_SESSION['env'] = $env;
    $_SESSION['successurl'] = $success_url;
    $_SESSION['failureurl'] = $failure_url;
    $_SESSION['currency'] = $postData['currency'];
    $_SESSION['amount'] = $postData['amount'];
}

$prefix = 'RMU'; // Change this to the name of your business or app
$overrideRef = false;

// Uncomment here to enforce the useage of your own ref else a ref will be generated for you automatically
if ($postData['ref']) {
    $prefix = $postData['ref'];
    $overrideRef = true;
}

$payment = new Rave($_SESSION['secretKey'], $prefix, $overrideRef);

// get url function

if ($postData['amount']) {
    // Make payment
    $payment
        ->eventHandler(new myEventHandler)
        ->setAmount($postData['amount'])
        ->setPaymentOptions($postData['payment_options']) // value can be card, account or both
        ->setDescription($postData['description'])
        ->setLogo($postData['logo'])
        ->setTitle($postData['title'])
        ->setCountry($postData['country'])
        ->setCurrency($postData['currency'])
        ->setEmail($postData['email'])
        ->setFirstname($postData['firstname'])
        ->setLastname($postData['lastname'])
        ->setPhoneNumber($postData['phonenumber'])
        ->setPayButtonText($postData['pay_button_text'])
        ->setRedirectUrl($URL)
        // ->setMetaData(array('metaname' => 'SomeDataName', 'metavalue' => 'SomeValue')) // can be called multiple times. Uncomment this to add meta datas
        // ->setMetaData(array('metaname' => 'SomeOtherDataName', 'metavalue' => 'SomeOtherValue')) // can be called multiple times. Uncomment this to add meta datas
        ->initialize();
} else {
    if ($getData['cancelled'] && $getData['tx_ref']) {
        // Handle canceled payments
        $payment
            ->eventHandler(new myEventHandler)
            ->requeryTransaction($getData['tx_ref'])
            ->paymentCanceled($getData['tx_ref']);
    } elseif ($getData['tx_ref']) {
        // Handle completed payments
        $payment->logger->notice('Payment completed. Now requerying payment.');

        $payment
            ->eventHandler(new myEventHandler)
            ->requeryTransaction($getData['tx_ref']);
    } else {
        $payment->logger->warning('Stop!!! Please pass the txref parameter!');
        echo 'Stop!!! Please pass the txref parameter!';
    }
}
