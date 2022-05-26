<?php
// Prevent direct access to this class
define("BASEPATH", 1);

require_once("../bootstrap.php");
include('../vendor/flutterwavedev/flutterwave-v3/library/Transfer.php');

use Flutterwave\Transfer;

$payload = [
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

$transferService = new Transfer();
$response = $transferService->singleTransfer($payload);

var_dump($response);
