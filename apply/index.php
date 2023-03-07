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
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
        .main-content {
            top: 50px !important;
        }

        .app-step {
            padding: 10px;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
        }

        div .col-1 {
            font-size: 20px;
            background-color: #003262;
            height: 100%;
            padding: 5px 10px;
            color: #fff;
            
        }
    </style>
</head>

<body>

    <header class="container-fluid index-page">
    </header>
    <div class="main-content mt-4 container">
        <div class="container-fluid" style="margin-bottom: 100px;">
            <div class="row">
                <!--Voucher purchase info-->
                <section class="col-md-6 col-sm-12">
                    <h1>Easy steps to apply</h1>
                    <div class="col container">
                        <div class="app-step row">
                            <div class="col-1 text-center">1</div>
                            <p class="col-11">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores voluptas, molestiae quae tenetur modi animi iure tempora amet laborum numquam error quod sequi a nemo cupiditate atque accusantium aut ratione?
                            </p>
                        </div>
                        <div class="app-step row">
                            <div class="col-1 text-center">2</div>
                            <p class="col-11">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores voluptas, molestiae quae tenetur modi animi iure tempora amet laborum numquam error quod sequi a nemo cupiditate atque accusantium aut ratione?
                            </p>
                        </div>
                        <div class="app-step row">
                            <div class="col-1 text-center">3</div>
                            <p class="col-11">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores voluptas, molestiae quae tenetur modi animi iure tempora amet laborum numquam error quod sequi a nemo cupiditate atque accusantium aut ratione?
                            </p>
                        </div>
                        <div class="app-step row">
                            <div class="col-1 text-center">4</div>
                            <p class="col-11">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores voluptas, molestiae quae tenetur modi animi iure tempora amet laborum numquam error quod sequi a nemo cupiditate atque accusantium aut ratione?
                            </p>
                        </div>
                        <div class="app-step row">
                            <div class="col-1 text-center">5</div>
                            <p class="col-11">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores voluptas, molestiae quae tenetur modi animi iure tempora amet laborum numquam error quod sequi a nemo cupiditate atque accusantium aut ratione?
                            </p>
                        </div>
                        <div class="app-step row">
                            <div class="col-1 text-center">6</div>
                            <p class="col-11">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores voluptas, molestiae quae tenetur modi animi iure tempora amet laborum numquam error quod sequi a nemo cupiditate atque accusantium aut ratione?
                            </p>
                        </div>
                    </div>
                </section>

                <div class="col-md-2"></div>

                <!--Login form-->
                <section class="col-md-4 col-sm-12" style="display:flex; flex-direction:column;">
                    <h1>Login</h1>
                    <form id="appLoginForm" style="margin-bottom: 50px">
                        <div class="mb-4" style="width: 280px">
                            <label class="form-label" for="app_number">Application Number</label>
                            <div class="input-group ">
                                <span class="input-group-text" id="basic-addon1" style="font-weight: 600;">RMU - </span>
                                <input class="form-control form-control-lg form-control-login" type="text" id="app_number" name="app_number" aria-describedby="basic-addon1" placeholder="Application Number">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="pin_code">PIN Code</label>
                            <input class="form-control form-control-lg form-control-login" style="width: 280px" type="password" id="pin_code" name="pin_code" placeholder="PIN Code">
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary form-btn-login">Login</button>
                        </div>
                        <input type="hidden" name="_logToken" value="<?= $_SESSION['_start'] ?>">
                    </form>

                    <fieldset class="fieldset" style="display: flex !important; flex-direction: column !important; align-items:center !important; max-width: 280px !important; min-width: 280px !important; font-size: 14px">
                        <legend style="width:100%; text-align: center;">Need Help?</legend>
                        <p style="width: 100%;">
                            <span class="bi bi-telephone-fill"></span>
                            <a href=" tel:+233302712775">+233302712775</a>
                        </p>
                        <p style="width: 100%;">
                            <span class="bi bi-envelope-fill"></span>
                            <a href="mailto:university.registrar@rmu.edu.gh">university.registrar@rmu.edu.gh</a>
                        </p>
                    </fieldset>

                </section>

            </div>

        </div>
        <?php require_once('../inc/page-footer.php') ?>
    </div>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            $("input").on("click", function() {
                $(this).select();
            });

            $("#appLoginForm").on("submit", function(e) {

                /**
                 *  Pregmatch: 
                 *  1. Only numbers allowed
                 *  2. Min and Max of 8
                 */
                if ($("#app_number").val().length > 8 || $("#app_number").val().length < 8) {
                    alert("Invalid application number or PIN");
                    return;
                }


                /**
                 *  Pregmatch: 
                 *  1. Alpha numeric allowed
                 *  2. Min and Max of 9
                 *  3. Case sensitive: only upper cases
                 */
                if ($("#pin_code").val().length < 9 || $("#pin_code").val().length > 9) {
                    alert("Invalid application number or PIN");
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "../api/appLogin",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        console.log(result);
                        //alert(result['message']);
                        if (result.response == 'success') {
                            window.location.href = result.message;
                        } else {
                            alert(result['message']);
                        }
                    },
                    error: function(error) {}
                });

                e.preventDefault();
            });
        });
    </script>
</body>

</html>