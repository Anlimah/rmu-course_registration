<?php

use Src\Controller\ExposeDataController;

session_start();
if (isset($_SESSION['step5Done']) && $_SESSION['step5Done'] == true) {
    if (!isset($_SESSION["_step6Token"])) {
        $rstrong = true;
        $_SESSION["_step6Token"] = hash('sha256', bin2hex(openssl_random_pseudo_bytes(64, $rstrong)));
    }
} else {
    header('Location: purchase_step5.php');
}

require_once('../bootstrap.php');
$expose = new ExposeDataController();

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
    <h1>Step 6</h1>
    <form action="#" id="step1Form" method="post" enctype="multipart/form-data">
        <div>
            <label for="gender">Form type</label>
            <select name="form_type" id="form_type">
                <option value="select" hidden>Select</option>
                <?php
                $data = $expose->getFormTypes();
                foreach ($data as $ft) {
                    echo '<option value="' . $ft['name'] . '">' . $ft['name'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div>
            <label for="gender">Payment Method</label>
            <select name="pay_method" id="pay_method">
                <option value="select" hidden>Select</option>
                <?php
                $data = $expose->getPaymentMethods();
                foreach ($data as $pm) {
                    echo '<option value="' . $pm['name'] . '">' . $pm['name'] . '</option>';
                }
                ?>
            </select>
        </div>
        <button type="submit" style="padding: 5px 10px">Continue</button>
        <input type="hidden" name="_v6Token" value="<?= $_SESSION["_step6Token"]; ?>">
    </form>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#step1Form").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../api/verifyStep6",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        console.log(result);
                        if (result) {
                            window.location.href = "../src/Controller/PaymentController.php";
                        }
                    },
                    error: function(error) {}
                });
            });
        });
    </script>
</body>

</html>