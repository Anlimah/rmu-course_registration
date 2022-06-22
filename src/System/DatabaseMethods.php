<?php

namespace Src\System;

use Src\System\DatabaseConnector;

class DatabaseMethods
{
    private $conn;

    function __construct()
    {
        $this->conn = (new DatabaseConnector())->getConnection();
    }

    private function query($str, $params = array())
    {
        $stmt = $this->conn->prepare($str);
        $stmt->execute($params);
        if (explode(' ', $str)[0] == 'SELECT' || explode(' ', $str)[0] == 'CALL') {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } elseif (explode(' ', $str)[0] == 'INSERT' || explode(' ', $str)[0] == 'UPDATE' || explode(' ', $str)[0] == 'DELETE') {
            return 1;
        }
    }

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
        } catch (\Exception $e) {
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
        } catch (\Exception $e) {
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
        } catch (\Exception $e) {
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

    /*public function countries()
    {
        $countries = array('Afghanistan' => 'Afghanistan', 'Albania' => 'Albania', 'Algeria', 'Andorra', 'Angola', 'Antigua and Barbuda', 'Argentina', 'Armenia', 'Australia', 'Austria', 'Azerbaijan',, 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bhutan', 'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei', 'Bulgaria', 'Burkina Faso', 'Burundi', 'Cabo Verde', 'Cambodia', 'Cameroon', 'Canada', 'Central African Republic', 'Chad', 'Chile', 'China', 'Colombia', 'Comoros', 'Congo', 'Costa Rica', 'Croatia', 'Cuba', 'Cyprus', 'Czech Republic (Czechia)', 'Côte d\'Ivoire', 'Denmark', 'Djibouti', 'Dominica', 'Dominican Republic', 'DR Congo', 'Ecuador', 'Egypt', 'El Salvador', 'Equatorial Guinea', 'Eritrea', 'Estonia', 'Eswatini', 'Ethiopia', 'Fiji', 'Finland', 'France', 'Gabon', 'Gambia', 'Georgia', 'Germany', 'Ghana', 'Greece', 'Grenada', 'Guatemala', 'Guinea', 'Guinea-Bissau', 'Guyana', 'Haiti', 'Holy See', 'Honduras', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Israel', 'Italy', 'Jamaica', 'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati', 'Kuwait', 'Kyrgyzstan', 'Laos', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Madagascar', 'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta', 'Marshall Islands', 'Mauritania', 'Mauritius', 'Mexico', 'Micronesia', 'Moldova', 'Monaco', 'Mongolia', 'Montenegro', 'Morocco', 'Mozambique', 'Myanmar', 'Namibia', 'Nauru', 'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'North Korea', 'North Macedonia', 'Norway', 'Oman', 'Pakistan', 'Palau', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines', 'Poland', 'Portugal', 'Qatar', 'Romania', 'Russia', 'Rwanda', 'Saint Kitts & Nevis', 'Saint Lucia', 'Samoa', 'San Marino', 'Sao Tome & Principe', 'Saudi Arabia', 'Senegal', 'Serbia', 'Seychelles', 'Sierra Leone', 'Singapore', 'Slovakia', 'Slovenia', 'Solomon Islands', 'Somalia', 'South Africa', 'South Korea', 'South Sudan', 'Spain', 'Sri Lanka', 'St. Vincent & Grenadines', 'State of Palestine', 'Sudan', 'Suriname', 'Sweden', 'Switzerland', 'Syria', 'Tajikistan', 'Tanzania', 'Thailand', 'Timor-Leste', 'Togo', 'Tonga', 'Trinidad and Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Tuvalu', 'Uganda', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States', 'Uruguay', 'Uzbekistan', 'Vanuatu', 'Venezuela', 'Vietnam', 'Yemen', 'Zambia', 'Zimbabwe');
        return $countries;
    }*/
}
