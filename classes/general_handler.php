<?php
require_once('db.php');
class GeneralHandler extends DbConnect
{

	//Get raw data from db
	public function getID($str, $params = array())
	{
		try {
			$result = $this->query($str, $params);
			if (!empty($result)) {
				return $result[0]["id"];
			} else {
				return 0;
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	//Get raw data from db
	public function getData($str, $params = array())
	{
		try {
			$result = $this->query($str, $params);
			if (!empty($result)) {
				return $result;
			} else {
				return 0;
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	//Insert, Upadate or Delete Data
	public function inputData($str, $params = array())
	{
		try {
			$result = $this->query($str, $params);
			if (!empty($result)) {
				return $result;
			} else {
				return 0;
			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function genCode($length = 6)
	{
		$digits = $length;
		return rand(pow(10, $digits - 1), pow(10, $digits) - 1);
	}

	public function validateEmail($input)
	{
		if (empty($input)) {
			die("Invalid email address!");
		}
		$user_email = htmlentities(htmlspecialchars($input));
		$sanitized_email = filter_var($user_email, FILTER_SANITIZE_EMAIL);
		if (!filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {
			die("Invalid email address!" . $sanitized_email);
		}
		return $user_email;
	}

	public function validateInput($input)
	{
		if (empty($input)) {
			die("Invalid input!");
		}
		$user_input = htmlentities(htmlspecialchars($input));
		$validated_input = (bool) preg_match('/^[A-Za-z0-9]/', $user_input);
		if ($validated_input) {
			return $user_input;
		}
		die("Invalid input!");
	}

	public function validatePhone($input)
	{
		if (empty($input)) {
			die("Invalid phone number!");
		}
		$user_input = htmlentities(htmlspecialchars($input));
		$validated_input = (bool) preg_match('/^[0-9]/', $user_input);
		if ($validated_input) {
			return $user_input;
		}
		die("Invalid phone number!");
	}
}
