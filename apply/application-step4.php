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
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
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
                            <h1 style="font-size: 40px; padding-bottom: 15px !important">Programmes Information</h1>
                        </div>

                        <hr>

                        <form id="appForm" method="POST" style="margin-top: 50px !important;">
                            <fieldset class="fieldset">
                                <legend>Passport Picture</legend>
                                <div class="field-content">
                                    <div class="form-fields" style="flex-grow: 8;">
                                        <div class="photo-upload-area">
                                            <p style="font-size: 14px; color: brown">Please upload a passport size photo of yourself. The size of the image should not be more than 100KB. The background color of your image should be white.</p>
                                            <p style="font-size: 14px; color: red"><b>NB: The image you use will not be changed. So use a most recent passport sized picture of yourself.</b></p>
                                            <div class="photo-display"></div>
                                            <label for="applicant-photo" class="upload-photo-label btn btn-primary">Upload photo</label>
                                            <input class="form-control" type="file" style="display: none;" name="applicant-photo" id="applicant-photo">
                                        </div>
                                    </div>
                                </div>

                                <div class="photo-upload-area">
                                    <p style="font-size: 14px; color: brown">Upload a scanned PDF copy of your certificate and transcipts.</p>
                                    <label for="applicant-photo" class="upload-photo-label btn btn-default">Upload certificate <span class="input-required">*</span></label>
                                    <input class="form-control" type="file" name="applicant-photo" id="applicant-photo" style="display: none;">
                                </div>
                            </fieldset>
                        </form>

                        <center>
                            <div class="page-control">
                                <button type="submit" id="prevStep" onclick="whatNext(0, 3)" class="m-5 control-button btn">Previous Step</button>
                                <button type="submit" id="saveAndExit" onclick="whatNext(1)" class="m-5 control-button btn">Save and Exit</button>
                                <button type="submit" id="saveAndCont" onclick="whatNext(4)" class="m-5 control-button btn">Submit and Print</button>
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
                                    <a href="application-step4.php" class=" active">Uploads</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="application-step5.php">Declaration</a>
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
            getData(document.getElementById("prev-uni-completed-date-month"), 'm');
            getData(document.getElementById("prev-uni-completed-date-year"), 'y');

            $("#appForm").on("submit", function(e) {
                e.preventDefault();
                var data = new FormData(this);
                save(data, 3);
            });

            $(".prev-uni-rec").on("click", function() {
                alert("OK")
            })
        });
    </script>
</body>

</html>