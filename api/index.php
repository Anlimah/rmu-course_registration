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
header("Access-Control-Allow-Methods: GET,POST");
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
	} elseif ($_GET["url"] == "appLogin") {
		$message = array("response" => "error", "msg" => "Invalid request!");

		if (isset($_SESSION["_start"]) && !empty($_SESSION["_start"])) {
			if ($_POST["_logToken"] != $_SESSION["_start"]) {
				die(json_encode($message));
			} else {
				$app_number = $user->validateInput($_POST["app_number"]);
				$pin_code = $user->validateInput($_POST["pin_code"]);
				echo json_encode(array('app' => $app_number, 'pin' => $pin_code));
				$_SESSION['ghApplicant'] = 1;
				$_SESSION['ghAppLogin'] = true;
			}
		} else {
			echo 'NO';
		}
	} elseif ($_GET["url"] == "save") {
		$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$uri = explode('/', $uri);
		if ($uri[4] == 1) {
			if (isset($_POST["title"]) && !empty($_POST["title"])) {
				if (isset($_POST["surname"]) && !empty($_POST["surname"])) {
					if (isset($_POST["other-names"]) && !empty($_POST["other-names"])) {
						if (isset($_POST["dob"]) && !empty($_POST["dob"])) {
							if (isset($_POST["gender"]) && !empty($_POST["gender"])) {
								if (isset($_POST["marital-status"]) && !empty($_POST["marital-status"])) {
									if (isset($_POST["nationality"]) && !empty($_POST["nationality"])) {
										if (isset($_POST["country"]) && !empty($_POST["country"])) {
											if (isset($_POST["region"]) && !empty($_POST["region"])) {
												if (isset($_POST["home-town"]) && !empty($_POST["home-town"])) {
													if (isset($_POST["disability"]) && !empty($_POST["disability"])) {
														if (isset($_POST["app-postal-address"]) && !empty($_POST["app-postal-address"])) {
															if (isset($_POST["app-postal-town"]) && !empty($_POST["app-postal-town"])) {
																if (isset($_POST["app-postal-region"]) && !empty($_POST["app-postal-region"])) {
																	if (isset($_POST["app-phone-number"]) && !empty($_POST["app-phone-number"])) {
																		if (isset($_POST["app-email-address"]) && !empty($_POST["app-email-address"])) {

																			if (isset($_POST["gd-title"]) && !empty($_POST["gd-title"])) {
																				if (isset($_POST["gd-surname"]) && !empty($_POST["gd-surname"])) {
																					if (isset($_POST["gd-first-name"]) && !empty($_POST["gd-first-name"])) {
																						if (isset($_POST["gd-occupation"]) && !empty($_POST["gd-occupation"])) {
																							if (isset($_POST["gd-postal-region"]) && !empty($_POST["gd-postal-region"])) {
																								if (isset($_POST["gd-residence"]) && !empty($_POST["gd-residence"])) {
																									if (isset($_POST["gd-postal-town"]) && !empty($_POST["gd-postal-town"])) {
																										if (isset($_POST["gd-phone-number"]) && !empty($_POST["gd-phone-number"])) {
																											if (isset($_POST["gd-email-address"]) && !empty($_POST["gd-email-address"])) {


																												//if (isset($_FILE["applicant-photo"]) && !empty($_FILE["applicant-photo"])) {
																												// Personal Details
																												/*$app_title = $user->validateInput($_POST["title"]);
																													$app_surname = $user->validateInput($_POST["surname"]);
																													$app_first_name = $user->validateInput($_POST["other-names"]);
																													$app_dob = $user->validateInput($_POST["dob"]);
																													$app_gender = $user->validateInput($_POST["gender"]);
																													$app_mar_status = $user->validateInput($_POST["marital-status"]);
																													$app_nationality = $user->validateInput($_POST["nationality"]);
																													$app_country_res = $user->validateInput($_POST["country"]);
																													$app_home_reg = $user->validateInput($_POST["region"]);
																													$app_home_town = $user->validateInput($_POST["home-town"]);
																													$app_disability = $user->validateInput($_POST["disability"]);

																													$app_photo = $user->validateInput($_POST["applicant-photo"]);

																													// Personal contact
																													$app_post_addr = $user->validateInput($_POST["app-postal-address"]);
																													$app_post_town = $user->validateInput($_POST["app-postal-town"]);
																													$app_post_reg = $user->validateInput($_POST["app-postal-region"]);
																													$app_res_addr = $user->validateInput($_POST["app-residence"]);
																													$app_mobile = $user->validateInput($_POST["app-phone-number"]);
																													$app_email_addr = $user->validateEmail($_POST["app-email-address"]);

																													//Parent personal details
																													$par_title = $user->validateInput($_POST["gd-title"]);
																													$par_surname = $user->validateInput($_POST["gd-surname"]);
																													$par_first_name = $user->validateInput($_POST["gd-first-name"]);
																													$par_occupation = $user->validateInput($_POST["gd-occupation"]);

																													//Parents contact
																													$par_post_reg = $user->validateInput($_POST["gd-postal-region"]);
																													$par_res_address = $user->validateInput($_POST["gd-residence"]);
																													$par_post_town = $user->validateInput($_POST["gd-postal-town"]);
																													$par_mobile = $user->validateInput($_POST["gd-phone-number"]);
																													$par_email = $user->validateInput($_POST["gd-email-address"]);*/
																												echo json_encode(array("response" => "success", "msg" => "Okay"));
																											} else {
																												echo json_encode(array("response" => "error", "msg" => "Invalid input25"));
																											}
																										} else {
																											echo json_encode(array("response" => "error", "msg" => "Invalid input24"));
																										}
																									} else {
																										echo json_encode(array("response" => "error", "msg" => "Invalid input23"));
																									}
																								} else {
																									echo json_encode(array("response" => "error", "msg" => "Invalid input22"));
																								}
																							} else {
																								echo json_encode(array("response" => "error", "msg" => "Invalid input21"));
																							}
																						} else {
																							echo json_encode(array("response" => "error", "msg" => "Invalid input20"));
																						}
																					} else {
																						echo json_encode(array("response" => "error", "msg" => "Invalid input19"));
																					}
																				} else {
																					echo json_encode(array("response" => "error", "msg" => "Invalid input"));
																				}
																			} else {
																				echo json_encode(array("response" => "error", "msg" => "Invalid input18"));
																			}
																		} else {
																			echo json_encode(array("response" => "error", "msg" => "Invalid input17"));
																		}
																	} else {
																		echo json_encode(array("response" => "error", "msg" => "Invalid input16"));
																	}
																} else {
																	echo json_encode(array("response" => "error", "msg" => "Invalid input15"));
																}
															} else {
																echo json_encode(array("response" => "error", "msg" => "Invalid input14"));
															}
														} else {
															echo json_encode(array("response" => "error", "msg" => "Invalid input13"));
														}
													} else {
														echo json_encode(array("response" => "error", "msg" => "Invalid input12"));
													}
												} else {
													echo json_encode(array("response" => "error", "msg" => "Invalid input11"));
												}
											} else {
												echo json_encode(array("response" => "error", "msg" => "Invalid input10"));
											}
										} else {
											echo json_encode(array("response" => "error", "msg" => "Invalid input9"));
										}
									} else {
										echo json_encode(array("response" => "error", "msg" => "Invalid inpu8t"));
									}
								} else {
									echo json_encode(array("response" => "error", "msg" => "Invalid input7"));
								}
							} else {
								echo json_encode(array("response" => "error", "msg" => "Invalid input6"));
							}
						} else {
							echo json_encode(array("response" => "error", "msg" => "Invalid input5"));
						}
					} else {
						echo json_encode(array("response" => "error", "msg" => "Invalid input4"));
					}
				} else {
					echo json_encode(array("response" => "error", "msg" => "Invalid input3"));
				}
			} else {
				echo json_encode(array("response" => "error", "msg" => "Invalid input2"));
			}
		} elseif ($uri[4] == 2) {
			if (isset($_POST["app-exam-index"]) && !empty($_POST["app-exam-index"])) {
				if (isset($_POST["app-exam-type"]) && !empty($_POST["app-exam-type"])) {
					if (isset($_POST["app-exam-year"]) && !empty($_POST["app-exam-year"])) {
						echo json_encode(array("response" => "success", "msg" => "Okay"));
					} else {
						echo json_encode(array("response" => "error", "msg" => "Invalid input3"));
					}
				} else {
					echo json_encode(array("response" => "error", "msg" => "Invalid input2"));
				}
			} else {
				echo json_encode(array("response" => "error", "msg" => "Invalid input 1"));
			}
		} elseif ($uri[4] == 3) {
			if (isset($_POST["title"]) && !empty($_POST["title"])) {
				if (isset($_POST["surname"]) && !empty($_POST["surname"])) {
					if (isset($_POST["other-names"]) && !empty($_POST["other-names"])) {
						if (isset($_POST["dob"]) && !empty($_POST["dob"])) {
							if (isset($_POST["gender"]) && !empty($_POST["gender"])) {
								if (isset($_POST["marital-status"]) && !empty($_POST["marital-status"])) {
									if (isset($_POST["nationality"]) && !empty($_POST["nationality"])) {
										if (isset($_POST["country"]) && !empty($_POST["country"])) {
											if (isset($_POST["region"]) && !empty($_POST["region"])) {
												if (isset($_POST["home-town"]) && !empty($_POST["home-town"])) {
													if (isset($_POST["disability"]) && !empty($_POST["disability"])) {
														if (isset($_POST["app-postal-address"]) && !empty($_POST["app-postal-address"])) {
															if (isset($_POST["app-postal-town"]) && !empty($_POST["app-postal-town"])) {
																if (isset($_POST["app-postal-region"]) && !empty($_POST["app-postal-region"])) {
																	if (isset($_POST["app-phone-number"]) && !empty($_POST["app-phone-number"])) {
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		} elseif ($uri[4] == 4) {
			$message = array("response" => "success");
			echo json_encode($message);
		}
	}
} else {
	http_response_code(405);
}
