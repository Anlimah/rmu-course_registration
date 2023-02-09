<?php
session_start();
if (isset($_SESSION['ghAppLogin']) && $_SESSION['ghAppLogin'] == true) {
    if (!(isset($_SESSION["ghApplicant"]) && !empty($_SESSION['ghApplicant']))) {
        header('Location: ./index.php?status=error&message=Invalid access!');
    }
} else {
    header('Location: ./index.php?status=error&message=Invalid access!');
}

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
    </style>
</head>

<body id="body">

    <?php require_once("../inc/top-page-section.php") ?>

    <div class="main-content" style="height: 100% !important;">
        <a href="?logout=true" class="btn btn-danger" style="float: right">Log out</a>
        <h1><?= $page["name"] ?></h1>
        <h4 class="text-success">Congratulations! Your application form was successfully submitted.</h4>

        <div class="mt-4">
            <label for="">
                <span>You can download a copy of your application form</span>
                <button type="button" class="btn btn-primary btn-sm">Download</button>
            </label>
        </div>

        <hr class="mb-4 mt-4">

        <div class="mb-4 mt-4">
            <h4 for="">Progress of your application status</h4>
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
                        font-size: 15px;
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
                        <div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
                            <div class="px-0 pt-4 pb-0 mt-3 mb-3">
                                <form id="form">
                                    <ul id="progressbar">
                                        <li class="active" id="step1">
                                            <strong> <span class="bi bi-send-check"></span> Submitted </strong>
                                        </li>
                                        <li id="step2"> <strong> <span class="bi bi-"></span> Reviewed </strong> </li>
                                        <li id="step3"> <strong> <span class="bi bi-"></span> Admission </strong> </li>
                                    </ul>
                                    <!--<div class="progress">
                                        <div class="pbar"> </div>
                                    </div>-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        var currentGfgStep, nextGfgStep, preGfgStep;
                        var opacity;
                        var current = 1;
                        var steps = $("fieldset").length;
                        setProgressBar(current);
                        $(".next-step").click(function() {
                            currentGfgStep = $(this).parent();
                            nextGfgStep = $(this).parent().next();
                            $("#progressbar li").eq($("fieldset").index(nextGfgStep)).addClass("active");
                            nextGfgStep.show();
                            currentGfgStep.animate({
                                opacity: 0
                            }, {
                                step: function(now) {
                                    opacity = 1 - now;
                                    currentGfgStep.css({
                                        'display': 'none',
                                        'position': 'relative'
                                    });
                                    nextGfgStep.css({
                                        'opacity': opacity
                                    });
                                },
                                duration: 500
                            });
                            setProgressBar(++current);
                        });
                        $(".pre-step").click(function() {
                            currentGfgStep = $(this).parent();
                            preGfgStep = $(this).parent().prev();
                            $("#progressbar li").eq($("fieldset")
                                .index(currentGfgStep)).removeClass("active");
                            preGfgStep.show();
                            currentGfgStep.animate({
                                opacity: 0
                            }, {
                                step: function(now) {
                                    opacity = 1 - now;
                                    currentGfgStep.css({
                                        'display': 'none',
                                        'position': 'relative'
                                    });
                                    preGfgStep.css({
                                        'opacity': opacity
                                    });
                                },
                                duration: 500
                            });
                            setProgressBar(--current);
                        });

                        function setProgressBar(currentStep) {
                            var percent = parseFloat(100 / steps) * current;
                            percentpercent = percent.toFixed();
                            $(".pbar")
                                .css("width", percent + "%")
                        }
                        $(".submit").click(function() {
                            return false;
                        })
                    });
                </script>
            </div>
        </div>
        <!--<div class="help_area">
            <div class="help_chat_area"></div>
            <button style="padding: 5px 10px; cursor: pointer">Chat with us</button>
        </div>-->
        <footer class="footer">
            <ul>
                <li>
                    <a href="/" target="_blank">Privacy</a>
                </li>
                <li>
                    <a href="/" target="_blank">Terms of Use</a>
                </li>
                <li>
                    <a href="/" target="_blank">Support</a>
                </li>
            </ul>
        </footer>
    </div>
</body>

</html>