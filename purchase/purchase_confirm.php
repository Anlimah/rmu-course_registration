<?php
session_start();
require_once("../src/Controller/PaymentSubController.php");

use Src\Controller\PaymentSubController;

$pc = new PaymentSubController();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
</head>

<body>
    <form method="POST" action="https://checkout.flutterwave.com/v3/hosted/pay">
        <button type="submit">Pay Now</button>
        <input type="hidden" name="public_key" value="<?php echo getenv("PUBLIC_KEY") ?>" />
        <input type="hidden" name="tx_ref" value="bitethtx-019203" />
        <input type="hidden" name="amount" value="<?= $_SESSION["step7"]["amount"] ?>" />
        <input type="hidden" name="currency" value="GH" />
        <input type="hidden" name="redirect_url" value="https://localhost/rmu_admissions/" />
        <input type="hidden" name="meta[token]" value="54" />
        <input type="hidden" name="customer[name]" value="<?= $_SESSION["step1"]["full_name"] ?>" />
        <input type="hidden" name="customer[email]" value="<?= $_SESSION["step2"]["email_address"] ?>" />
    </form>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "../api/verifyStepFinal",
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    console.log(result);
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
    </script>
</body>

</html>