<?php
session_start();

if (!isset($_SESSION["_start"])) {
    $rstrong = true;
    $_SESSION["_start"] = hash('sha256', bin2hex(openssl_random_pseudo_bytes(64, $rstrong)));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RMU Online Applicatioin Portal</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Roboto+Mono:wght@700&family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .app-step {
            padding: 10px;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
        }

        div .col-1 {
            font-size: 20px;
            background-color: #003262;
            height: 100%;
            padding: 5px 10px;
            color: #fff;
        }
    </style>
</head>

<body class="fluid-container">

    <div id="wrapper">

        <nav class="fp-header">
            <div class="container">
                <div class="items">
                    <img src="../assets/images/rmu-logo.png" alt="RMU logo" style="width: 60px;">
                    <div class="flex-column justify-center" style="height: 100% !important; line-height: 1.3">
                        <span class="rmu-logo-letter" style="font-weight: 600; letter-spacing: 0.0rem">REGIONAL MARITIME UNIVERSITY</span>
                        <span class="rmu-logo-letter" style="letter-spacing: 0.3rem">APPLICATION PORTAL</span>
                    </div>
                </div>
            </div>
        </nav>

        <div class="row content">

            <!--Voucher purchase info-->
            <section class="col-md-6 col-sm-12 easy-apply" style="background-color: #f2f2f2 !important;">

                <div class="container">

                    <h1 class="text-center" style="font-weight: 100;"><u style="font-weight: 300;">EASY STEPS TO APPLY</u></h1>

                    <div class="app-step row">
                        <div class="col-1 text-center">1</div>
                        <p class="col-11">
                            Purchase an e-voucher <a href="https://forms.rmuictonline.com/buy-online">online here</a> using
                            <span style="color:#003262; font-weight:bolder">MoMo</span> or <span style="color:#003262; font-weight:bolder">Card</span>
                            (Visa, Master) or from any of the <a href="">vendors listed here</a>.
                        </p>
                    </div>
                    <div class="app-step row">
                        <div class="col-1 text-center">2</div>
                        <p class="col-11">
                            Login with the form on the right hand side, using the voucher APPLICATION and PIN NUMBER that was provided to you via SMS and/or Email.
                        </p>
                    </div>
                    <div class="app-step row">
                        <div class="col-1 text-center">3</div>
                        <p class="col-11">
                            Select your mode of entry and indicate your entry type (i.e Post WASSCE/SSCE, Post Diploma, Matured ... etc). Click submit to start applying.
                        </p>
                    </div>
                    <div class="app-step row">
                        <div class="col-1 text-center">4</div>
                        <p class="col-11">
                            Fill application form and attach your passport picture. The applicant’s passport picture should be in .jpg, .jpeg, .png or .gif format and must not exceed 100KB in size. Make sure you upload a picture showing your face clearly.
                        </p>
                    </div>
                    <div class="app-step row">
                        <div class="col-1 text-center">5</div>
                        <p class="col-11">
                            Clicking the SUBMIT AND PRINT button will submit the form and generate a reference number which will be sent to the phone number you specified. Make sure you provide correct information before submitting the form. Changes after form submission is not allowed.
                        </p>
                    </div>
                    <div class="app-step row">
                        <div class="col-1 text-center">6</div>
                        <p class="col-11">
                            Click logout to leave the page. On subsequent logins you will be sent to a tracking page where you can track and print the application form you filled.
                        </p>
                    </div>
                </div>
            </section>

            <!--Login form-->
            <section class="col-md-6 col-sm-12 login" style="display:flex; flex-direction:column; align-items:center; justify-content: center">

                <div style="width:auto">

                    <div class="card container" style="margin-bottom: 50px; margin-top: 50px; padding-top:15px; max-width: 302px">
                        <h1>Login</h1>
                        <hr style="margin-top: auto;">

                        <p style="width: auto">
                            Please enter the application and pin number received by SMS and/or Email
                            in the form below to begin with the application process!
                        </p>

                        <form id="appLoginForm" style="margin-top: 15px;">
                            <div class="mb-4" style="width: 280px">
                                <label class="form-label" for="app_number">Application Number</label>
                                <div class="input-group ">
                                    <span class="input-group-text" id="basic-addon1" style="font-weight: 600;">RMU - </span>
                                    <input class="form-control form-control-lg form-control-login" type="text" id="app_number" name="app_number" aria-describedby="basic-addon1" placeholder="Application Number">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="pin_code">PIN Code</label>
                                <input class="form-control form-control-lg form-control-login" style="width: 280px" type="password" id="pin_code" name="pin_code" placeholder="PIN Code">
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary form-btn-login">Login</button>
                            </div>
                            <input type="hidden" name="_logToken" value="<?= $_SESSION['_start'] ?>">
                        </form>

                    </div>

                    <fieldset class="fieldset text-center container" style="display: flex !important; flex-direction: column !important; align-items:center !important; max-width: 280px !important; min-width: 280px !important; font-size: 14px">
                        <legend style="width:100%; text-align: center;">Need Help?</legend>
                        <p style="width: 100%;">
                            <span class="bi bi-telephone-fill"></span>
                            <a href=" tel:+233302712775">+233302712775</a>
                        </p>
                        <p style="width: 100%;">
                            <span class="bi bi-envelope-fill"></span>
                            <a href="mailto:university.registrar@rmu.edu.gh">university.registrar@rmu.edu.gh</a>
                        </p>
                    </fieldset>

                </div>

            </section>
        </div>

        <?php require_once('../inc/page-footer.php') ?>
    </div>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            $("input").on("click", function() {
                $(this).select();
            });

            $("#appLoginForm").on("submit", function(e) {

                /**
                 *  Pregmatch: 
                 *  1. Only numbers allowed
                 *  2. Min and Max of 8
                 */
                if ($("#app_number").val().length > 8 || $("#app_number").val().length < 8) {
                    alert("Invalid application number or PIN");
                    return;
                }


                /**
                 *  Pregmatch: 
                 *  1. Alpha numeric allowed
                 *  2. Min and Max of 9
                 *  3. Case sensitive: only upper cases
                 */
                if ($("#pin_code").val().length < 9 || $("#pin_code").val().length > 9) {
                    alert("Invalid application number or PIN");
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "../api/appLogin",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        console.log(result);
                        //alert(result['message']);
                        if (result.response == 'success') {
                            window.location.href = result.message;
                        } else {
                            alert(result['message']);
                        }
                    },
                    error: function(error) {}
                });

                e.preventDefault();
            });
        });
    </script>
</body>

</html>