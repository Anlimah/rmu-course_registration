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
    <img src="../assets/images/RMU-LOG.png" alt="RMU LOG">
    <h1>Step 7</h1>
    <form id="step7MoMoForm" method="post" enctype="multipart/form-data">
        <p>
            Forms for <b><span><?= $_SESSION["step6"]["form_type"] ?></span></b>
            cost <b> GHS<span><?= $_SESSION["step6"]["amount"] ?></span></b>. <br>
            <span>Make sure you have enough fund in you MoMo account.</span>
        </p>
        <p>
            Choose your network to continue.
        </p>
        <div>
            <label for="momo_agent">MoMo Number</label>
            <select name="momo_agent" id="momo_agent">
                <option value="AIR">AIRTEL</option>
                <option value="MTN" selected>MTN</option>
                <option value="TIG">TIGO</option>
                <option value="VOD">VODAFONE</option>
            </select>
            <input type="tel" name="momo_number" id="momo_number" value="<?= $_SESSION['step4']['phone_number'] ?>">
        </div>
        <button type="submit">Pay</button>
        <input type="hidden" name="_v7MomoToken" value="<?php echo $_SESSION["_step7MomoToken"]; ?>">
        <input type="hidden" name="country" value="GH">
    </form>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#step7MoMoForm").on("submit", function(e) {
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
                        if (result['status'] == 'success') {
                            window.location.href = "../src/Controller/OrchardPaymentController.php";
                        } else {
                            alert(result.message)
                        }
                    },
                    error: function(error) {}
                });
            });
        });
    </script>
</body>

</html>