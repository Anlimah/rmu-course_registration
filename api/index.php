<?php
session_start();
/*
* Designed and programmed by
* @Author: Francis A. Anlimah
*/

require "../bootstrap.php";

use Src\Controller\StudentController;
use Src\Controller\ExposeDataController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$user = new StudentController($host, $port, $db, $user, $pass);
$expose = new ExposeDataController();

// Handles all GET requests
if ($_SERVER['REQUEST_METHOD'] == "GET") {

    // student data after successfull login
    if ($_GET["url"] == "studentLoginSet") {

        if (!isset($_POST["studentIndexNumber"]) || empty($_POST["studentIndexNumber"]))
            die(json_encode(array("success" => false, "message" => "Invalid request!")));
    }

    // student data
    else if ($_GET["url"] == "studentData") {

        if (!isset($_POST["studentIndexNumber"]) || empty($_POST["studentIndexNumber"]))
            die(json_encode(array("success" => false, "message" => "Invalid request!")));
    }

    // student courses for the semester
    else if ($_GET["url"] == "semesterCourses") {

        if (!isset($_POST["studentIndexNumber"]) || empty($_POST["studentIndexNumber"]))
            die(json_encode(array("success" => false, "message" => "Invalid request!")));
    }
}

// Handles all POST requests
else if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // student login
    if ($_GET["url"] == "studentLogin") {

        if (!isset($_SESSION["_start"]) || !isset($_POST["_logToken"]) || empty($_SESSION["_start"]) || empty($_POST["_logToken"]))
            die(json_encode(array("success" => false, "message" => "Missing required parameters!")));

        if ($_POST["_logToken"] !== $_SESSION["_start"]) die(json_encode(array("success" => false, "message" => "Invalid request!")));
        if (!isset($_POST["index_number"])) die(json_encode(array("success" => false, "message" => "Missing input: Index number is required!")));
        if (!isset($_POST["password"])) die(json_encode(array("success" => false, "message" => "Missing input: Password is required!")));

        $index_number = $expose->validateIndexNumber($_POST["index_number"]);
        $password = $expose->validatePassword($_POST["password"]);
        $result = $user->loginUser($index_number, $password);

        if (!$result) {
            $_SESSION['isLoggedIn'] = true;
            die(json_encode(array("success" => false, "message" => "Incorrect index number or password! ")));
        }

        $_SESSION['studentIndexNumber'] = $result["index_number"];
        $_SESSION['isLoggedIn'] = true;

        die(json_encode(array("success" => true, "message" => "Login successfull!")));
    }

    // Register courses
    else if ($_GET["url"] == "registerCourses") {
    }
} else {
    http_response_code(405);
}
