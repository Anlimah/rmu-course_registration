<?php
session_start();
if (!isset($_SESSION["_step5Token"])) {
    $rstrong = true;
    $_SESSION["_step5Token"] = hash('sha256', bin2hex(openssl_random_pseudo_bytes(64, $rstrong)));
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
    <h1>Register</h1>
    <form action="#" id="step1Form" method="post" enctype="multipart/form-data">
        <p>
            Enter the one-time passcode sent to your 0244123123.
        </p>
        <a href="purchase_step4.php">Change number</a>
        <div>
            <label for="email_addr">RMU - </label>
            <input type="text" maxlength="1" style="width:15px; text-align:center" name="code[]" id="num1" class="num" placeholder="0">
            <input type="text" maxlength="1" style="width:15px; text-align:center" name="code[]" id="num2" class="num" placeholder="0">
            <input type="text" maxlength="1" style="width:15px; text-align:center" name="code[]" id="num3" class="num" placeholder="0">
            <input type="text" maxlength="1" style="width:15px; text-align:center" name="code[]" id="num4" class="num" placeholder="0">
        </div>
        <button type="submit">Verify</button>
        <input type="hidden" name="_v5Token" value="<?php echo $_SESSION["_step5Token"]; ?>">
    </form>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#step1Form").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../api/verifyStep5",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        console.log(result);
                        if (result) {
                            window.location.href = 'purchase_step6.php';
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