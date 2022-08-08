<?php
session_start();
if (isset($_SESSION['ghAppLogin']) && $_SESSION['ghAppLogin'] == true) {
    if (!(isset($_SESSION["ghApplicant"]) && !empty($_SESSION['ghAppLogin']))) {
        header('Location: index.php?status=error&message=Invalid access!');
    }
} else {
    header('Location: index.php?status=error&message=Invalid access!');
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
    <link rel="stylesheet" href="../assets/css/application-form.css">
</head>

<body>
    <header class="top-bar card">
        <div class="logo-board"></div>
        <div class="info-card"></div>
    </header>

    <nav>

    </nav>

    <main>
        <div class="page_info" style="margin-bottom: 50px; border-bottom: 1px solid #909090">
            <h1 style="font-size: 40px; padding-bottom: 15px">Education Background</h1>
        </div>

        <form id="appForm" method="POST">
            <!--Exam sitting for people applying with masters, degree, diploma, and other certificate-->
            <fieldset class="fieldset">
                <legend>Examination Sittings > 1</legend>
                <div class="field-content">
                    <div class="form-fields" style="flex-grow: 8;">
                        <div>
                            <label for="app-exam-index">School Name <span>*</span></label>
                            <input type="text" name="app-exam-index" id="app-exam-index" placeholder="School Name">
                        </div>
                        <div>
                            <label for="app-exam-index"> Certificate/Degree <span>*</span></label>
                            <select name="app-exam-type" id="app-exam-type">
                                <option value="" hidden>Examination Type</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                            </select>
                        </div>
                        <div>
                            <label for="app-exam-index"><span>*</span> Index Number</label>
                            <input type="text" name="app-exam-index" id="app-exam-index" placeholder="Index Number">
                        </div>
                        <div>
                            <label for="app-exam-date"><span>*</span> Date</label>
                            <select name="app-exam-month" id="app-exam-month" class="monthList">
                                <option value="" hidden>Month</option>
                            </select>
                            <select name="app-exam-year" id="app-exam-year" class="yearList">
                                <option value="" hidden>Year</option>
                            </select>
                        </div>
                        <div class="photo-upload-area">
                            <p style="font-size: 14px; color: brown">Upload a scanned PDF copy of your certificate and transcipts.</p>
                            <label for="applicant-photo" class="upload-photo-label btn btn-default">Upload certificate</label>
                            <input type="file" name="applicant-photo" id="applicant-photo">
                        </div>
                    </div>
                </div>
            </fieldset>

            <!-- Exam sitting for people applying with wassce/ssce    -->
            <fieldset class="fieldset">
                <legend>Examination Sittings</legend>
                <div class="field-content">
                    <div class="form-fields" style="flex-grow: 8;">
                        <div>
                            <label for="app-exam-index">School Name <span>*</span></label>
                            <input type="text" name="app-exam-index" id="app-exam-index" placeholder="School Name">
                        </div>
                        <div>
                            <label for="app-exam-index"> Certificate/Degree <span>*</span></label>
                            <select name="app-exam-type" id="app-exam-type">
                                <option value="" hidden>Examination Type</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                            </select>
                        </div>
                        <div>
                            <label for="app-exam-index"><span>*</span> Index Number</label>
                            <input type="text" name="app-exam-index" id="app-exam-index" placeholder="Index Number">
                        </div>
                        <div>
                            <label for="app-exam-date"><span>*</span> Date</label>
                            <select name="app-exam-month" id="app-exam-month" class="monthList">
                                <option value="" hidden>Month</option>
                            </select>
                            <select name="app-exam-year" id="app-exam-year" class="yearList">
                                <option value="" hidden>Year</option>
                            </select>
                        </div>

                        <div>
                            <button style="padding: 2px 50px;" type="button" id="verify-wassce-result">Verify Result</button>
                        </div>

                        <div id="display-wassce-result" style="display: flex; flex-direction: row;">
                            <div id="core-subjects">
                                <label for="">Core Subjects</label>
                                <ul>
                                    <li>English Language: <span>A</span></li>
                                    <li>Integrated Science: <span>A</span></li>
                                    <li>Core Mathematics: <span>A</span></li>
                                    <li>Social Studies: <span>A</span></li>
                                </ul>
                            </div>
                            <div id="elective-subjects" style="margin-left: 50px;">
                                <label for="">ELective Subjects</label>
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
                            <label for="applicant-photo" class="upload-photo-label btn btn-default">Upload certificate</label>
                            <input type="file" name="applicant-photo" id="applicant-photo">
                        </div>
                    </div>
                </div>
            </fieldset>



        </form>

        <div>
            <button style="padding: 10px; float:right;">Add Education</button>
        </div>

        <center style="margin-top: 120px;">
            <div class="page-control">
                <button type="submit" id="prevStep" onclick="whatNext(0, 2)" class="control-button btn">Previous Step</button>
                <button type="submit" id="saveAndExit" onclick="whatNext(1)" class="control-button btn">Save and Exit</button>
                <button type="submit" id="saveAndCont" onclick="whatNext(3)" class="control-button btn">Save and Continue</button>
            </div>
        </center>
    </main>

    <footer>

    </footer>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/myjs.js"></script>
    <script>
        $(document).ready(function() {
            $("#appForm").on("submit", function(e) {
                e.preventDefault();
                var data = new FormData(this);
                save(data, 2);
            });

        });
    </script>
</body>

</html>