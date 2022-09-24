<?php
session_start();
/*
* Designed and programmed by
* @Author: Francis A. Anlimah
*/

require "../bootstrap.php";

use Src\Controller\UsersController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$user = new UsersController();

if ($_SERVER['REQUEST_METHOD'] == "GET") {
	if ($_GET["url"] == "verifyStepFinal") {
		//echo json_encode($user->getAllProInfo());
		$arr = array();
		array_push($arr, $_SESSION["step1"], $_SESSION["step2"], $_SESSION["step4"], $_SESSION["step6"], $_SESSION["step7"]);
		echo json_encode($arr);
		//verify all sessions
		//save all user data
		//echo success message
	} elseif ($_GET["url"] == "personal") {
		echo json_encode($user->fetchApplicantPersI($_SESSION['ghApplicant']));
	} elseif ($_GET["url"] == "") {
		//fetch in Acaedmic backgorund
		echo json_encode($user->fetchApplicantAcaB($user_id));
	} elseif ($_GET["url"] == "") {
		//fetch in Programs information
		echo json_encode($user->fetchApplicantProgI($user_id));
	} elseif ($_GET["url"] == "") {
		//fetch in Previous university information
		echo json_encode($user->fetchApplicantPreUni($user_id));
	} elseif ($_GET["url"] == "") {
		//fetch in Previous university information
		echo json_encode($user->fetchApplicantPreUni($user_id));
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
					/*$gender = $user->validateInput($_POST["gender"]);
					$dob = $user->validateInput($_POST["dob"]);*/
					$country = $user->validateInput($_POST["country"]);

					$_SESSION["step1"] = array(
						"first_name" => $first_name,
						"last_name" => $last_name,
						//"gender" => $gender,
						//"dob" => $dob,
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
					$otp_code = $user->genCode(4);
					$message = 'Your OTP verification code is';
					echo $user->sendSMS($phone_number, $otp_code, $message);
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

					if ($form_type == 'Undergraduate' || $form_type == 'Short courses') {
						$app_type = 1;
					} else if ($form_type == 'Postgraduate') {
						$app_type = 2;
					}

					$app_year = $user->getAdminYearCode();

					if ($amount) {
						$_SESSION["step6"] = array(
							'user' => microtime(true),
							"form_type" => $form_type,
							"pay_method" => $pay_method,
							"amount" => $amount,
							"app_type" => $app_type,
							"app_year" => $app_year,
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
	} elseif ($_GET["url"] == "appLogin") {
		$message = array("response" => "error", "msg" => "Invalid request!");

		if (isset($_SESSION["_start"]) && !empty($_SESSION["_start"])) {
			if ($_POST["_logToken"] != $_SESSION["_start"]) {
				die(json_encode(array("response" => "error", "msg" => "Invalid request!")));
			} else {
				$app_number = "RMU-" . $user->validateInput($_POST["app_number"]);
				$pin_code = $user->validateInput($_POST["pin_code"]);

				$result = $user->verifyLoginDetails($app_number, $pin_code);

				if (!$result) {
					die(json_encode(array("response" => "error", "msg" => "Incorrect application number or PIN! " . $user_id)));
				} else {
					$_SESSION['ghApplicant'] = $result["id"];
					$_SESSION['ghAppLogin'] = true;
					$type = "";

					switch ($result["type"]) {
						case 1:
							$type = 'postgraduate';
							break;
						case 2:
							$type = 'undergraduate';
							break;

						default:
							$type = 'none';
							break;
					}
					echo json_encode(array("response" => "success", "msg" => $type));
				}
			}
		} else {
			echo 'NO';
		}
	} elseif ($_GET["url"] == "verify") {
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$uri = explode('/', $uri);

		switch ($uri[4]) {
			case 'personal-info':
				echo json_encode($user->verify_form($uri[4]));
				break;

			default:
				echo json_encode(array("response" => "error", "msg" => "Invalid Request!"));
				break;
		}

		/*if ($uri[4] == 1) {
		} elseif ($uri[4] == 2) {
		} elseif ($uri[4] == 3) {
		} elseif ($uri[4] == 4) {
			$message = array("response" => "success");
			echo json_encode($message);
		}*/
	}
	/*
	adding Education
	*/
	if ($_GET["url"] == "addEducation") {
		$errors = [];
		$data = [];

		//step 1
		$sch_name = $user->validateInputTextOnly($_POST["sch_name"]);
		if ($sch_name['status'] == "error") {
			$errors['sch_name'] = 'School Name is ' . $sch_name['message'] . '.';
		}

		$sch_country = $user->validateInputTextOnly($_POST["sch_country"]);
		if ($sch_country['status'] == "error") {
			$errors['sch_country'] = 'School Country is ' . $sch_country['message'] . '.';
		}

		$sch_region = $user->validateInputTextOnly($_POST["sch_region"]);
		if ($sch_region['status'] == "error") {
			$errors['sch_region'] = 'School Province/Region is ' . $sch_region['message'] . '.';
		}

		$sch_city = $user->validateInputTextOnly($_POST["sch_city"]);
		if ($sch_city['status'] == "error") {
			$errors['sch_city'] = 'School City is ' . $sch_city['message'] . '.';
		}

		//step 2
		$cert_type = $user->validateInputTextOnly($_POST["cert_type"]);
		if ($cert_type['status'] == "error") {
			$errors['cert_type'] = 'Certificate/Degree Earned is ' . $cert_type['message'] . '.';
		}

		$index_number = $user->validateInputTextNumber($_POST["index_number"]);
		if ($index_number['status'] == "error") {
			$errors['index_number'] = 'Index Number is ' . $index_number['message'] . '.';
		}

		$month_started = $user->validateInputTextOnly($_POST["month_started"]);
		if ($month_started['status'] == "error" || $_POST['month_started'] == "Month") {
			$errors['date_started'] = 'Date Started is invalid.';
		}

		$year_started = $user->validateYearData($_POST["year_started"]);
		if ($year_started['status'] == "error" || $_POST['year_started'] == "Year") {
			$errors['date_started'] = 'Date Started is invalid.';
		}

		$month_completed = $user->validateInputTextOnly($_POST["month_completed"]);
		if ($month_completed['status'] == "error" || $_POST['month_completed'] == "Month") {
			$errors['date_completed'] = 'Date Completed is invalid.';
		}

		$year_completed = $user->validateYearData($_POST["year_completed"]);
		if ($year_completed['status'] == "error" || $_POST['year_completed'] == "Year") {
			$errors['date_completed'] = 'Date Completed is invalid.';
		}

		//step 3
		$course_studied = $user->validateInputTextOnly($_POST["course_studied"]);
		if ($course_studied['status'] == "error" || $_POST['course_studied'] == "Select") {
			$errors['course_studied'] = 'Course/Program of Study is ' . $course_studied['message'] . '.';
		}

		//core subjects
		$core_sbj1 = $user->validateInputTextOnly($_POST["core_sbj1"]);
		if ($core_sbj1['status'] == "error" || $_POST['core_sbj1'] == "Select") {
			$errors['core_sbj_grp1'] = 'Subject is ' . $core_sbj1['message'] . '.';
		}
		$core_sbj2 = $user->validateInputTextOnly($_POST["core_sbj2"]);
		if ($core_sbj2['status'] == "error" || $_POST['core_sbj2'] == "Select") {
			$errors['core_sbj_grp2'] = 'Subject is ' . $core_sbj2['message'] . '.';
		}
		$core_sbj3 = $user->validateInputTextOnly($_POST["core_sbj3"]);
		if ($core_sbj3['status'] == "error" || $_POST['core_sbj3'] == "Select") {
			$errors['core_sbj_grp3'] = 'Subject is ' . $core_sbj3['message'] . '.';
		}
		$core_sbj4 = $user->validateInputTextOnly($_POST["core_sbj4"]);
		if ($core_sbj4['status'] == "error" || $_POST['core_sbj4'] == "Select") {
			$errors['core_sbj_grp4'] = 'Subject is ' . $core_sbj4['message'] . '.';
		}

		//core subjects grades
		$core_sbj_grd1 = $user->validateGrade($_POST["core_sbj_grd1"]);
		if ($core_sbj_grd1['status'] == "error") {
			$errors['core_sbj_grp1'] = 'Subject\'s grade is ' . $core_sbj_grd1['message'] . '.';
		}
		$core_sbj_grd2 = $user->validateGrade($_POST["core_sbj_grd2"]);
		if ($core_sbj_grd2['status'] == "error") {
			$errors['core_sbj_grp2'] = 'Subject\'s grade is ' . $core_sbj_grd2['message'] . '.';
		}
		$core_sbj_grd3 = $user->validateGrade($_POST["core_sbj_grd3"]);
		if ($core_sbj_grd3['status'] == "error") {
			$errors['core_sbj_grp3'] = 'Subject\'s grade is ' . $core_sbj_grd3['message'] . '.';
		}
		$core_sbj_grd4 = $user->validateGrade($_POST["core_sbj_grd4"]);
		if ($core_sbj_grd4['status'] == "error") {
			$errors['core_sbj_grp4'] = 'Subject\'s grade is ' . $core_sbj_grd4['message'] . '.';
		}


		//elective subjects
		$elective_sbj1 = $user->validateInputTextOnly($_POST["elective_sbj1"]);
		if ($elective_sbj1['status'] == "error" || $_POST['elective_sbj1'] == "Select") {
			$errors['elective_sbj_grp1'] = 'Subject is ' . $elective_sbj1['message'] . '.';
		}
		$elective_sbj2 = $user->validateInputTextOnly($_POST["elective_sbj2"]);
		if ($elective_sbj2['status'] == "error" || $_POST['elective_sbj2'] == "Select") {
			$errors['elective_sbj_grp2'] = 'Subject is ' . $elective_sbj2['message'] . '.';
		}
		$elective_sbj3 = $user->validateInputTextOnly($_POST["elective_sbj3"]);
		if ($elective_sbj3['status'] == "error" || $_POST['elective_sbj3'] == "Select") {
			$errors['elective_sbj_grp3'] = 'Subject is ' . $elective_sbj3['message'] . '.';
		}
		$elective_sbj4 = $user->validateInputTextOnly($_POST["elective_sbj4"]);
		if ($elective_sbj4['status'] == "error" || $_POST['elective_sbj4'] == "Select") {
			$errors['elective_sbj_grp4'] = 'Subject is ' . $elective_sbj4['message'] . '.';
		}

		//core subjects grades
		$elective_sbj_grd1 = $user->validateGrade($_POST["elective_sbj_grd1"]);
		if ($elective_sbj_grd1['status'] == "error") {
			$errors['elective_sbj_grp1'] = 'Subject\'s grade is ' . $elective_sbj_grd1['message'] . '.';
		}
		$elective_sbj_grd2 = $user->validateGrade($_POST["elective_sbj_grd2"]);
		if ($elective_sbj_grd2['status'] == "error") {
			$errors['elective_sbj_grp2'] = 'Subject\'s grade is ' . $elective_sbj_grd2['message'] . '.';
		}
		$elective_sbj_grd3 = $user->validateGrade($_POST["elective_sbj_grd3"]);
		if ($elective_sbj_grd3['status'] == "error") {
			$errors['elective_sbj_grp3'] = 'Subject\'s grade is ' . $elective_sbj_grd3['message'] . '.';
		}
		$elective_sbj_grd4 = $user->validateGrade($_POST["elective_sbj_grd4"]);
		if ($elective_sbj_grd4['status'] == "error") {
			$errors['elective_sbj_grp4'] = 'Subject\'s grade is ' . $elective_sbj_grd4['message'] . '.';
		}

		$response = "";

		if (!empty($errors)) {
			$data['success'] = false;
			$data['errors'] = $errors;
		} else {
			$data['success'] = true;
			$data['message'] = 'Success!';

			$response = json_encode($user->saveEducation());
		}

		echo json_encode($data);
	}
} else if ($_SERVER['REQUEST_METHOD'] == "PUT") {
	parse_str(file_get_contents("php://input"), $_PUT);

	if ($_GET["url"] == "personal") {

		$what = $_PUT["what"];
		$value = strtoupper($user->validateInput($_PUT['value']));

		if (isset($what) && !empty($what)) {
			$column = str_replace("-", "_", $what);

			if ($column == "dob") {
				$value = str_replace("/", "-", $value);
			}
			if ($column == "disability_descript") {
				$column = 'disability';
			}

			//Place of birth 
			if ($column == "region_birth") {
				$column = 'spr_birth';
			}
			if ($column == "home_town") {
				$column = 'city_birth';
			}

			//Language
			if ($column == "english_native") {
				if ($value == "Yes") {
					$value = 1;
				} else if ($value == "No") {
					$value = 0;
				}
			}
			if ($column == "language_spoken") {
				$column = 'other_language';
			}

			//Address
			if ($column == "address_line1") {
				$column = 'postal_addr';
			}
			if ($column == "address_line2") {
				$column = 'postal_addr2';
			}
			if ($column == "address_country") {
				$column = 'postal_country';
			}
			if ($column == "address_region") {
				$column = 'postal_spr';
			}
			if ($column == "address_town") {
				$column = 'postal_town';
			}

			//Contact
			if ($column == "app_phone_number") {
				$column = 'phone_no1';
			}
			if ($column == "app_other_number") {
				$column = 'phone_no2';
			}
			if ($column == "app_email_address") {
				$column = 'email_addr';
			}

			//Parent/Guardian Legal Name
			if ($column == "gd_prefix") {
				$column = 'p_prefix';
			}
			if ($column == "gd_first_name") {
				$column = 'p_first_name';
			}
			if ($column == "gd_surname") {
				$column = 'p_last_name';
			}
			if ($column == "gd_occupation") {
				$column = 'p_occupation';
			}
			if ($column == "gd_phone_number") {
				$column = 'p_phone_no';
			} else if ($column == "gd_email_address") {
				$column = 'p_email_addr';
			}

			echo $user->updateApplicantInfo($column, $value, $_SESSION['ghApplicant']);
			exit(1);
		}
	} elseif ($_GET["url"] == "education") {

		$what = $_PUT["what"];
		$value = $_PUT['value'];

		if (isset($what) && !empty($what)) {
			$column = str_replace("-", "_", $what);

			$column = substr_replace($column, "", -1);
			echo $user->updateAcademicInfo($column, $value, $_SESSION['ghApplicant']);
			exit(1);
		}
	}
} else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
	//code
} else {
	http_response_code(405);
}
