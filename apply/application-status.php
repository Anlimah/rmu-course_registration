<?php
session_start();
if (isset($_SESSION['ghAppLogin']) && $_SESSION['ghAppLogin'] == true) {
    if (!(isset($_SESSION["ghApplicant"]) && !empty($_SESSION['ghApplicant']))) {
        header('Location: ./index.php?status=error&message=Invalid access!');
    }
} else {
    header('Location: ./index.php?status=error&message=Invalid access!');
}

if (!$_SESSION["submitted"]) header("Location: {$_SESSION['loginType']}");

if (isset($_GET['logout'])) {
    unset($_SESSION['ghAppLogin']);
    unset($_SESSION['ghApplicant']);
    session_destroy();
    header('Location: ./index.php');
}

$user_id = $_SESSION['ghApplicant'];

$page = array("id" => 0, "name" => "Application Status");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Application Status</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <?php require_once("../inc/apply-head-section.php") ?>
</head>

<body id="body">

    <div id="wrapper">

        <?php require_once("../inc/page-nav.php") ?>

        <main class="container">
            <div class="row">

                <section class="easy-apply" style="margin-top: 25px;">
                    <div class="page_info" style="margin-bottom: 0px !important;">
                        <h1><?= $page["name"] ?></h1>

                        <!--<a href="?logout=true" class="btn btn-danger" style="float: right">Log out</a>-->
                        <div class="mb-4">
                            <h4 class="text-success">Congratulations! Your application form was successfully submitted.</h4>
                        </div>

                        <div class="alert alert-info text-default" id="page_info_text" style="width: 100%; border: none !important">
                            <h4 class="alert-heading">Please note the following:</h4>
                            <ul style="list-style-type: disc;">
                                <li>Frequently visit this page to check your application status.</li>
                                <li>When admitted, a SMS and/or an email will be sent to your personal email address and/or phone number you provided during application.</li>
                                <li>You will then need to visit this page again, and fill an acceptance form, which will guarantee your admission.</li>
                                <li>For any other information, please contact the Regional Maritime University for assistance.</li>
                            </ul>
                        </div>

                    </div>

                    <!--<div class="mt-4">
                        <label for="">
                            <span class="me-4">You can download a copy of your application form</span>
                            <a href="./download-copy.php" class="btn btn-primary btn-sm" style="color: #fff !important">Download</a>
                        </label>
                    </div>-->

                    <hr class="mb-4 mt-4">

                    <div class="mb-4 mt-4">
                        <h4 for="">Your application's progress status</h4>
                        <div>
                            <style>
                                #form {
                                    text-align: center;
                                    position: relative;
                                    margin-top: 20px
                                }

                                #form fieldset {
                                    background: white;
                                    border: 0 none;
                                    border-radius: 0.5rem;
                                    box-sizing: border-box;
                                    width: 100%;
                                    margin: 0;
                                    padding-bottom: 20px;
                                    position: relative
                                }

                                .finish {
                                    text-align: center
                                }

                                #form fieldset:not(:first-of-type) {
                                    display: none
                                }

                                #form .pre-step {
                                    width: 100px;
                                    font-weight: bold;
                                    color: white;
                                    border: 0 none;
                                    border-radius: 0px;
                                    cursor: pointer;
                                    padding: 10px 5px;
                                    margin: 10px 5px 10px 0px;
                                    float: right
                                }

                                .next-step {
                                    width: 100px;
                                    font-weight: bold;
                                    color: white;
                                    border: 0 none;
                                    border-radius: 0px;
                                    cursor: pointer;
                                    padding: 10px 5px;
                                    margin: 10px 5px 10px 0px;
                                    float: right
                                }

                                .form,
                                .pre-step {
                                    background: #616161;
                                }

                                .form,
                                .next-step {
                                    background: red;
                                }

                                #form .pre-step:hover {
                                    background-color: #000000
                                }

                                #form .pre-step:focus {
                                    background-color: #000000
                                }

                                #form .next-step:hover {
                                    background-color: #2F8D46
                                }

                                #form .next-step:focus {
                                    background-color: #2F8D46
                                }

                                .text {
                                    color: red;
                                    font-weight: normal
                                }

                                #progressbar {
                                    margin-bottom: 30px;
                                    overflow: hidden;
                                    color: lightgrey
                                }

                                #progressbar .active {
                                    color: #2F8D46
                                }

                                #progressbar li {
                                    list-style-type: none;
                                    font-size: 14px;
                                    width: 25%;
                                    float: left;
                                    position: relative;
                                    font-weight: 400
                                }

                                #progressbar #step1:before {
                                    content: "1"
                                }

                                #progressbar #step2:before {
                                    content: "2"
                                }

                                #progressbar #step3:before {
                                    content: "3"
                                }

                                #progressbar #step4:before {
                                    content: "4"
                                }

                                #progressbar li:before {
                                    width: 50px;
                                    height: 50px;
                                    line-height: 45px;
                                    display: block;
                                    font-size: 20px;
                                    color: #ffffff;
                                    background: lightgray;
                                    border-radius: 50%;
                                    margin: 0 auto 10px auto;
                                    padding: 2px
                                }

                                #progressbar li:after {
                                    content: '';
                                    width: 100%;
                                    height: 2px;
                                    background: lightgray;
                                    position: absolute;
                                    left: 0;
                                    top: 25px;
                                    z-index: -1
                                }

                                #progressbar li.active:before {
                                    background: #2F8D46
                                }

                                #progressbar li.active:after {
                                    background: #2F8D46
                                }

                                #progressbar li.active:after {
                                    background: #2F8D46
                                }

                                h2 {
                                    text-transform: uppercase;
                                    font-weight: normal;
                                    text-align: center;
                                    margin: 10;
                                    padding: 10;
                                    color: red;
                                }

                                .progress {
                                    height: 20px
                                }

                                .pbar {
                                    background-color: #2F8D46
                                }
                            </style>

                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-12 text-center p-0 mb-2">
                                        <div class="px-0 pt-4 pb-0 mt-3 mb-3">
                                            <form id="form">
                                                <ul id="progressbar">
                                                    <li class="active" id="step1">
                                                        <strong> <span class="bi bi-send-check"></span> Submitted </strong>
                                                    </li>
                                                    <li id="step2">
                                                        <strong> <span class="bi bi-yelp"></span> Reviewed </strong>
                                                    </li>
                                                    <li id="step3">
                                                        <strong> <span class="bi bi-list-check"></span> Admission </strong>
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

            </div>
        </main>
        <?php require_once("../inc/page-footer.php"); ?>

        <?php //require_once("../inc/app-sections-menu.php"); 
        ?>
    </div>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/myjs.js"></script>
    <script>
        $(document).ready(function() {
            var currentGfgStep, nextGfgStep, preGfgStep;
            var opacity;
            var current = 1;
            var steps = $("fieldset").length;

            setProgressBar(current);

            $(".submit").click(function() {
                return false;
            });

        });
    </script>
</body>

</html>