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
                                        <label class="form-label" for="index_number">Index Number</label>
                                        <input class="form-control form-control-login" type="text" id="index_number" name="index_number" placeholder="Index Number">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="password">Password</label>
                                        <input class="form-control form-control-login" type="password" id="password" name="password" placeholder="Password">
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

            $("#appLoginForm").on("submit", function(e) {

                if ($("#index_number").val().length !== 10) {
                    alert("Invalid index number!");
                    return;
                }

                if ($("#password").val().length < 8 || $("#password").val().length >= 16) {
                    alert("Invalid password!");
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "api/studentLogin",
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