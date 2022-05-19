<?php
session_start();
/*
* Designed and programmed by
* @Author: Francis A. Anlimah
*/

require "../bootstrap.php";

use Src\Controller\RegistrationController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$user = new RegistrationController();

if ($_SERVER['REQUEST_METHOD'] == "GET") {

	// All POST request will be sent here
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {

	// verify applicant provided details
	if ($_GET["url"] == "verifyStep1") {
		$message = array("response" => "error", "msg" => "Invalid request!");

		if (isset($_SESSION["_step1Token"]) && !empty($_SESSION["_step1Token"])) {
			if (isset($_POST["_vToken"]) && !empty($_POST["_vToken"])) {
				if ($_POST["_vToken"] != $_SESSION["_step1Token"]) {
					die(json_encode($message));
				} else {
					$full_name = $user->validateInput($_POST["full_name"]);
					$gender = $user->validateInput($_POST["gender"]);
					$dob = $user->validateInput($_POST["dob"]);
					$country = $user->validateInput($_POST["country"]);

					$_SESSION["register"] = array();
					array_push($_SESSION["register"], $full_name, $gender, $dob, $country);
					echo json_encode($_SESSION["register"]);

					/*$user_id = $user->saveApplicantDetails($first_name, $last_name, $phone_num, $email_addr);
					if ($user_id) {
						if ($_POST["h_verify"] == "email") {
							// send email and prompt user
							if ($user->sendEmail($email_addr, $user_id)) {
								die(json_encode(array('response' => 'success', 'msg' => 'A 6 digit code has been sent to ' . $email_addr . '.')));
							} else {
								die(json_encode(array('response' => 'error', 'msg' => 'Failed to send mail!')));
							}
						} elseif ($_POST["h_verify"] == "phone") {
							// send SMS and prompt
							if ($user->sendSMS($phone_num, $user_id)) {
								die(json_encode(array('response' => 'success', 'msg' => 'A 6 digit code has been sent to ' . $phone_num . '.')));
							} else {
								die(json_encode(array('response' => 'error', 'msg' => 'Failed to send SMS!')));
							}
						} else {
							die(json_encode($message));
						}
					} else {
						die(json_encode(array('response' => 'error', 'msg' => 'Internal server error!')));
					}*/
				}
			} else {
				die(json_encode($message));
			}
		} else {
			die(json_encode($message));
		}
	}

	// verify code or email sent to SMS or email
	if ($_GET["url"] == "verifyApplicantCode") {
		$message = array("response" => "error", "msg" => "Invalid request!");

		if (isset($_SESSION["_codeVToken"]) && !empty($_SESSION["_codeVToken"])) {
			if (isset($_POST["_cToken"]) && !empty($_POST["_cToken"])) {
				if ($_POST["_cToken"] == $_SESSION["_codeVToken"]) {
					$code = $_POST["num1"] . $_POST["num2"] . $_POST["num3"] . $_POST["num4"] . $_POST["num5"] . $_POST["num6"];
					//verify code
					//if it match 
					die(json_encode(array("response" => "success", "msg" => $code)));
				} else {
					die(json_encode($message));
				}
			} else {
				die(json_encode($message));
			}
		} else {
			die(json_encode($message));
		}
	}
} elseif ($_SERVER['REQUEST_METHOD'] == "PUT") {
} elseif ($_SERVER['REQUEST_METHOD'] == "DELETE") {
} else {
	http_response_code(405);
}
