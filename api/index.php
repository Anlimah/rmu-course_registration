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
header("Access-Control-Allow-Methods: GET,POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$user = new RegistrationController();

if ($_SERVER['REQUEST_METHOD'] == "GET") {
	if ($_GET["url"] == "verifyStepFinal") {
		//echo json_encode($user->getAllProInfo());
		$arr = array();
		array_push($arr, $_SESSION["step1"], $_SESSION["step2"], $_SESSION["step4"], $_SESSION["step6"], $_SESSION["step7"]);
		echo json_encode($arr);
		//verify all sessions
		//save all user data
		//echo success message
	}
	// All POST request will be sent here
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {

	// verify applicant provided details
	if ($_GET["url"] == "verifyStep1") {
		$message = array("response" => "error", "msg" => "Invalid request!");

		if (isset($_SESSION["_step1Token"]) && !empty($_SESSION["_step1Token"])) {
			if (isset($_POST["_v1Token"]) && !empty($_POST["_v1Token"])) {
				if ($_POST["_v1Token"] != $_SESSION["_step1Token"]) {
					die(json_encode($message));
				} else {
					$first_name = $user->validateInput($_POST["first_name"]);
					$last_name = $user->validateInput($_POST["last_name"]);
					$gender = $user->validateInput($_POST["gender"]);
					$dob = $user->validateInput($_POST["dob"]);
					$country = $user->validateInput($_POST["country"]);

					$_SESSION["step1"] = array(
						"first_name" => $first_name,
						"last_name" => $last_name,
						"gender" => $gender,
						"dob" => $dob,
						"country" => $country
					);
					echo json_encode($_SESSION["step1"]);
					$_SESSION['step1Done'] = true;
				}
			} else {
				die(json_encode($message));
			}
		} else {
			die(json_encode($message));
		}
	} elseif ($_GET["url"] == "verifyStep2") {
		$message = array("response" => "error", "msg" => "Invalid request!");

		if (isset($_SESSION["_step2Token"]) && !empty($_SESSION["_step2Token"])) {
			if (isset($_POST["_v2Token"]) && !empty($_POST["_v2Token"])) {
				if ($_POST["_v2Token"] != $_SESSION["_step2Token"]) {
					die(json_encode($message));
				} else {
					$_SESSION["step2"] = array("email_address" => $user->validateInput($_POST["email_address"]));
					echo json_encode($_SESSION["step2"]);
					$_SESSION['step2Done'] = true;
				}
			} else {
				die(json_encode($message));
			}
		} else {
			die(json_encode($message));
		}
	} elseif ($_GET["url"] == "verifyStep3") {
		$message = array("response" => "error", "msg" => "Invalid request!");

		if (isset($_SESSION["_step3Token"]) && !empty($_SESSION["_step3Token"])) {
			if (isset($_POST["_v3Token"]) && !empty($_POST["_v3Token"])) {
				if ($_POST["_v3Token"] != $_SESSION["_step3Token"]) {
					die(json_encode($message));
				} else {
					if ($_POST["num"]) {
						$otp = "";
						foreach ($_POST["num"] as $num) {
							$otp .= $num;
						}
						echo json_encode(array("otp" => $otp));
						$_SESSION['step3Done'] = true;
					}
				}
			} else {
				die(json_encode($message));
			}
		} else {
			die(json_encode($message));
		}
	} elseif ($_GET["url"] == "verifyStep4") {
		$message = array("response" => "error", "msg" => "Invalid request!");

		if (isset($_SESSION["_step4Token"]) && !empty($_SESSION["_step4Token"])) {
			if (isset($_POST["_v4Token"]) && !empty($_POST["_v4Token"])) {
				if ($_POST["_v4Token"] != $_SESSION["_step4Token"]) {
					die(json_encode($message));
				} else {
					$phone_number = $user->validateInput($_POST["phone_number"]);
					$_SESSION["step4"] = array("phone_number" => $phone_number);
					//echo json_encode($_SESSION["step4"]);
					echo $user->sendSMS($phone_number);
					$_SESSION['step4Done'] = true;
				}
			} else {
				die(json_encode($message));
			}
		} else {
			die(json_encode($message));
		}
	} elseif ($_GET["url"] == "verifyStep5") {
		$message = array("response" => "error", "msg" => "Invalid request!");

		if (isset($_SESSION["_step5Token"]) && !empty($_SESSION["_step5Token"])) {
			if (isset($_POST["_v5Token"]) && !empty($_POST["_v5Token"])) {
				if ($_POST["_v5Token"] != $_SESSION["_step5Token"]) {
					die(json_encode($message));
				} else {
					if ($_POST["code"]) {
						$otp = "";
						foreach ($_POST["code"] as $code) {
							$otp .= $code;
						}
						if ($otp == $_SESSION['sms_code']) {
							echo json_encode(array("status" => "success"));
							$_SESSION['step5Done'] = true;
						} else {
							echo json_encode(array("status" => "error"));
						}
					}
				}
			} else {
				die(json_encode($message));
			}
		} else {
			die(json_encode($message));
		}
	} elseif ($_GET["url"] == "verifyStep6") {
		$message = array("response" => "error", "msg" => "Invalid request!");

		if (isset($_SESSION["_step6Token"]) && !empty($_SESSION["_step6Token"])) {
			if (isset($_POST["_v6Token"]) && !empty($_POST["_v6Token"])) {
				if ($_POST["_v6Token"] != $_SESSION["_step6Token"]) {
					die(json_encode($message));
				} else {
					$form_type = $user->validateInput($_POST["form_type"]);
					$pay_method = $user->validateInput($_POST["pay_method"]);

					$amount = $user->getFormPrice($form_type)[0]["amount"];

					if ($amount) {
						$_SESSION["step6"] = array(
							"form_type" => $form_type,
							"pay_method" => $pay_method,
							"amount" => $amount
						);
						echo json_encode($_SESSION["step6"]);
						$_SESSION['step6Done'] = true;
					}
				}
			} else {
				die(json_encode($message));
			}
		} else {
			die(json_encode($message));
		}
	} elseif ($_GET["url"] == "verifyStep7Momo") {
		$message = array("response" => "error", "msg" => "Invalid request!");

		if (isset($_SESSION["_step7MomoToken"]) && !empty($_SESSION["_step7MomoToken"])) {
			if (isset($_POST["_v7MomoToken"]) && !empty($_POST["_v7MomoToken"])) {
				if ($_POST["_v7MomoToken"] != $_SESSION["_step7MomoToken"]) {
					die(json_encode($message));
				} else {
					$momo_agent = $user->validateInput($_POST["momo_agent"]);
					$momo_number = $user->validateInput($_POST["momo_number"]);
					$_SESSION["step7"] = array("momo_agent" => $momo_agent, "momo_number" => $momo_number);
					echo json_encode($_SESSION["step7"]);
					$_SESSION['step7Done'] = true;
					//if ($_SESSION['step7Done']) header('Location: ../src/Controller/PaymentController.php');
					//$user->payViaMomo();
				}
			} else {
				die(json_encode($message));
			}
		} else {
			die(json_encode($message));
		}
	} elseif ($_GET["url"] == "verifyStep7Bank") {
		$message = array("response" => "error", "msg" => "Invalid request!");

		if (isset($_SESSION["_step7BankToken"]) && !empty($_SESSION["_step7BankToken"])) {
			if (isset($_POST["_v7BankToken"]) && !empty($_POST["_v7BankToken"])) {
				if ($_POST["_v7BankToken"] != $_SESSION["_step7BankToken"]) {
					die(json_encode($message));
				} else {
					$currency = $user->validateInput($_POST["currency"]);
					$bank = $user->validateInput($_POST["bank"]);
					$account_number = $user->validateInput($_POST["account_number"]);
					$_SESSION["step7"] = array("currency" => $currency, "bank" => $bank, "account_number" => $account_number);
					echo json_encode($_SESSION["step7"]);
					$_SESSION['step7Done'] = true;
					//if ($_SESSION['step7Done']) header('Location: ../src/Controller/PaymentController.php');
					//$user->payViaBank();
				}
			} else {
				die(json_encode($message));
			}
		} else {
			die(json_encode($message));
		}
	} elseif ($_GET[''] == '') {
	}
} else {
	http_response_code(405);
}
