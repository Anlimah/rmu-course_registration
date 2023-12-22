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
    <link rel="stylesheet" href="assets/css/main.css">
    <title>RMU Online Applicatioin Portal</title>
    <?php require_once("inc/apply-head-section.php") ?>
</head>

<body>

    <div id="wrapper">

        <?php require_once("inc/page-nav2.php") ?>

        <main>
            <div class="row">

                <div class="login-section">
                    <section class="login">
                        <div style="width:auto">
                            <!--Form card-->
                            <div class="card loginFormContainer" style="margin-bottom: 50px; margin-top: 50px; min-width: 300px; max-width: 360px">
                                <h1 style="margin: 0px 12% !important; margin-top:20px !important">Login</h1>
                                <hr style="width: 100%">
                                <form id="appLoginForm" style="margin: 0px 12% !important;">
                                    <div class="mb-4">
                                        <label class="form-label" for="app_number">Index Number</label>
                                        <input class="form-control form-control-login" type="text" id="app_number" name="app_number" placeholder="Application Number">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="pin_code">Password</label>
                                        <input class="form-control form-control-login" type="password" id="pin_code" name="pin_code" placeholder="PIN Code">
                                    </div>
                                    <div class="mb-4">
                                        <button type="submit" class="btn btn-primary form-btn-login">Login</button>
                                    </div>
                                    <input type="hidden" name="_logToken" value="<?= $_SESSION['_start'] ?>">
                                </form>
                            </div>
                        </div>
                    </section>
                </div>

            </div>
        </main>
        <?php require_once("inc/page-footer.php"); ?>

    </div>


    <script src="js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            if (window.location.href == "https://admissions.rmuictonline.com/apply/index.php" || window.location.href == "https://admissions.rmuictonline.com/apply/") {
                $("#signout-div").hide();
            }

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
                    url: "api/appLogin",
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