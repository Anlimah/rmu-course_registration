<?php
session_start();
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
    <img src="../images/RMU-LOG.png" alt="RMU LOG">
    <h1>Step 7</h1>
    <p>
        When transaction if confirm and transfer is successful, your application number and PIN code will be sent to your email address.
        <a href="../apply/">Click here</a> to continue.
    </p>


    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#step1Form").on("submit", function(e) {
                e.preventDefault();
                //window.location.href = "purchase_step2.php";
                /*$.ajax({
                    type: "POST",
                    url: "api/verifyApplicant",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        result = JSON.parse(result);
                        if (result["response"] == "success") {
                            console.log(result['msg']);
                            window.location.href = 'verify-code.php'
                        } else {
                            console.log(result['msg']);
                        }
                    },
                    error: function(error) {}
                });*/
            });
        });
    </script>
</body>

</html>