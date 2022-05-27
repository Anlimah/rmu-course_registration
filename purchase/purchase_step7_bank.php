<?php
session_start();
if (isset($_SESSION['step6Done']) && $_SESSION['step6Done'] == true) {
    if (!isset($_SESSION["_step7BankToken"])) {
        $rstrong = true;
        $_SESSION["_step7BankToken"] = hash('sha256', bin2hex(openssl_random_pseudo_bytes(64, $rstrong)));
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
            <label for="country">Country</label>
            <select name="country" id="country">
                <option value="CA">Cameroun</option>
                <option value="GA">Gambia</option>
                <option value="GH" selected>Ghana</option>
                <option value="SL">Serria Leone</option>
                <option value="LI">Liberia</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div>
            <label for="bank">Bank</label>
            <select name="bank" id="bank">
                <option value="Access Bank" selected>Access Bank</option>
                <option value="Guaranty Trust Bank">Guaranty Trust Bank</option>
                <option value="First Bank">First Bank</option>
                <option value="Sterling Bank">Sterling Bank</option>
                <option value="United Bank for Africa">United Bank for Africa</option>
                <option value="Zenith Bank">Zenith Bank</option>
            </select>
        </div>
        <div>
            <label for="account_number">Account number</label>
            <input type="password" maxlength="14" name="account_number" id="account_number" placeholder="XXXXXXXXXXXXXX">
        </div>
        <button type="submit">Pay</button>
        <input type="hidden" name="_v7BankToken" value="<?php echo $_SESSION["_step7BankToken"]; ?>">
    </form>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
        /*$(document).ready(function() {
            $("#step1Form").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../api/verifyStep7Bank",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        console.log(result);
                        /*if (result) {
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