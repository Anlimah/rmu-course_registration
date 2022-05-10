<?php
session_start();
/*
* Designed and programmed by
* @Author: Francis A. Anlimah
*/
require_once("../classes/users_handler.php");
$user = new UsersHandler();

if ($_SERVER['REQUEST_METHOD'] == "GET") {

	// All POST request will be sent here
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {

	// verify applicant provided details
	if ($_GET["url"] == "verifyApplicant") {
		$message = array("response" => "error", "msg" => "Invalid request!");

		if (isset($_SESSION["_applicantToken"]) && !empty($_SESSION["_applicantToken"])) {
			if (isset($_POST["_vToken"]) && !empty($_POST["_vToken"])) {
				if ($_POST["_vToken"] != $_SESSION["_applicantToken"]) {
					die(json_encode($message));
				} else {
					$first_name = $user->validateInput($_POST["first_name"]);
					$last_name = $user->validateInput($_POST["last_name"]);
					$phone_num = $user->validatePhone($_POST["phone_num"]);
					$email_addr = $user->validateEmail($_POST["email_addr"]);

					$user_id = $user->saveApplicantDetails($first_name, $last_name, $phone_num, $email_addr);
					if ($user_id) {
						if ($_POST["h_verify"] == "email") {
							// send email and prompt user
							if ($user->sendEmail($email_addr, $user_id)) {
								die(json_encode(array('response' => 'success', 'msg' => 'A 6 digit code has been sent to ' . $email_addr . '.')));
							} else {
								die(json_encode(array('response' => 'error', 'msg' => 'Invalid email address!')));
							}
						} elseif ($_POST["h_verify"] == "phone") {
							// send SMS and prompt
							if ($user->sendSMS($phone_num, $user_id)) {
								die(json_encode(array('response' => 'success', 'msg' => 'A 6 digit code has been sent to ' . $phone_num . '.')));
							} else {
								die(json_encode(array('response' => 'error', 'msg' => 'Invalid phone number!')));
							}
						} else {
							die(json_encode($message));
						}
					} else {
						die(json_encode(array('response' => 'error', 'msg' => 'Internal server error!')));
					}
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
