<?php

namespace Src\Controller;

class ExposeDataController
{
    public function genCode($length = 6)
    {
        $digits = $length;
        return rand(pow(10, $digits - 1), pow(10, $digits) - 1);
    }

    public function validateIndexNumber($input)
    {
        if (empty($input)) die(array("success" => false, "message" => "Index number required!"));
        if (strlen($input) !== 10) die(array("success" => false, "message" => "Invalid index number!"));
        $user_input = htmlentities(htmlspecialchars($input));
        $validated_input = (bool) preg_match('/^[A-Za-z0-9]/', $user_input);
        if ($validated_input) return $input;
        die(array("success" => false, "message" => "Invalid index number!"));
    }

    public function validateEmail($input): mixed
    {
        if (empty($input)) return array("success" => false, "message" => "Input required!");
        $user_email = htmlentities(htmlspecialchars($input));
        $sanitized_email = filter_var($user_email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($sanitized_email, FILTER_VALIDATE_EMAIL))
            return array("success" => false, "message" => "Invalid email address!");
        return array("success" => true, "message" => $user_email);
    }

    public function validatePassword($input)
    {
        if (empty($input)) return array("success" => false, "message" => "Password required!");
        if (strlen($input) < 8 || strlen($input) > 16) die(array("success" => false, "message" => "Invalid password length!"));
        $user_input = htmlentities(htmlspecialchars($input));
        $validated_input = (bool) preg_match('/^[A-Za-z0-9()+@#.-_=$&!`]/', $user_input);
        if ($validated_input) return $input;
        return array("success" => false, "message" => "Invalid password!");
    }

    public function validateInputTextNumber($input)
    {
        if (empty($input)) die(array("success" => false, "message" => "Input required"));
        $user_input = htmlentities(htmlspecialchars($input));
        $validated_input = (bool) preg_match('/^[A-Za-z0-9]/', $user_input);
        if ($validated_input) return $user_input;
        die(array("success" => false, "message" => "invalid"));
    }

    public function validateInputTextOnly($input)
    {
        if (empty($input)) return array("success" => false, "message" => "Input required");
        $user_input = htmlentities(htmlspecialchars($input));
        $validated_input = (bool) preg_match('/^[A-Za-z]/', $user_input);
        if ($validated_input) return array("success" => true, "message" => $user_input);
        return array("success" => false, "message" => "invalid");
    }

    public function validateNumberOnly($input)
    {
        if (empty($input)) return array("success" => false, "message" => "Input required!");
        $user_input = htmlentities(htmlspecialchars($input));
        $validated_input = (bool) preg_match('/^[0-9]/', $user_input);
        if ($validated_input) return  array("success" => true, "message" => $user_input);
        die(json_encode(array("success" => false, "message" => "Invalid input!")));
    }

    public function validateDate($date)
    {
        if (strtotime($date) === false) return array("success" => false, "message" => "Invalid date!");
        list($year, $month, $day) = explode('-', $date);
        if (checkdate($month, $day, $year)) return array("success" => true, "message" => $date);
    }

    public function validateImage($files)
    {
        if (!isset($files['file']['error']) || !empty($files["pics"]["name"])) {
            $allowedFileType = ['image/jpeg', 'image/png', 'image/jpg'];
            for ($i = 0; $i < count($files["pics"]["name"]); $i++) {
                $check = getimagesize($files["pics"]["tmp_name"][$i]);
                if ($check !== false && in_array($files["pics"]["type"][$i], $allowedFileType))
                    return array("success" => true, "message" => $files);
            }
        }
        return array("success" => false, "message" => "Invalid file uploaded!");
    }

    public function validateYearData($input)
    {
        if (empty($input)) return array("success" => false, "message" => "Input required");
        //if ($input < 1990 || $input > 2022) return array("success" => false, "message" => "invalid");
        $user_input = htmlentities(htmlspecialchars($input));
        $validated_input = (bool) preg_match('/^[0-9]/', $user_input);
        if ($validated_input) return array("success" => true, "message" => $user_input);
        return array("success" => false, "message" => "Input invalid");
    }

    public function validateGrade($input)
    {
        if (empty($input) || strtoupper($input) == "GRADE") return array("success" => false, "message" => "Input required");
        if (strlen($input) < 1 || strlen($input) > 2) return array("success" => false, "message" => "Input invalid");
        $user_input = htmlentities(htmlspecialchars($input));
        $validated_input = (bool) preg_match('/^[A-Za-z]/', $user_input);
        if ($validated_input) return array("success" => true, "message" => $user_input);
        return array("success" => true, "message" => $user_input);
    }
}
