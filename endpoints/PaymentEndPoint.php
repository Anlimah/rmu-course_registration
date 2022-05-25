<?php
// Prevent direct access to this class
define("BASEPATH", 1);

require_once("../bootstrap.php");

include('../vendor/flutterwavedev/flutterwave-v3/library/rave.php');
include('../vendor/flutterwavedev/flutterwave-v3/library/Transfer.php');

$flw = new \Flutterwave\Rave(getenv('SECRET_KEY')); // Set `PUBLIC_KEY` as an environment variable
$transferService = new \Flutterwave\Transfer();
$details = [
    "account_bank" => "044",
    "account_number" => "0690000031",
    "amount" => 200,
    "narration" => "Payment for things",
    "currency" => "GH",
    "destination_branch_code" => "GH280103",
    "beneficiary_name" => "Kwame Adew",
    "reference" => 1,
    "callback_url" => "https://webhook.site/b3e505b0-fe02-430e-a538-22bbbce8ce0d",
    "debit_currency" => "GH"
];
$response = $transferService->singleTransfer($details);

var_dump($response);
