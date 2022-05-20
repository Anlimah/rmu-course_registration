<?php
session_start();
if (!isset($_SESSION["_step3Token"])) {
    $rstrong = true;
    $_SESSION["_step3Token"] = hash('sha256', bin2hex(openssl_random_pseudo_bytes(64, $rstrong)));
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
    <h1>step 3: Verify your email address</h1>
    <form action="#" id="step1Form" method="post" enctype="multipart/form-data">
        <p>
            A 6 digit code has been sent to the email surname@example.com. Enter the code
        </p>
        <a href="purchase_step2.php">Change email address</a>
        <div>
            <label for="email_addr">RMU - </label>
            <input type="text" maxlength="1" style="width:15px; text-align:center" name="num[]" id="num1" class="num" placeholder="0">
            <input type="text" maxlength="1" style="width:15px; text-align:center" name="num[]" id="num2" class="num" placeholder="0">
            <input type="text" maxlength="1" style="width:15px; text-align:center" name="num[]" id="num3" class="num" placeholder="0">
            <input type="text" maxlength="1" style="width:15px; text-align:center" name="num[]" id="num4" class="num" placeholder="0">
            <input type="text" maxlength="1" style="width:15px; text-align:center" name="num[]" id="num5" class="num" placeholder="0">
            <input type="text" maxlength="1" style="width:15px; text-align:center" name="num[]" id="num6" class="num" placeholder="0">
        </div>
        <button type="submit">Continue</button>
        <input type="hidden" name="_v3Token" value="<?php echo $_SESSION["_step3Token"]; ?>">
    </form>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#step1Form").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../api/verifyStep3",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        console.log(result);
                        if (result) {
                            window.location.href = 'purchase_step4.php';
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

            $(".num").on("keyup", function() {
                if (this.value) {
                    $(this).next(":input").focus();
                }
            });
        });
    </script>
</body>

</html>