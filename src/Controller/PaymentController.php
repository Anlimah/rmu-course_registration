<?php
session_start();
// Prevent direct access to this class
define("BASEPATH", 1);

require_once("../../bootstrap.php");

include('../../vendor/flutterwavedev/flutterwave-v3/library/rave.php');
include('../../vendor/flutterwavedev/flutterwave-v3/library/raveEventHandlerInterface.php');

use Flutterwave\Rave;
use Flutterwave\EventHandlerInterface;

//$URL = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$URL = 'https://localhost/rmu_admissions/purchase/purchase_confirm.php';

$getData = $_GET;
$postData = $_POST;

if (isset($_SESSION["step6"]["amount"])) {
    $_SESSION['publicKey'] = getenv('PUBLIC_KEY');
    $_SESSION['secretKey'] = getenv('SECRET_KEY');
    $_SESSION['env'] = $_SERVER['ENV'];
    $_SESSION['successurl'] = $URL;
    $_SESSION['failureurl'] = $URL;
}

$country = 'GH';
$currency = 'GHS';
$ref = time();
$description = 'Paying ' . $_SESSION["step6"]["amount"] . ' for ' . $_SESSION["step6"]["form_type"] . ' application forms.';
$payment_opts = '';
if ($_SESSION["step6"]['pay_method'] == 'Momo') {
    $payment_opts = 'mobilemoneyghana';
} else {
    $payment_opts = 'card, account, mobilemoneyghana, banktransfer';
}

$prefix = 'RMU'; // Change this to the name of your business or app
$overrideRef = false;

// Uncomment here to enforce the useage of your own ref else a ref will be generated for you automatically
if ($ref) {
    $prefix = $ref;
    $overrideRef = true;
}

$payment = new Rave($_SESSION['secretKey'], $prefix, $overrideRef);


function getURL($url, $data = array())
{
    $urlArr = explode('?', $url);
    $params = array_merge($_GET, $data);
    $new_query_string = http_build_query($params) . '&' . $urlArr[1];
    $newUrl = $urlArr[0] . '?' . $new_query_string;
    return $newUrl;
};


// This is where you set how you want to handle the transaction at different stages
class myEventHandler implements EventHandlerInterface
{
    /**
     * This is called when the Rave class is initialized
     * */
    function onInit($initializationData)
    {
        // Save the transaction to your DB.
    }

    /**
     * This is called only when a transaction is successful
     * */
    function onSuccessful($transactionData)
    {
        // Get the transaction from your DB using the transaction reference (txref)
        // Check if you have previously given value for the transaction. If you have, redirect to your successpage else, continue
        // Comfirm that the transaction is successful
        // Confirm that the chargecode is 00 or 0
        // Confirm that the currency on your db transaction is equal to the returned currency
        // Confirm that the db transaction amount is equal to the returned amount
        // Update the db transaction record (includeing parameters that didn't exist before the transaction is completed. for audit purpose)
        // Give value for the transaction
        // Update the transaction to note that you have given value for the transaction
        // You can also redirect to your success page from here
        if ($transactionData->status === 'successful') {
            if ($transactionData->currency == $_SESSION['currency'] && $transactionData->amount == $_SESSION['amount']) {

                if ($_SESSION['publicKey']) {
                    header('Location: ' . getURL($_SESSION['successurl'], array('event' => 'successful')));
                    $_SESSION = array();
                    session_destroy();
                }
            } else {
                if ($_SESSION['publicKey']) {
                    header('Location: ' . getURL($_SESSION['failureurl'], array('event' => 'suspicious')));
                    $_SESSION = array();
                    session_destroy();
                }
            }
        } else {
            $this->onFailure($transactionData);
        }
    }

    /**
     * This is called only when a transaction failed
     * */
    function onFailure($transactionData)
    {
        // Get the transaction from your DB using the transaction reference (txref)
        // Update the db transaction record (includeing parameters that didn't exist before the transaction is completed. for audit purpose)
        // You can also redirect to your failure page from here
        if ($_SESSION['publicKey']) {
            header('Location: ' . getURL($_SESSION['failureurl'], array('event' => 'failed')));
            $_SESSION = array();
            session_destroy();
        }
    }

    /**
     * This is called when a transaction is requeryed from the payment gateway
     * */
    function onRequery($transactionReference)
    {
        // Do something, anything!
    }

    /**
     * This is called a transaction requery returns with an error
     * */
    function onRequeryError($requeryResponse)
    {
        echo 'the transaction was not found';
    }

    /**
     * This is called when a transaction is canceled by the user
     * */
    function onCancel($transactionReference)
    {
        // Do something, anything!
        // Note: Somethings a payment can be successful, before a user clicks the cancel button so proceed with caution
        if ($_SESSION['publicKey']) {
            header('Location: ' . getURL($_SESSION['failureurl'], array('event' => 'canceled')));
            $_SESSION = array();
            session_destroy();
        }
    }

    /**
     * This is called when a transaction doesn't return with a success or a failure response. This can be a timedout transaction on the Rave server or an abandoned transaction by the customer.
     * */
    function onTimeout($transactionReference, $data)
    {
        // Get the transaction from your DB using the transaction reference (txref)
        // Queue it for requery. Preferably using a queue system. The requery should be about 15 minutes after.
        // Ask the customer to contact your support and you should escalate this issue to the flutterwave support team. Send this as an email and as a notification on the page. just incase the page timesout or disconnects
        if ($_SESSION['publicKey']) {
            header('Location: ' . getURL($_SESSION['failureurl'], array('event' => 'timedout')));
            $_SESSION = array();
            session_destroy();
        }
    }
}


if ($_SESSION["step6"]['amount']) {
    // Make payment
    $payment
        ->eventHandler(new myEventHandler)
        ->setAmount($_SESSION["step6"]['amount'])
        ->setPaymentOptions($payment_opts) // value can be card, account or both
        ->setDescription($description)
        //->setLogo($postData['logo'])
        //->setTitle($postData['title'])
        ->setCountry($country)
        ->setCurrency($currency)
        ->setEmail($_SESSION["step2"]['email_address'])
        ->setFirstname($_SESSION["step1"]['first_name'])
        ->setLastname($_SESSION["step1"]['last_name'])
        ->setPhoneNumber($_SESSION["step4"]['phone_number'])
        //->setPayButtonText($postData['pay_button_text'])
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
