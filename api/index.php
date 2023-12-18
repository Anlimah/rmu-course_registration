<?php
session_start();
/*
* Designed and programmed by
* @Author: Francis A. Anlimah
*/

require "../bootstrap.php";

use Src\Controller\UsersController;
use Src\Controller\ExposeDataController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$user = new UsersController($host, $port, $db, $user, $pass);
$expose = new ExposeDataController();

// Handles all GET requests
if ($_SERVER['REQUEST_METHOD'] == "GET") {
}

// Handles all POST requests
else if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_GET["url"] == "studentLogin") {
        if (
            !isset($_SESSION["_start"]) ||
            empty($_SESSION["_start"]) ||
            $_POST["_logToken"] != $_SESSION["_start"]
        ) die(json_encode(array("success" => true, "message" => "Invalid request!")));

        $da = $expose->validateEmail($_POST["email"]);

        if (!isset($_POST["app_number"]) || empty($_POST["app_number"]))
            die(json_encode(array("response" => "error", "message" => "Incorrect application number or PIN!")));
        if (!isset($_POST["pin_code"]) || empty($_POST["pin_code"]))
            die(json_encode(array("response" => "error", "message" => "Incorrect application number or PIN!")));

        $app_number = $expose->validateInputTextNumber(substr($_POST["app_number"], 4));
        $pin_code = $expose->validatePassword($_POST["pin_code"]);
        $result = $user->verifyLoginDetails($app_number, $pin_code);

        if (!$result) die(json_encode(array("response" => "error", "message" => "Incorrect application number or PIN! ")));

        $_SESSION['ghApplicant'] = $result["id"];
        $_SESSION['applicantType'] = $result["type"];
        $_SESSION['submitted'] = $result["submitted"];
        $_SESSION['ghAppLogin'] = true;
        $type = "";

        switch ($result["type"]) {
            case 1:
                $type = 'postgraduate/welcome.php';
                $_SESSION['loginType'] = $type;
                break;

            default:
                $type = 'undergraduate/welcome.php';
                $_SESSION['loginType'] = $type;
                break;
        }

        die(json_encode(array("response" => "success", "message" => $type, "state" => $state)));
    }
} else {
    http_response_code(405);
}
