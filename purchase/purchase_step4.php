<?php
session_start();
if (isset($_SESSION['step3Done']) && $_SESSION['step3Done'] == true) {
    if (!isset($_SESSION["_step4Token"])) {
        $rstrong = true;
        $_SESSION["_step4Token"] = hash('sha256', bin2hex(openssl_random_pseudo_bytes(64, $rstrong)));
    }
} else {
    header('Location: purchase_step3.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchases</title>

</head>

<body>
    <img src="../images/RMU-LOG.png" alt="RMU LOG">
    <h1>step 4</h1>
    <form action="#" id="step1Form" method="post" enctype="multipart/form-data">
        <div>
            <p>
                For your security, Cloudways wants to make sure it's really you. Please <br>
                enter your phone number below. We'll send you a text message with a <br>
                code that you'll need to enter on the next screen. <br><br>

                <b>Note:</b> We don't accept VoIP or Skype numbers.
            </p>
            <label for="phone_number">Phone Number</label>
            <select name="country" id="country">
                <option value="CA">Cameroun</option>
                <option value="GA">Gambia</option>
                <option value="GH" selected>Ghana (+233)</option>
                <option value="SL">Serria Leone</option>
                <option value="LI">Liberia</option>
                <option value="Other">Other</option>
            </select>
            <input type="tel" name="phone_number" id="phone_number" placeholder="0244123123">
        </div>
        <button type="submit" style="padding: 5px 10px">Verify</button>
        <input type="hidden" name="_v4Token" value="<?= $_SESSION["_step4Token"]; ?>">
    </form>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#step1Form").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../api/verifyStep4",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        console.log(result);
                        if (result) {
                            window.location.href = 'purchase_step5.php';
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

            $("#phone_number").focus();
        });
    </script>
</body>

</html>