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
    <link rel="stylesheet" href="../assets/css/application-form.css">
</head>

<body>
    <div class="top-bar card">
        <div class="info-card"></div>
        <div class="logo-board"></div>
    </div>
    <main>
        <form id="appForm" method="POST">
            <fieldset>
                <legend>Examination Sittings</legend>
                <fieldset>
                    <legend>Examination Results</legend>
                    <div class="field-content">
                        <div class="form-fields" style="flex-grow: 8;">
                            <div>
                                <label for="app-exam-index"><span>*</span> Index Number</label>
                                <input type="text" name="app-exam-index" id="app-exam-index" placeholder="Index Number">
                            </div>
                            <div>
                                <label for="app-exam-type"><span>*</span> Examination Type</label>
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
                                <label for="app-exam-date"><span>*</span> Date</label>
                                <select name="app-exam-month" id="app-exam-month" class="monthList">
                                    <option value="" hidden>Month</option>
                                </select>
                                <select name="app-exam-year" id="app-exam-year" class="yearList">
                                    <option value="" hidden>Year</option>
                                </select>
                            </div>
                            <div>

                            </div>
                        </div>
                    </div>
                </fieldset>

            </fieldset>

            <div class="page-control">
                <button type="submit" id="prevStep" onclick="whatNext(0, 2)" class="control-button btn">Previous Step</button>
                <button type="submit" id="saveAndExit" onclick="whatNext(1)" class="control-button btn">Save and Exit</button>
                <button type="submit" id="saveAndCont" onclick="whatNext(3)" class="control-button btn">Save and Continue</button>
            </div>

        </form>
    </main>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/myjs.js"></script>
    <script>
        $(document).ready(function() {
            getYears(document.getElementById("app-exam-month"), 'm');
            getYears(document.getElementById("app-exam-year"), 'y');


            $("#appForm").on("submit", function(e) {
                e.preventDefault();
                var data = new FormData(this);
                save(data, 2);
            });

        });
    </script>
</body>

</html>