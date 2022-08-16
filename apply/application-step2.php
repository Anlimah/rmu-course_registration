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
                            <h1 style="font-size: 40px; padding-bottom: 15px !important">Education Background</h1>
                        </div>

                        <hr>

                        <form id="appForm" method="POST" style="margin-top: 50px !important;">
                            <!--Exam sitting for people applying with masters, degree, diploma, and other certificate-->
                            <fieldset class="fieldset" id="graduate">
                                <legend>Examination Sittings > 1</legend>
                                <div class="field-content">
                                    <div class="form-fields" style="flex-grow: 8;">
                                        <div class="mb-4">
                                            <label class="form-label" for="app-exam-index">School Name <span class="input-required">*</span></label>
                                            <input class="form-control" type="text" name="app-exam-index" id="app-exam-index" placeholder="School Name">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="app-exam-index"> Certificate/Degree <span class="input-required">*</span></label>
                                            <select class="form-select form-select-sm mb-3" name="app-exam-type" id="app-exam-type">
                                                <option value="" hidden>Examination Type</option>
                                                <option value="2022">2022</option>
                                                <option value="2021">2021</option>
                                                <option value="2020">2020</option>
                                                <option value="2019">2019</option>
                                                <option value="2018">2018</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="app-exam-index">Index Number <span class="input-required">*</span></label>
                                            <input class="form-control" type="text" name="app-exam-index" id="app-exam-index" placeholder="Index Number">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="app-exam-date">Date <span class="input-required">*</span></label>
                                            <select class="form-select form-select-sm mb-3" name="app-exam-month" id="app-exam-month" class="monthList">
                                                <option value="" hidden>Month</option>
                                            </select>
                                            <select class="form-select form-select-sm mb-3" name="app-exam-year" id="app-exam-year" class="yearList">
                                                <option value="" hidden>Year</option>
                                            </select>
                                        </div>
                                        <div class="photo-upload-area">
                                            <p style="font-size: 14px; color: brown">Upload a scanned PDF copy of your certificate and transcipts.</p>
                                            <label for="applicant-photo" class="upload-photo-label btn btn-default">Upload certificate <span class="input-required">*</span></label>
                                            <input class="form-control" type="file" name="applicant-photo" id="applicant-photo" style="display: none;">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Exam sitting for people applying with wassce/ssce    -->
                            <fieldset class="fieldset" id="undergraduate">
                                <legend>Examination Sittings</legend>
                                <div class="field-content">
                                    <div class="form-fields" style="flex-grow: 8;">
                                        <div class="mb-4">
                                            <label class="form-label" for="app-exam-index">School Name <span class="input-required">*</span></label>
                                            <input class="form-control" type="text" name="app-exam-index" id="app-exam-index" placeholder="School Name">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="app-exam-index"> Certificate/Degree <span class="input-required">*</span></label>
                                            <select class="form-select form-select-sm mb-3" name="app-exam-type" id="app-exam-type">
                                                <option value="" hidden>Examination Type</option>
                                                <option value="2022">2022</option>
                                                <option value="2021">2021</option>
                                                <option value="2020">2020</option>
                                                <option value="2019">2019</option>
                                                <option value="2018">2018</option>
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="app-exam-index"><span>*</span> Index Number</label>
                                            <input class="form-control" type="text" name="app-exam-index" id="app-exam-index" placeholder="Index Number">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="app-exam-date"><span>*</span> Date</label>
                                            <select class="form-select form-select-sm mb-3" name="app-exam-month" id="app-exam-month" class="form-select form-select-lg mb-3">
                                                <option value="" hidden>Month</option>
                                            </select>
                                            <select class="form-select form-select-sm mb-3" name="app-exam-year" id="app-exam-year" class="yearList">
                                                <option value="" hidden>Year</option>
                                            </select>
                                        </div>

                                        <div class="mb-4">
                                            <button style="padding: 2px 50px;" type="button" id="verify-wassce-result">Verify Result</button>
                                        </div>

                                        <div id="display-wassce-result" style="display: flex; flex-direction: row;">
                                            <div id="core-subjects">
                                                <label class="form-label" for="">Core Subjects</label>
                                                <ul>
                                                    <li>English Language: <span>A</span></li>
                                                    <li>Integrated Science: <span>A</span></li>
                                                    <li>Core Mathematics: <span>A</span></li>
                                                    <li>Social Studies: <span>A</span></li>
                                                </ul>
                                            </div>
                                            <div id="elective-subjects" style="margin-left: 50px;">
                                                <label class="form-label" for="">ELective Subjects</label>
                                                <ul>
                                                    <li>English Language: <span>A</span></li>
                                                    <li>Integrated Science: <span>A</span></li>
                                                    <li>Core Mathematics: <span>A</span></li>
                                                    <li>Social Studies: <span>A</span></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="photo-upload-area">
                                            <p style="font-size: 14px; color: brown">Upload a scanned PDF copy of your certificate and transcipts.</p>
                                            <label for="certificate-file" class="upload-photo-label btn btn-default">Upload certificate</label>
                                            <input class="form-control" type="file" name="applicant-photo" id="certificate-file" style="display: none;">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>

                        <div class="mb-4">
                            <button class="btn btn-primary" style="padding: 10px; float:right;">Add Education</button>
                        </div>

                        <center style="margin-top: 120px;">
                            <div class="page-control">
                                <button type="button" onclick="whatNext(0, 2)" class="m-3 control-button btn">Previous Step</button>
                                <!--<button type="submit" id="saveAndExit" onclick="whatNext(1)" class="m-5 control-button btn">Save and Exit</button>-->
                                <button type="button" onclick="whatNext(3)" class="m-3  btn btn-primary">Next -> Programme Information</button>
                            </div>
                        </center>
                    </main>
                </div>

                <!-- Application progress tracker -->
                <div class="col-3" style="margin-bottom: 400px;">

                    <section class="container-sm" style=" display: flex; flex-direction: column;position: sticky; top: 10.7rem;">
                        <fieldset class="fieldset" style="float:left; margin-top: 0px; max-width: 270px;min-width: 270px; width: 100%;">
                            <legend style="width:100%; text-align: center; font-size: 20px; font-weight:700; margin-bottom:0px">Application Sections</legend>
                            <span class="mb-5">In progress</span>
                            <ul class="list-group mt-5" style="padding: 0 !important; margin: 0 important; font-size:medium; font-weight:500">
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="javscript:void()">Use of Information</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="javscript:void()">Personal Information</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="javscript:void()" class=" active">Acedemic Background</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="javscript:void()">Programme Information</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="javscript:void()">Uploads</a>
                                </li>
                                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                                    <a href="javscript:void()">Declaration</a>
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

                    </section>

                </div>

            </div>

        </div>
        <?php require_once('../inc/page-footer.php') ?>
    </div>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/myjs.js"></script>
    <script>
        $(document).ready(function() {

            $.ajax({
                type: "GET",
                url: "../api/application-type",
                data: {
                    value: this.value,
                },
                success: function(result) {
                    console.log(result);
                },
                error: function(error) {
                    console.log(error);
                }
            })

            $(".form-select").change("blur", function() {
                $.ajax({
                    type: "PUT",
                    url: "../api/education",
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
                    type: "POST",
                    url: "../api/education",
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