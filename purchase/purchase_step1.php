<?php
session_start();
/*require_once("../src/System/SessionSettings.php");

$session = new SessionSettings();
$session->my_session_start();
$session->my_session_regenerate_id();

echo $_SESSION['new_session_id'];*/

if (!isset($_SESSION["_step1Token"])) {
    $rstrong = true;
    $_SESSION["_step1Token"] = hash('sha256', bin2hex(openssl_random_pseudo_bytes(64, $rstrong)));
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
    <h1>Step 1</h1>
    <form action="#" id="step1Form" method="post" enctype="multipart/form-data">
        <div>
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" placeholder="Type your first name" required>
        </div>
        <div>
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" placeholder="Type your first name" required>
        </div>
        <div>
            <label for="country">Country</label>
            <select name="country" id="country" required>
                <option value="select" hidden>Select</option>
            </select>
        </div>
        <button type="submit" style="padding: 5px 10px">Continue</button>
        <input type="hidden" name="_v1Token" value="<?= $_SESSION["_step1Token"]; ?>">
    </form>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/myjs.js"></script>
    <script>
        $(document).ready(function() {
            getData(document.getElementById("country"), 'c');

            $("#step1Form").on("submit", function(e) {
                e.preventDefault();
                //window.location.href = "purchase_step2.php";
                $.ajax({
                    type: "POST",
                    url: "../api/verifyStep1",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        console.log(result);
                        if (result) {
                            window.location.href = 'purchase_step2.php';
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