<?php
session_start();
if (isset($_SESSION['step6Done']) && $_SESSION['step6Done'] == true) {
    if (!isset($_SESSION["_step7MomoToken"])) {
        $rstrong = true;
        $_SESSION["_step7MomoToken"] = hash('sha256', bin2hex(openssl_random_pseudo_bytes(64, $rstrong)));
    }
} else {
    header('Location: purchase_step6.php');
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
    <h1>Step 7</h1>
    <form action="../src/Controller/PaymentController.php" id="step1Form" method="post" enctype="multipart/form-data">
        <p>
            Paying <b>
                <span><?= $_SESSION["step6"]["amount"] ?></span>
            </b> for
            <b><span><?= $_SESSION["step6"]["form_type"] ?></span></b> application forms.
        </p>
        <div>
            <label for="momo_agent">MoMo Number</label>
            <select name="momo_agent" id="momo_agent">
                <option value="AIRTELTIGO">AIRTELTIGO</option>
                <option value="MTN" selected>MTN</option>
                <option value="VODAFONE">VODAFONE</option>
            </select>
            <input type="tel" name="momo_number" id="momo_number" placeholder="0244123123">
        </div>
        <button type="submit">Pay</button>
        <input type="hidden" name="_v7MomoToken" value="<?php echo $_SESSION["_step7MomoToken"]; ?>">
        <input type="hidden" name="country" value="GH">
    </form>


    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
        /*$(document).ready(function() {
            $("#step1Form").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../api/verifyStep7Momo",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        console.log(result);
                        if (result) {
                            window.location.href = 'purchase_confirm.php';
                        }
                        if (res["response"] == "success") {
                            console.log(res['msg']);
                            window.location.href = 'verify-code.php'
                        } else {
                            console.log(res['msg']);
                        }
                    },
                    error: function(error) {}
                });
            });
        });*/
    </script>
</body>

</html>