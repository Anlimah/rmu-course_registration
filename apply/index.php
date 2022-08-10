<?php
session_start();

if (!isset($_SESSION["_start"])) {
    $rstrong = true;
    $_SESSION["_start"] = hash('sha256', bin2hex(openssl_random_pseudo_bytes(64, $rstrong)));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RMU Online Applicatioin Portal</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
    </style>
</head>

<body>

    <header class="index-page card">
        <div class="logo-board"></div>
        <div class="info-card"></div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <!--Voucher purchase info-->
            <div class="col-7" style="height: 100%;"></div>

            <!--Login form-->
            <div class="col-5" style="display:flex; flex-direction:column; margin-top: 100px;">
                <h1>Login</h1>
                <form id="appLoginForm" style="margin-bottom: 50px">
                    <div class="mb-4">
                        <label class="form-label" for="app_number">Application Number</label>
                        <input class="form-control form-control-lg" type="text" id="app_number" name="app_number" placeholder="Enter your application number here">
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="pin_code">PIN Code</label>
                        <input class="form-control form-control-lg" type="password" id="pin_code" name="pin_code" placeholder="Enter your PIN code here">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <input type="hidden" name="_logToken" value="<?= $_SESSION['_start'] ?>">
                </form>

                <fieldset class="fieldset" style="display: flex; flex-direction: column; align-items:center; max-width: 270px; min-width: 270px; padding: 5px 20px;">
                    <legend style="width:100%; text-align: center;">Need Help?</legend>
                    <p style="width: 100%;">
                        <span class="bi bi-telephone-fill" style="margin-right: 10px;"></span>
                        <a href=" tel:+233302712775">+233302712775</a>
                    </p>
                    <p style="width: 100%;">
                        <span class="bi bi-envelope-fill" style="margin-right: 10px;"></span>
                        <a href="mailto:university.registrar@rmu.edu.gh"> university.registrar@rmu.edu.gh</a>
                    </p>
                </fieldset>
            </div>

        </div>
    </div>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#appLoginForm").on("submit", function(e) {
                e.preventDefault();
                //window.location.href = "purchase_step2.php";
                $.ajax({
                    type: "POST",
                    url: "../api/appLogin",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        console.log(result);
                        if (result) {
                            window.location.href = 'application-step1.php';
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