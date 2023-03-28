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
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>RMU Online Applicatioin Portal</title>
    <?php require_once("../inc/apply-head-section.php") ?>
</head>

<body>

    <div id="wrapper">

        <?php require_once("../inc/page-nav.php") ?>

        <main>
            <div class="row">

                <div class="col-md-6 app-steps-section">
                    <!--Voucher purchase info-->
                    <section class="easy-apply">

                        <h1 class="text-center" style="margin-top: 40px !important;"><u style="font-weight: 100; font-size: 32px">EASY STEPS TO APPLY</u></h1>

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
                                Login with the form on the right hand side, using the voucher <span style="color:#003262; font-weight:bolder">APPLICATION</span> and
                                <span style="color:#003262; font-weight:bolder">PIN</span> number that was provided to you via SMS and/or Email.
                            </p>
                        </div>
                        <div class="app-step row">
                            <div class="col-1 text-center">3</div>
                            <p class="col-11">
                                The application form is sub-divided into 5 sections. After filling form in each section, click
                                <span style="color:#003262; font-weight:bolder">CHECK AND CONTINUE</span> button
                                to verify that all required fields have been provided for.
                            </p>
                        </div>
                        <div class="app-step row">
                            <div class="col-1 text-center">4</div>
                            <p class="col-11">
                                The applicant’s passport picture should be in <span style="color:red; font-weight:bolder">.jpg, .jpeg, .png </span> or
                                <span style="color:red; font-weight:bolder">.gif</span> format and must not exceed 100KB in size. Make sure you upload a picture showing your face clearly.
                            </p>
                        </div>
                        <div class="app-step row">
                            <div class="col-1 text-center">5</div>
                            <p class="col-11">
                                In the final section, verify and make sure that all information provided is correct before you submit.
                                Clicking the <span style="color:#003262; font-weight:bolder">SUBMIT AND PRINT</span> button to submit the form and generate a reference number which will be sent to the phone number you specified. Changes after form submission is not allowed.
                            </p>
                        </div>
                        <div class="app-step row">
                            <div class="col-1 text-center">6</div>
                            <p class="col-11">
                                Click logout to leave the page. On subsequent logins you will be sent to a tracking page where you can track and print the application form you filled.
                            </p>
                        </div>

                    </section>
                </div>

                <div class="col-md-6 login-section">
                    <section class="login">

                        <div style="width:auto">

                            <!--Form card-->
                            <div class="card loginFormContainer" style="margin-bottom: 50px; margin-top: 50px; max-width: 360px">
                                <h1 style="margin: 0px 12% !important; margin-top:20px !important">Login</h1>

                                <hr style="width: 100%">

                                <p style="margin: 0px 12% !important; margin-bottom:20px !important">
                                    Please enter the application and pin number received by SMS and/or Email
                                    in the form below to begin with the application process!
                                </p>

                                <form id="appLoginForm" style="margin: 0px 12% !important; margin-top: 15px !important;">

                                    <div class="mb-4">
                                        <label class="form-label" for="app_number">Application Number</label>
                                        <input class="form-control form-control-lg form-control-login" type="text" id="app_number" name="app_number" placeholder="Application Number">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="pin_code">PIN Code</label>
                                        <input class="form-control form-control-lg form-control-login" type="password" id="pin_code" name="pin_code" placeholder="PIN Code">
                                    </div>

                                    <div class="mb-4">
                                        <button type="submit" class="btn btn-primary form-btn-login">Login</button>
                                    </div>
                                    <input type="hidden" name="_logToken" value="<?= $_SESSION['_start'] ?>">
                                </form>

                            </div>

                            <!--Help center card-->
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

            </div>
        </main>
        <?php require_once("../inc/page-footer.php"); ?>

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
                if ($("#app_number").val().length > 12 || $("#app_number").val().length < 8) {
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