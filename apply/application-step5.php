<?php
session_start();
if (isset($_SESSION['ghAppLogin']) && $_SESSION['ghAppLogin'] == true) {
    if (!(isset($_SESSION["ghApplicant"]) && !empty($_SESSION['ghApplicant']))) {
        header('Location: index.php?status=error&message=Invalid access!');
    }
} else {
    header('Location: index.php?status=error&message=Invalid access!');
}

if (isset($_GET['logout'])) {
    unset($_SESSION['ghAppLogin']);
    unset($_SESSION['ghApplicant']);
    session_destroy();
    header('Location: index.php');
}

$user_id = $_SESSION['ghApplicant'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <!--<link rel="stylesheet" href="../assets/css/bootstrap.css">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
    </style>
</head>

<body>
    <header class="top-nav-bar card">
        <div class="logo-board"></div>
        <div class="info-card">
            <div>Application Sections</div>
            <div>
                <a href="?logout=true" style="color: #fff !important">Logout</a>
            </div>
        </div>
    </header>

    <nav>

    </nav>

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <main>
                        <div class="page_info" style="margin-bottom: 30px !important;">
                            <h1 style="font-size: 40px; padding-bottom: 15px !important">Declaration</h1>
                        </div>

                        <hr>

                        <?php
                        require_once('../bootstrap.php');

                        use Src\Controller\UsersController;

                        $user = new UsersController();
                        $personal = $user->fetchApplicantPersI($user_id);

                        ?>
                        <form id="appForm" method="POST" style="margin-top: 50px !important;">
                        </form>

                        <center>
                            <div class="page-control">
                                <!--<button type="submit" id="prevStep" onclick="whatNext(0)" class="m-5 control-button btn">Previous Step</button>-->
                                <button type="button" id="saveAndExit" onclick="whatNext(1)" class="m-3 btn btn-default">Save and Exit</button>
                                <button type="button" id="saveAndCont" onclick="whatNext(2)" class="m-3 btn btn-primary">Next -> Academic Background</button>
                            </div>
                        </center>
                    </main>
                </div>

                <!-- Application progress tracker -->
                <section class="col-3" style="margin-bottom: 400px;">

                    <div class="container-sm" style=" display: flex; flex-direction: column;position: sticky; top: 10.7rem;">
                        <fieldset class="fieldset" style="float:left; margin-top: 0px; max-width: 270px;min-width: 270px; width: 100%;">
                            <legend style="width:100%; text-align: center; font-size: 20px; font-weight:700; margin-bottom:0px">Application Sections</legend>
                            <span class="mb-5">In progress</span>
                            <ul class="list-group mt-5" style="padding: 0 !important; margin: 0 important; font-size:medium; font-weight:500">
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="javscript:void()">Use of Information</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="application-step1.php">Personal Information</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="application-step2.php">Acedemic Background</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="application-step3.php">Programme Information</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="application-step4.php">Uploads</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="application-step5.php" class=" active">Declaration</a>
                                </li>
                            </ul>
                        </fieldset>

                        <fieldset class="fieldset" style="display: flex; flex-direction: column; align-items:center; max-width: 270px; min-width: 270px;">
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

                    </div>

                </section>

            </div>
        </div>

        <?php require_once('../inc/page-footer.php') ?>
    </div>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/myjs.js"></script>
    <script>
        $(document).ready(function() {
            getData(document.getElementById("nationality"), 'c');
            getData(document.getElementById("country-res"), 'c');
            //getData(document.getElementById("postal-country"), 'c');
            getData(document.getElementById("country-birth"), 'c');
            getData(document.getElementById("address-country"), 'c');
            //getData(document.getElementById("region"), 'r');

            $(".form-select").change("blur", function() {
                $.ajax({
                    type: "PUT",
                    url: "../api/personal",
                    data: {
                        what: this.name,
                        value: this.value,
                    },
                    success: function(result) {
                        console.log(result);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            $(".form-control").on("blur", function() {
                $.ajax({
                    type: "PUT",
                    url: "../api/personal",
                    data: {
                        what: this.name,
                        value: this.value,
                    },
                    success: function(result) {
                        console.log(result);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            });
        });
    </script>
</body>

</html>