<?php
session_start();
/*
* Designed and programmed by
* @Author: Francis A. Anlimah
*/

require "../bootstrap.php";

use Src\Controller\UsersController;
//use Src\Controller\ExposeDataController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$user = new UsersController();
//$expose = new ExposeDataController();

$data = [];
//$errors = [];

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
    } elseif ($_GET["url"] == "grades") {
        //fetch in grades per the certificate type
        if (isset($_GET["value"]) && !empty($_GET["value"])) {
            $type = $user->validateInputTextOnly($_GET["value"]);
            echo json_encode($user->fetchGrades($type["message"]));
        }
        exit();
    } elseif ($_GET["url"] == "elective-subjects") {
        //fetch in grades per the certificate type
        if (isset($_GET["value"]) && !empty($_GET["value"])) {
            $type = $user->validateInputTextOnly($_GET["value"]);
            echo json_encode($user->fetchSubjects($type["message"]));
        }
        exit();
    } elseif ($_GET["url"] == "education") {
        if (!isset($_GET["what"]) || !isset($_GET["value"])) die("Invalid input attributes");
        if ($_GET["what"] != "edit-edu-btn" || empty($_GET["what"]) || empty($_GET["value"])) die("Invalid input values");

        $value = substr($_GET['value'], 4); // serial number
        $education_details = [];

        $userEducation = $user->fetchEducationHistory($value, $_SESSION['ghApplicant']);
        if (empty($userEducation)) die("Unable to fetch Education " . $userEducation);
        $education_details["aca"] = $userEducation;

        $userCourses = $user->fetchAppCourses($value, $userEducation[0]["id"]);
        $education_details["courses"] = $userCourses;

        $grades = $user->fetchGrades($userEducation[0]["cert_type"]);
        $education_details["grades"] = $grades;

        $subject_type = "technical";
        if (strtolower($userEducation[0]["course_of_study"]) != $subject_type) $subject_type = "secondary";
        $elective_subjects = $user->fetchSubjects($subject_type);
        $education_details["elective_subjects"] = $elective_subjects;

        $userEducation[0]["school_name"] = htmlspecialchars_decode(html_entity_decode(ucwords(strtolower($userEducation[0]["school_name"])), ENT_QUOTES), ENT_QUOTES);

        die(json_encode($education_details));
    }


    // All POST request will be sent here
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($_GET["url"] == "appLogin") {
        $message = array("response" => "error", "message" => "Invalid request!");

        if (!isset($_SESSION["_start"]) || empty($_SESSION["_start"])) die(json_encode($message));
        if ($_POST["_logToken"] != $_SESSION["_start"]) die(json_encode($message));
        $da = is_numeric($_POST["app_number"]);

        if (!isset($_POST["app_number"]) || empty($_POST["app_number"]))
            die(json_encode(array("response" => "error", "message" => "Incorrect application number or PIN!")));
        if (!isset($_POST["pin_code"]) || empty($_POST["pin_code"]))
            die(json_encode(array("response" => "error", "message" => "Incorrect application number or PIN!")));

        $app_number = $user->validateInput(substr($_POST["app_number"], 4));
        $pin_code = $user->validateInput($_POST["pin_code"]);
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

        $status = $user->hasSubmittedForm($_SESSION['ghApplicant']);

        if (!empty($status)) {
            $state = 1;
            $type = "application-status.php";
        } else {
            $state = 0;
        }

        die(json_encode(array("response" => "success", "message" => $type, "state" => $state)));
    }

    // 
    elseif ($_GET["url"] == "verify") {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);

        switch ($uri[4]) {
            case 'personal-info':
                echo json_encode($user->verifyForm($uri[4]));
                break;

            default:
                echo json_encode(array("response" => "error", "message" => "Invalid Request!"));
                break;
        }
        exit();
    }

    // Adding new education history
    elseif ($_GET["url"] == "education") {
        $errors = [];
        $data = [];
        //step 1
        $sch_name = $user->validateInputTextOnly($_POST["sch_name"]);
        if ($sch_name['status'] == "error") {
            $errors['sch_name'] = 'Name of school is ' . $sch_name['message'] . '!';
        }

        $sch_country = $user->validateInputTextOnly($_POST["sch_country"]);
        if ($sch_country['status'] == "error") {
            $errors['sch_country'] = 'Country of school is ' . $sch_country['message'] . '!';
        }

        $sch_region = $user->validateInputTextOnly($_POST["sch_region"]);
        if ($sch_region['status'] == "error") {
            $errors['sch_region'] = 'Province or region of school is ' . $sch_region['message'] . '!';
        }

        $sch_city = $user->validateInputTextOnly($_POST["sch_city"]);
        if ($sch_city['status'] == "error") {
            $errors['sch_city'] = 'City school is ' . $sch_city['message'] . '!';
        }

        //step 2
        $cert_type = [];
        $cert_type = $user->validateInputTextOnly($_POST["cert_type"]);
        if ($cert_type['status'] == "error" || $_POST['cert_type'] == "Select") {
            $errors['cert_type'] = 'Certificate or degree earned is ' . $cert_type['message'] . '!';
        }

        $other_cert_type = [];
        $other_cert_type["message"] = "";

        if ($_POST["cert_type"] == "OTHER" && empty($_POST["other_cert_type"])) {
            $errors['cert_type'] = 'Specify the name of certificate earned!';
        } else if (($_POST["cert_type"] == "OTHER" || $_POST["cert_type"] == "MASTERS" || $_POST["cert_type"] == "DEGREE" || $_POST["cert_type"] == "DIPLOMA" || $_POST["cert_type"] == "BACCALAUREATE" || $_POST["cert_type"] == "O LEVEL" || $_POST["cert_type"] == "A LEVEL") && !empty($_POST["other_cert_type"])) {
            $cert_type = $user->validateInputTextOnly($_POST["cert_type"]);
            $other_cert_type = $user->validateInputTextOnly($_POST["other_cert_type"]);
            if ($cert_type['status'] == "error") {
                $errors['cert_type'] = 'Certificate or degree earned is ' . $other_cert_type['message'] . '!';
            }
        } else {
            $cert_type = $user->validateInputTextOnly($_POST["cert_type"]);
            if ($cert_type['status'] == "error" || $_POST['cert_type'] == "Select") {
                $errors['cert_type'] = 'Certificate or degree earned is ' . $cert_type['message'] . '!';
            }
        }

        $index_number = $user->validateInputTextNumber($_POST["index_number"]);
        if ($index_number['status'] == "error") {
            $errors['index_number'] = 'Index Number is ' . $index_number['message'] . '!';
        }

        $month_started = $user->validateInputTextOnly($_POST["month_started"]);
        if ($month_started['status'] == "error" || $_POST['month_started'] == "Month") {
            $errors['date_started'] = 'Month started is invalid!';
        }

        $year_started = $user->validateYearData($_POST["year_started"]);
        if ($year_started['status'] == "error" || $_POST['year_started'] == "Year") {
            $errors['date_started'] = 'Year started is invalid!';
        }

        $month_completed = $user->validateInputTextOnly($_POST["month_completed"]);
        if ($month_completed['status'] == "error" || $_POST['month_completed'] == "Month") {
            $errors['date_completed'] = 'Month completed is invalid!';
        }

        $year_completed = $user->validateYearData($_POST["year_completed"]);
        if ($year_completed['status'] == "error" || $_POST['year_completed'] == "Year") {
            $errors['date_completed'] = 'Year completed is invalid!';
        }

        //step 3
        $course_studied = [];
        $course_studied = $user->validateInputTextOnly($_POST["course_studied"]);
        if ($course_studied['status'] == "error" || $_POST['course_studied'] == "Select") {
            $errors['course_studied'] = 'Course or program of study is ' . $course_studied['message'] . '!';
        }

        $other_course_studied = [];
        $other_course_studied["message"] = "";

        if (($_POST["cert_type"] == "OTHER" || $_POST["cert_type"] == "MASTERS" || $_POST["cert_type"] == "DEGREE" || $_POST["cert_type"] == "DIPLOMA" || $_POST["cert_type"] == "BACCALAUREATE" || $_POST["cert_type"] == "O LEVEL" || $_POST["cert_type"] == "A LEVEL") && empty($_POST["other_course_studied"])) {
            $errors['course_studied'] = 'Course or program of study required!';
        } else if (($_POST["cert_type"] == "OTHER" || $_POST["cert_type"] == "MASTERS" || $_POST["cert_type"] == "DEGREE" || $_POST["cert_type"] == "DIPLOMA" || $_POST["cert_type"] == "BACCALAUREATE" || $_POST["cert_type"] == "O LEVEL" || $_POST["cert_type"] == "A LEVEL") && !empty($_POST["other_course_studied"])) {
            $course_studied = $user->validateInputTextOnly($_POST["course_studied"]);
            $other_course_studied = $user->validateInputTextOnly($_POST["other_course_studied"]);
            if ($course_studied['status'] == "error") {
                $errors['course_studied'] = 'Course or program of study is ' . $course_studied['message'] . '!';
            }
        } else {
            $course_studied = $user->validateInputTextOnly($_POST["course_studied"]);
            if ($course_studied['status'] == "error" || $_POST['course_studied'] == "Select") {
                $errors['course_studied'] = 'Course or program of study is ' . $course_studied['message'] . '!';
            }
        }

        //$awaiting_result = ($_POST["cert_type"] == "OTHER") ? 1 : $_POST["awaiting_result"];
        if ($_POST["cert_type"] == "OTHER" || $_POST["cert_type"] == "MASTERS" || $_POST["cert_type"] == "DEGREE" || $_POST["cert_type"] == "DIPLOMA" || $_POST["cert_type"] == "BACCALAUREATE" || $_POST["cert_type"] == "O LEVEL" || $_POST["cert_type"] == "A LEVEL") $awaiting_result = 1;
        else $awaiting_result = $_POST["awaiting_result"];

        if ($awaiting_result == 0) {
            //core subjects
            $core_sbj1 = $user->validateInputTextOnly($_POST["core_sbj1"]);
            if ($core_sbj1['status'] == "error" || $_POST['core_sbj1'] == "Select") {
                $errors['core_sbj_grp1'] = 'Subject is ' . $core_sbj1['message'] . '!';
            }
            $core_sbj2 = $user->validateInputTextOnly($_POST["core_sbj2"]);
            if ($core_sbj2['status'] == "error" || $_POST['core_sbj2'] == "Select") {
                $errors['core_sbj_grp2'] = 'Subject is ' . $core_sbj2['message'] . '!';
            }
            $core_sbj3 = $user->validateInputTextOnly($_POST["core_sbj3"]);
            if ($core_sbj3['status'] == "error" || $_POST['core_sbj3'] == "Select") {
                $errors['core_sbj_grp3'] = 'Subject is ' . $core_sbj3['message'] . '!';
            }
            $core_sbj4 = $user->validateInputTextOnly($_POST["core_sbj4"]);
            if ($core_sbj4['status'] == "error" || $_POST['core_sbj4'] == "Select") {
                $errors['core_sbj_grp4'] = 'Subject is ' . $core_sbj4['message'] . '!';
            }

            //core subjects grades
            $core_sbj_grd1 = $user->validateGrade($_POST["core_sbj_grd1"]);
            if ($core_sbj_grd1['status'] == "error") {
                $errors['core_sbj_grp1'] = 'Subject\'s grade is ' . $core_sbj_grd1['message'] . '!';
            }
            $core_sbj_grd2 = $user->validateGrade($_POST["core_sbj_grd2"]);
            if ($core_sbj_grd2['status'] == "error") {
                $errors['core_sbj_grp2'] = 'Subject\'s grade is ' . $core_sbj_grd2['message'] . '!';
            }
            $core_sbj_grd3 = $user->validateGrade($_POST["core_sbj_grd3"]);
            if ($core_sbj_grd3['status'] == "error") {
                $errors['core_sbj_grp3'] = 'Subject\'s grade is ' . $core_sbj_grd3['message'] . '!';
            }
            $core_sbj_grd4 = $user->validateGrade($_POST["core_sbj_grd4"]);
            if ($core_sbj_grd4['status'] == "error") {
                $errors['core_sbj_grp4'] = 'Subject\'s grade is ' . $core_sbj_grd4['message'] . '!';
            }

            //elective subjects
            $elective_sbj1 = $user->validateInputTextOnly($_POST["elective_sbj1"]);
            if ($elective_sbj1['status'] == "error" || $_POST['elective_sbj1'] == "Select") {
                $errors['elective_sbj_grp1'] = 'Subject is ' . $elective_sbj1['message'] . '!';
            }
            $elective_sbj2 = $user->validateInputTextOnly($_POST["elective_sbj2"]);
            if ($elective_sbj2['status'] == "error" || $_POST['elective_sbj2'] == "Select") {
                $errors['elective_sbj_grp2'] = 'Subject is ' . $elective_sbj2['message'] . '!';
            }
            $elective_sbj3 = $user->validateInputTextOnly($_POST["elective_sbj3"]);
            if ($elective_sbj3['status'] == "error" || $_POST['elective_sbj3'] == "Select") {
                $errors['elective_sbj_grp3'] = 'Subject is ' . $elective_sbj3['message'] . '!';
            }
            $elective_sbj4 = $user->validateInputTextOnly($_POST["elective_sbj4"]);
            if ($elective_sbj4['status'] == "error" || $_POST['elective_sbj4'] == "Select") {
                $errors['elective_sbj_grp4'] = 'Subject is ' . $elective_sbj4['message'] . '!';
            }

            //core subjects grades
            $elective_sbj_grd1 = $user->validateGrade($_POST["elective_sbj_grd1"]);
            if ($elective_sbj_grd1['status'] == "error") {
                $errors['elective_sbj_grp1'] = 'Subject\'s grade is ' . $elective_sbj_grd1['message'] . '!';
            }
            $elective_sbj_grd2 = $user->validateGrade($_POST["elective_sbj_grd2"]);
            if ($elective_sbj_grd2['status'] == "error") {
                $errors['elective_sbj_grp2'] = 'Subject\'s grade is ' . $elective_sbj_grd2['message'] . '!';
            }
            $elective_sbj_grd3 = $user->validateGrade($_POST["elective_sbj_grd3"]);
            if ($elective_sbj_grd3['status'] == "error") {
                $errors['elective_sbj_grp3'] = 'Subject\'s grade is ' . $elective_sbj_grd3['message'] . '!';
            }
            $elective_sbj_grd4 = $user->validateGrade($_POST["elective_sbj_grd4"]);
            if ($elective_sbj_grd4['status'] == "error") {
                $errors['elective_sbj_grp4'] = 'Subject\'s grade is ' . $elective_sbj_grd4['message'] . '!';
            }
        }

        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
        } else {
            $education_info = array();
            $result = $user->saveEducation(
                $sch_name["message"],
                $sch_country["message"],
                $sch_region["message"],
                $sch_city["message"],
                $cert_type["message"],
                $other_cert_type["message"],
                $index_number["message"],
                $month_started["message"],
                $year_started["message"],
                $month_completed["message"],
                $year_completed["message"],
                $course_studied["message"],
                $other_course_studied["message"],
                $awaiting_result,
                $_SESSION['ghApplicant']
            );

            if ($result) {
                if ($awaiting_result == 0) {
                    $subjects = array(
                        "core" => array(
                            array("subject" => $core_sbj1["message"], "grade" => $core_sbj_grd1["message"]),
                            array("subject" => $core_sbj2["message"], "grade" => $core_sbj_grd2["message"]),
                            array("subject" => $core_sbj3["message"], "grade" => $core_sbj_grd3["message"]),
                            array("subject" => $core_sbj4["message"], "grade" => $core_sbj_grd4["message"])
                        ),
                        "elective" => array(
                            array("subject" => $elective_sbj1["message"], "grade" => $elective_sbj_grd1["message"]),
                            array("subject" => $elective_sbj2["message"], "grade" => $elective_sbj_grd2["message"]),
                            array("subject" => $elective_sbj3["message"], "grade" => $elective_sbj_grd3["message"]),
                            array("subject" => $elective_sbj4["message"], "grade" => $elective_sbj_grd4["message"])
                        )
                    );

                    if ($user->saveSubjectAndGrades($subjects, $result)) {
                        $data['success'] = true;
                        $data['message'] = 'Data saved successfully!';
                    }
                } else {
                    $data['success'] = true;
                    $data['message'] = 'Data saved successfully!';
                }
            }
        }

        die(json_encode($data));
    }

    // Update education history grades
    elseif ($_GET["url"] == "education-grades") {
        $errors = [];
        $data = [];

        if (!isset($_POST["edit-20eh29v1Tf"]) || empty($_POST["edit-20eh29v1Tf"])) {
            die(json_encode(array(
                "success" => false,
                "message" => "Invalid education history data. You can delete it and add a new one! - 1"
            )));
        }

        $s_number = $user->validateNumber($_POST["edit-20eh29v1Tf"]);
        if ($s_number['status'] == "error") {
            die(json_encode(array(
                "success" => false,
                "message" => "Invalid education history data. You can delete it and add a new one! - 2"
            )));
        }

        //step 1
        $sch_name = $user->validateInputTextOnly($_POST["edit-sch-name"]);
        if ($sch_name['status'] == "error") {
            $errors['edit_sch_name'] = 'School Name is ' . $sch_name['message'] . '!';
        }

        $sch_country = $user->validateInputTextOnly($_POST["edit-sch-country"]);
        if ($sch_country['status'] == "error") {
            $errors['edit_sch_country'] = 'School Country is ' . $sch_country['message'] . '!';
        }

        $sch_region = $user->validateInputTextOnly($_POST["edit-sch-region"]);
        if ($sch_region['status'] == "error") {
            $errors['edit_sch_region'] = 'School Province/Region is ' . $sch_region['message'] . '!';
        }

        $sch_city = $user->validateInputTextOnly($_POST["edit-sch-city"]);
        if ($sch_city['status'] == "error") {
            $errors['edit_sch_city'] = 'School City is ' . $sch_city['message'] . '!';
        }

        //step 2
        $cert_type = [];
        $other_cert_type = [];

        if (($_POST["edit-cert-type"] == "OTHER" || $_POST["edit-cert-type"] == "MASTERS" || $_POST["edit-cert-type"] == "DEGREE" || $_POST["edit-cert-type"] == "DIPLOMA" || $_POST["edit-cert-type"] == "BACCALAUREATE" || $_POST["edit-cert-type"] == "O LEVEL" || $_POST["edit-cert-type"] == "A LEVEL") && empty($_POST["edit-other-cert-type"])) {
            $errors['edit_cert_type'] = 'Specify the name of certificate earned!';
        } else if ($_POST["edit-cert-type"] == "OTHER" && !empty($_POST["edit-other-cert-type"])) {
            $cert_type = $user->validateInputTextOnly($_POST["cert_type"]);
            $other_cert_type = $user->validateInputTextOnly($_POST["edit-other-cert-type"]);
            if ($cert_type['status'] == "error") {
                $errors['edit_cert_type'] = 'Certificate or degree earned is ' . $other_cert_type['message'] . '!';
            }
        } else {
            $cert_type = $user->validateInputTextOnly($_POST["edit-cert-type"]);
            if ($cert_type['status'] == "error" || $_POST['edit-cert-type'] == "Select") {
                $errors['edit_cert_type'] = 'Certificate or degree earned is ' . $cert_type['message'] . '!';
            }
        }

        $index_number = $user->validateInputTextNumber($_POST["edit-index-number"]);
        if ($index_number['status'] == "error") {
            $errors['edit_index_number'] = 'Index Number is ' . $index_number['message'] . '!';
        }

        $month_started = $user->validateInputTextOnly($_POST["month-started"]);
        if ($month_started['status'] == "error" || $_POST['month-started'] == "Month") {
            $errors['edit_date_started'] = 'Month started is invalid!';
        }

        $year_started = $user->validateYearData($_POST["year-started"]);
        if ($year_started['status'] == "error" || $_POST['year-started'] == "Year") {
            $errors['edit_date_started'] = 'Year started is invalid!';
        }

        $month_completed = $user->validateInputTextOnly($_POST["month-completed"]);
        if ($month_completed['status'] == "error" || $_POST['month-completed'] == "Month") {
            $errors['edit_date_completed'] = 'Month completed is invalid!';
        }

        $year_completed = $user->validateYearData($_POST["year-completed"]);
        if ($year_completed['status'] == "error" || $_POST['year-completed'] == "Year") {
            $errors['edit_date_completed'] = 'Year completed is invalid!';
        }

        //step 3
        $course_studied = [];

        if (($_POST["edit_cert_type"] == "OTHER" || $_POST["edit_cert_type"] == "MASTERS" || $_POST["edit_cert_type"] == "DEGREE" || $_POST["edit_cert_type"] == "DIPLOMA" || $_POST["edit_cert_type"] == "BACCALAUREATE" || $_POST["edit_cert_type"] == "O LEVEL" || $_POST["edit_cert_type"] == "A LEVEL") && empty($_POST["other-course-studied"])) {
            $errors['edit_course_studied'] = 'Course or programme of study required!';
        } else if ($_POST["edit_cert_type"] == "OTHER" && !empty($_POST["other-course-studied"])) {
            $course_studied = $user->validateInputTextOnly($_POST["course-studied"]);
            $other_course_studied = $user->validateInputTextOnly($_POST["other-course-studied"]);
            if ($course_studied['status'] == "error") {
                $errors['edit_course_studied'] = 'Courseor program of study is ' . $course_studied['message'] . '!';
            }
        } else {
            $course_studied = $user->validateInputTextOnly($_POST["course-studied"]);
            if ($course_studied['status'] == "error" || $_POST['course-studied'] == "Select") {
                $errors['edit_course_studied'] = 'Course/Program of study is ' . $course_studied['message'] . '!';
            }
        }

        if ($_POST["cert_type"] == "OTHER" || $_POST["cert_type"] == "MASTERS" || $_POST["cert_type"] == "DEGREE" || $_POST["cert_type"] == "DIPLOMA" || $_POST["cert_type"] == "BACCALAUREATE" || $_POST["cert_type"] == "O LEVEL" || $_POST["cert_type"] == "A LEVEL") $awaiting_result = 1;
        else $awaiting_result = (int) $_POST["edit-awaiting-result"];

        if ($awaiting_result == 0) {
            //core subjects
            $core_sbj1 = $user->validateInputTextOnly($_POST["edit-core-sbj1"]);
            if ($core_sbj1['status'] == "error" || $_POST['edit-core-sbj1'] == "Select") {
                $errors['edit_core_sbj_grp1'] = 'Subject is ' . $core_sbj1['message'] . '!';
            }
            $core_sbj2 = $user->validateInputTextOnly($_POST["edit-core-sbj2"]);
            if ($core_sbj2['status'] == "error" || $_POST['edit-core-sbj2'] == "Select") {
                $errors['edit_core_sbj_grp2'] = 'Subject is ' . $core_sbj2['message'] . '!';
            }
            $core_sbj3 = $user->validateInputTextOnly($_POST["edit-core-sbj3"]);
            if ($core_sbj3['status'] == "error" || $_POST['edit-core-sbj3'] == "Select") {
                $errors['edit_core_sbj_grp3'] = 'Subject is ' . $core_sbj3['message'] . '!';
            }
            $core_sbj4 = $user->validateInputTextOnly($_POST["edit-core-sbj4"]);
            if ($core_sbj4['status'] == "error" || $_POST['edit-core-sbj4'] == "Select") {
                $errors['edit_core_sbj_grp4'] = 'Subject is ' . $core_sbj4['message'] . '!';
            }

            //core subjects grades
            $core_sbj_grd1 = $user->validateGrade($_POST["edit-core-sbj-grd1"]);
            if ($core_sbj_grd1['status'] == "error") {
                $errors['edit_core_sbj_grp1'] = 'Subject\'s grade is ' . $core_sbj_grd1['message'] . '!';
            }
            $core_sbj_grd2 = $user->validateGrade($_POST["edit-core-sbj-grd2"]);
            if ($core_sbj_grd2['status'] == "error") {
                $errors['edit_core_sbj_grp2'] = 'Subject\'s grade is ' . $core_sbj_grd2['message'] . '!';
            }
            $core_sbj_grd3 = $user->validateGrade($_POST["edit-core-sbj-grd3"]);
            if ($core_sbj_grd3['status'] == "error") {
                $errors['edit_core_sbj_grp3'] = 'Subject\'s grade is ' . $core_sbj_grd3['message'] . '!';
            }
            $core_sbj_grd4 = $user->validateGrade($_POST["edit-core-sbj-grd4"]);
            if ($core_sbj_grd4['status'] == "error") {
                $errors['edit_core_sbj_grp4'] = 'Subject\'s grade is ' . $core_sbj_grd4['message'] . '!';
            }

            //elective subjects
            $elective_sbj1 = $user->validateInputTextOnly($_POST["edit-elective-sbj1"]);
            if ($elective_sbj1['status'] == "error" || $_POST['edit-elective-sbj1'] == "Select") {
                $errors['edit_elective_sbj_grp1'] = 'Subject is ' . $elective_sbj1['message'] . '!';
            }
            $elective_sbj2 = $user->validateInputTextOnly($_POST["edit-elective-sbj2"]);
            if ($elective_sbj2['status'] == "error" || $_POST['edit-elective-sbj2'] == "Select") {
                $errors['edit_elective_sbj_grp2'] = 'Subject is ' . $elective_sbj2['message'] . '!';
            }
            $elective_sbj3 = $user->validateInputTextOnly($_POST["edit-elective-sbj3"]);
            if ($elective_sbj3['status'] == "error" || $_POST['edit-elective-sbj3'] == "Select") {
                $errors['edit_elective_sbj_grp3'] = 'Subject is ' . $elective_sbj3['message'] . '!';
            }
            $elective_sbj4 = $user->validateInputTextOnly($_POST["edit-elective-sbj4"]);
            if ($elective_sbj4['status'] == "error" || $_POST['edit-elective-sbj4'] == "Select") {
                $errors['edit_elective_sbj_grp4'] = 'Subject is ' . $elective_sbj4['message'] . '!';
            }

            //core subjects grades
            $elective_sbj_grd1 = $user->validateGrade($_POST["edit-elective-sbj-grd1"]);
            if ($elective_sbj_grd1['status'] == "error") {
                $errors['edit_elective_sbj_grp1'] = 'Subject\'s grade is ' . $elective_sbj_grd1['message'] . '!';
            }
            $elective_sbj_grd2 = $user->validateGrade($_POST["edit-elective-sbj-grd2"]);
            if ($elective_sbj_grd2['status'] == "error") {
                $errors['edit_elective_sbj_grp2'] = 'Subject\'s grade is ' . $elective_sbj_grd2['message'] . '!';
            }
            $elective_sbj_grd3 = $user->validateGrade($_POST["edit-elective-sbj-grd3"]);
            if ($elective_sbj_grd3['status'] == "error") {
                $errors['edit_elective_sbj_grp3'] = 'Subject\'s grade is ' . $elective_sbj_grd3['message'] . '!';
            }
            $elective_sbj_grd4 = $user->validateGrade($_POST["edit-elective-sbj-grd4"]);
            if ($elective_sbj_grd4['status'] == "error") {
                $errors['edit_elective_sbj_grp4'] = 'Subject\'s grade is ' . $elective_sbj_grd4['message'] . '!';
            }
        }

        //die($_POST["cert_type"] . " > 1 >" . $awaiting_result);

        if (!empty($errors)) {
            $data['success'] = false;
            $data['errors'] = $errors;
            die(json_encode($data));
        }

        die(json_encode($_POST));

        $acaID = $user->fetchApplicantAcaBID($s_number["message"], $_SESSION["ghApplicant"]);
        $checkHighResult = $user->checkHighSchResult($acaID);

        if ($awaiting_result && !empty($checkHighResult)) {
            if ($user->updateAwaitingResultStatus($awaiting_result, $s_number["message"], $_SESSION["ghApplicant"])) {
                $user->deleteHighSchoolResult($acaID);
                die(json_encode(array("success" => true, "message" => "Data saved successfully!")));
            }
        }

        if (!$awaiting_result && empty($checkHighSchResult)) {
            $subjects = array(
                "core" => array(
                    array("subject" => $core_sbj1["message"], "grade" => $core_sbj_grd1["message"]),
                    array("subject" => $core_sbj2["message"], "grade" => $core_sbj_grd2["message"]),
                    array("subject" => $core_sbj3["message"], "grade" => $core_sbj_grd3["message"]),
                    array("subject" => $core_sbj4["message"], "grade" => $core_sbj_grd4["message"])
                ),
                "elective" => array(
                    array("subject" => $elective_sbj1["message"], "grade" => $elective_sbj_grd1["message"]),
                    array("subject" => $elective_sbj2["message"], "grade" => $elective_sbj_grd2["message"]),
                    array("subject" => $elective_sbj3["message"], "grade" => $elective_sbj_grd3["message"]),
                    array("subject" => $elective_sbj4["message"], "grade" => $elective_sbj_grd4["message"])
                )
            );
            $user->addSubjectAndGrades($subjects, $acaID);
        }

        die(json_encode(array('success' => true, "message" => "Data saved successfully!")));/**/
    }

    //Upload certificates endpoint
    elseif ($_GET["url"] == "certificates") {
        $data = [];
        $errors = [];
        if (isset($_FILES["upload-file"]["name"]) && !empty($_FILES["upload-file"]["name"])) {
            //if (isset($_POST["20eh29v1Tf"]) && !empty($_POST["20eh29v1Tf"])) {
            if (isset($_POST["doc-type"]) && !empty($_POST["doc-type"])) {

                $type = $user->validateInputTextOnly($_POST["doc-type"]);
                //$edu_code = $user->validatePhone($_POST["20eh29v1Tf"]);

                $allowedFileType = ["application/pdf"];

                $check = filesize($_FILES["upload-file"]["tmp_name"]);

                if ($check !== false && in_array($_FILES["upload-file"]["type"], $allowedFileType)) {
                    $temp = explode(".", $_FILES["upload-file"]["name"]);
                    $newname = microtime(true) . '.' . end($temp);
                    if (move_uploaded_file($_FILES['upload-file']['tmp_name'], "../apply/docs/" . $newname)) {
                        if ($user->saveDocuments($type["message"], $newname, $_SESSION['ghApplicant'])) {
                            $data["success"] = true;
                            $data["message"] = "File saved successfully!";
                        } else {
                            $data["success"] = false;
                            $data["error"] = "Internal server error";
                        }
                    } else {
                        $data["success"] = false;
                        $data["error"] = "Server error";
                    }
                } else {
                    $data["success"] = false;
                    $data["error"] = "Invalid file type";
                }
            } else {
                $data["success"] = false;
                $data["error"] = "Invalid or empty file entry";
            }
        } else {
            $data["success"] = false;
            $data["error"] = "Invalid or empty file";
        }
        echo json_encode($data);
        exit();

        /** */
    } elseif ($_GET["url"] == "upload-photo") {
        $data = [];
        $errors = [];

        if (isset($_FILES["photo-upload"]["name"]) && !empty($_FILES["photo-upload"]["name"])) {

            $allowedFileType = [
                'image/jpeg',
                'image/png',
                'image/jpg'
            ];

            $check = filesize($_FILES["photo-upload"]["tmp_name"]);

            if ($check !== false && in_array($_FILES["photo-upload"]["type"], $allowedFileType)) {
                $temp = explode(".", $_FILES["photo-upload"]["name"]);
                $newname = microtime(true) . '.' . end($temp);
                if (move_uploaded_file($_FILES['photo-upload']['tmp_name'], "../apply/photos/" . $newname)) {
                    if ($user->updateApplicantPhoto($newname, $_SESSION['ghApplicant'])) {
                        $data["success"] = true;
                        $data["message"] = "File saved successfully!";
                    } else {
                        $data["success"] = false;
                        $data["message"] = "Internal server error";
                    }
                } else {
                    $data["success"] = false;
                    $data["message"] = "Server error";
                }
            } else {
                $data["success"] = false;
                $data["message"] = "Invalid file type";
            }
        } else {
            $data["success"] = false;
            $data["message"] = "Invalid or empty file";
        }
        echo json_encode($data);
        exit();
    } elseif ($_GET["url"] == "validateForm") {
        if (isset($_POST["form"]) && !empty($_POST["form"])) {
            $form = $user->validatePhone($_POST["form"]);
            $go = false;

            if ($form == 1) {
                $column = "personal";
                $go = true;
            }
            if ($form == 2) {
                $column = "education";
                $total_edu = $user->getTotalAppEduHist($_SESSION['ghApplicant']);
                if (!empty($total_edu[0]["total"])) {
                    $go = true;
                } else {
                    $go = false;
                    $data["message"] = "Add at least one education history.";
                }
            }
            if ($form == 3) {
                $column = "programme";
                $go = true;
            }
            if ($form == 4) {
                $column = "uploads";
                $acaB = $user->fetchApplicantAcaB($_SESSION['ghApplicant']);
                if (!empty($acaB) && $acaB[0]["awaiting_result"] == 1 && $_SESSION['applicantType'] > 1) {
                    $go = true;
                } else {
                    $total_upl = $user->getTotalAppUploads($_SESSION['ghApplicant']);
                    if (!empty($total_upl[0]["total"])) {
                        if ($_SESSION['applicantType'] == 1) {
                            $files = $user->getApplicantUploads($_SESSION['ghApplicant']);
                            if (count($files)) {
                                $fileCount = 0;
                                foreach ($files as $file) {
                                    if (isset($file["type"]) && strtolower($file["type"]) == "certificate") {
                                        $fileCount += 1;
                                    } else if (isset($file["type"]) && strtolower($file["type"]) == "transcript") {
                                        $fileCount += 1;
                                    } else if (isset($file["type"]) && strtolower($file["type"]) == "cv") {
                                        $fileCount += 1;
                                    } else if (isset($file["type"]) && strtolower($file["type"]) == "recommendation") {
                                        $fileCount += 1;
                                    } else if (isset($file["type"]) && strtolower($file["type"]) == "nid") {
                                        $fileCount += 1;
                                    } else if (isset($file["type"]) && strtolower($file["type"]) == "sop") {
                                        $fileCount += 1;
                                    }
                                }

                                $progName = $user->fetchApplicantProgI($_SESSION['ghApplicant'])[0]["first_prog"];
                                $proInfo = $user->fetchAllFromProgramByName($progName);

                                if (!$progName) {
                                    $go = false;
                                    $data["message"] = "You will have to choose a programme from the <b>Programme Information</b> section in other to validate this page or view additional information below";
                                } else {
                                    if (strtolower($proInfo[0]["program_code"]) == "msc" && $fileCount >= 7) {
                                        $go = true;
                                    } else if (strtolower($proInfo[0]["program_code"]) == "upgrade" && $fileCount >= 2) {
                                        $go = true;
                                    } else {
                                        $go = false;
                                        $data["message"] = "Please, make sure to provide all the relevant documents stated below.";
                                    }
                                }
                            } else {
                                $go = false;
                                $data["message"] = "Upload your education certificate and all other relevant documents stated below.";
                            }
                        } else {
                            $go = true;
                        }
                    } else {
                        $go = false;
                        $data["message"] = "Upload your education certificate and all other relevant documents stated below.";
                    }
                }
            }
            if ($form == 5) {
                $column = "declaration";
                $status = $user->getFormValidationStatus($_SESSION['ghApplicant']);
                if (!empty($status)) {
                    $go = true;
                } else {
                    $go = false;
                    $data["message"] = "You have uncompleted sections. Navigate through the application sections and make sure you provide all the required information.";
                }
            }

            if ($go) {
                if ($user->updateApplicationStatus($column, $_SESSION['ghApplicant'])) {
                    $data["success"] = true;
                    if ($form == 5) $_SESSION['submitted'] = 1;
                }
            } else {
                $data["success"] = false;
            }
        }
        die(json_encode($data));
    }

    //
    else if ($_GET["url"] == "programmes-per-category") {
        if (!isset($_POST["what"]) || empty($_POST["what"])) die(json_encode(array("success" => false, "message" => "Invalid input!")));
        if (!isset($_POST["value"]) || empty($_POST["value"])) die(json_encode(array("success" => false, "message" => "Invalid input!")));
        die(json_encode($user->fetchProgramesByProgramCode($_POST["value"])));
    }
} else if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    parse_str(file_get_contents("php://input"), $_PUT);

    if ($_GET["url"] == "personal") {

        $what = $_PUT["what"];
        $value = $_PUT['value'];

        if (!isset($what) || empty($what)) die(json_encode(array("success" => false, "message" => "Invalid input!")));

        if ($what == "other-number-code" || $what == "phone-number1-code" || $what == "gd-phone-number-code" || $what == "e-phone-number-code") {
            $code = str_replace("+", "", $value);
            $value = "+" . strtoupper($user->validatePhone($code));
        } else {
            $value = strtoupper($user->validateInput($value));
        }

        $column = str_replace("-", "_", $what);

        if ($column == "dob") {
            $value = str_replace("/", "-", $value);
        }

        //English Language and disability check
        if ($column == "disability" || $column == "english_native") {
            if ($value == "YES") {
                $value = 1;
            } else if ($value == "NO") {
                $value = 0;
            }
        }

        //Place of birth 
        if ($column == "region_birth") {
            $column = 'spr_birth';
        }

        if ($column == "home_town") {
            $column = 'city_birth';
        }

        if ($column == "english_native") {
            if ($value == "Yes") {
                $value = 1;
            } else if ($value == "No") {
                $value = 0;
            }
        }

        if ($column == "speak_some_eng") {
            if ($value == "Yes") {
                $value = 1;
            } else if ($value == "No") {
                $value = 0;
            }
            $column = 'speaks_english';
            echo 1;
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
        if ($column == "phone_number1_code") {
            $column = 'phone_no1_code';
        }
        if ($column == "other_number_code") {
            $column = 'phone_no2_code';
        }
        if ($column == "phone_number1") {
            $column = 'phone_no1';
        }
        if ($column == "other_number") {
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
        if ($column == "gd_phone_number_code") {
            $column = 'p_phone_no_code';
        }
        if ($column == "gd_phone_number") {
            $column = 'p_phone_no';
        }
        if ($column == "gd_email_address") {
            $column = 'p_email_addr';
        }

        //Parent/Guardian Legal Name
        if ($column == "e_full_name") {
            $column = 'e_contact_name';
        }
        if ($column == "e_phone_number_code") {
            $column = 'e_contact_code';
        }
        if ($column == "e_phone_number") {
            $column = 'e_contact_phone';
        }
        if ($column == "e_email_address") {
            $column = 'e_contact_email';
        }

        $result = $user->updateApplicantInfo($column, $value, $_SESSION['ghApplicant']);
        die($result ? json_encode(array("success" => true)) : json_encode(array("success" => false)));
    }

    //
    elseif ($_GET["url"] == "education") {
        // Old way
        $what = $_PUT["what"];
        $value = $_PUT['value'];
        $s_number = $_PUT["snum"];
        $subject_type = $_PUT["subj_type"];
        $subject_id = $_PUT["subj_id"];

        if (!isset($what) || empty($what) || !isset($value) || empty($value) || !isset($s_number) || empty($s_number))
            die(json_encode(array("success" => false, "message" => "Invalid input!")));

        if (!$subject_id) {

            $column = substr(str_replace("-", "_", $what), 5);
            if ($column == "sch_name") {
                $column = 'school_name';
            } else if ($column == "sch_country") {
                $column = 'country';
            } else if ($column == "sch_region") {
                $column = 'region';
            } else if ($column == "sch_city") {
                $column = 'city';
            } else if ($column == "course_studied") {
                $column = 'course_of_study';
            }
            $result = $user->updateAcademicInfo($column, $value, $s_number, $_SESSION['ghApplicant']);
        } else {
            $result = $user->updateHighSchoolResultInfo($subject_type, $value, $s_number, $subject_id);
        }

        die($result ? json_encode(array("success" => true)) : json_encode(array("success" => false)));
    }

    //
    elseif ($_GET["url"] == "prev-uni-recs") {

        $what = $_PUT["what"];
        $value = strtoupper($_PUT['value']);

        if (!isset($what) || empty($what)) die(json_encode(array("success" => false, "message" => "Invalid input!")));

        $column = str_replace("-", "_", $what);

        if ($column == "prev_uni_rec") {
            $column = 'pre_uni_rec';
        }

        if ($column == "month_completed_uni") {
            $column = 'month_completed';
        }

        if ($column == "year_completed_uni") {
            $column = 'year_completed';
        }

        if ($column == "completed_prev_uni") {
            $column = 'completed';
        }

        //$column = substr_replace($column, "", -1);
        $result = $user->updatePrevUniInfo($column, $value, $_SESSION['ghApplicant']);
        die($result ? json_encode(array("success" => true)) : json_encode(array("success" => false)));
    }

    //
    elseif ($_GET["url"] == "programmes") {

        $what = $_PUT["what"];
        $value = $user->validateInputTextOnly($_PUT['value']);

        if (!isset($what) || empty($what)) die(json_encode(array("success" => false, "message" => "Invalid input!")));

        $column = str_replace("-", "_", $what);

        if ($column == "app_prog_first") {
            $column = 'first_prog';
        }

        if ($column == "app_prog_second") {
            $column = 'second_prog';
        }

        if ($column == "medium_descript") {
            $column = 'description';
        }

        if ($column == "app_term") {
            $column = 'application_term';
        }

        if ($column == "medium" || $column == "description") {
            $result = $user->updateHowYouKnowUs($column, $value["message"], $_SESSION['ghApplicant']);
        } else {
            $result = $user->updateProgramInfo($column, $value["message"], $_SESSION['ghApplicant']);
        }

        die($result ? json_encode(array("success" => true)) : json_encode(array("success" => false)));
    }

    // DELETE Requests
} else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    parse_str(file_get_contents("php://input"), $_DELETE);

    if ($_GET["url"] == "education") {

        $data = [];

        if ($_DELETE["what"] == "delete-edu-history") {
            $what = $_DELETE["what"];
            $value = substr($_DELETE['value'], 6); // serial number

            if ($user->deleteEducationHistory($value, $_SESSION['ghApplicant'])) {
                $data['success'] = true;
                $data['message'] = 'Successfully deleted!';
            } else {
                $data['success'] = false;
                $data['message'] = 'Deletion failed!';
            }
        }

        die(json_encode($data));
    } elseif ($_GET["url"] == "upload-file") {
        $what = $_DELETE["what"];
        $type = substr($_DELETE['what'], 0, 11);
        $value = substr($_DELETE['what'], 12); // serial number

        $result = $user->deleteUploadedFile($value, $_SESSION['ghApplicant']);

        die(json_encode($result));
    }
} else {
    http_response_code(405);
}
