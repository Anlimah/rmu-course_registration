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
</head>

<body>
    <!--Display date and support team tel number-->
    <section id="topbar">
        <div>
            <span class="sm-hide"><img src="https://application.ucc.edu.gh/public/static/images/time.png" alt=""> Mon - Fri 8:00 - 16:30</span> &nbsp;&nbsp;
            <span>
                <span>
                    <img src="https://application.ucc.edu.gh/public/static/images/phone.png" alt="">
                    <a href="tel:+233555729370" style="color: white; text-decoration: none;">0555729370 (Admission Application Related issues only)</a>
                </span>
            </span>
        </div>
    </section>
    <header>
        <!--RMU logo and page title-->
        <img src="../assets/images/RMU-LOG.png" alt="RMU LOG">
        <span>APPLICATION PORTAL</span>
    </header>

    <div>
        <!--Voucher purchase info-->
        <div></div>

        <!--Login form-->
        <div>
            <form id="appLoginForm">
                <div>
                    <label for="app_number">Application Number</label>
                    <input type="text" id="app_number" name="app_number" placeholder="Enter your application number here">
                </div>
                <div>
                    <label for="pin_code">PIN Code</label>
                    <input type="password" id="pin_code" name="pin_code" placeholder="Enter your PIN code here">
                </div>
                <button type="submit">Login</button>
                <input type="hidden" name="_logToken" value="<?= $_SESSION['_start'] ?>">
            </form>
        </div>
    </div>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#appLoginForm").on("submit", function(e) {
                e.preventDefault();
                //window.location.href = "purchase_step2.php";
                $.ajax({
                    type: "POST",
                    url: "../api/appLogin",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        console.log(result);
                        if (result) {
                            window.location.href = 'application-step1.php';
                        }
                        /*if (res["response"] == "success") {
                            console.log(res['msg']);
                            window.location.href = 'verify-code.php'
                        } else {
                            console.log(res['msg']);
                        }*/
                    },
                    error: function(error) {}
                });
            });
        });
    </script>
</body>

</html>