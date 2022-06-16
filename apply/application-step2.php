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
                                <input type="text" name="home-town" id="home-town" placeholder="Index Number">
                            </div>
                            <div>
                                <select name="nationality" id="nationality">
                                    <option value="" hidden>Examination Type</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                </select>
                            </div>
                            <div>
                                <select name="marital-status" id="marital-status">
                                    <option value="" hidden>Select Year</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separarted">Separarted</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>

            </fieldset>

            <div class="page-control">
                <button type="submit" id="prevStep" onclick="whatNext(0)" class="control-button btn">Previous Step</button>
                <button type="submit" id="saveAndExit" onclick="whatNext(1)" class="control-button btn">Save and Exit</button>
                <button type="submit" id="saveAndCont" onclick="whatNext(3)" class="control-button btn">Save and Continue</button>
            </div>

        </form>
    </main>
    <?php include("../inc/scripts.php") ?>
    <script>
        $(document).ready(function() {

            $("#appForm").on("submit", function(e) {
                e.preventDefault();
                var data = new FormData(this);
                save(data);
            });

        });
    </script>
</body>

</html>