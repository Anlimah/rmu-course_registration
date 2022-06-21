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
                <legend style="padding: 5px; color:#fff; background-color: #000">Programme/Hall Choice</legend>
                <fieldset>
                    <legend>Programme</legend>
                    <div>
                        <label for="gd-phone-number">First (1<sup>st</sup>) Choice</label>
                        <select name="country" id="country">
                            <option value="" hidden>Select a programme</option>
                            <option value="Single" selected>+233</option>
                            <option value="Married">+234</option>
                            <option value="Divorced">+235</option>
                            <option value="Widowed">+236</option>
                            <option value="Separarted">+237</option>
                        </select>
                        <br>
                        <label for="gd-phone-number">Second (2<sup>nd</sup>) Choice</label>
                        <select name="country" id="country">
                            <option value="" hidden>Select a programme</option>
                            <option value="Single" selected>+233</option>
                            <option value="Married">+234</option>
                            <option value="Divorced">+235</option>
                            <option value="Widowed">+236</option>
                            <option value="Separarted">+237</option>
                        </select>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Halls</legend>
                    <div>
                        <label for="gd-phone-number">First (1<sup>st</sup>) Choice</label>
                        <select name="country" id="country">
                            <option value="" hidden>Select a programme</option>
                            <option value="Single" selected>+233</option>
                            <option value="Married">+234</option>
                            <option value="Divorced">+235</option>
                            <option value="Widowed">+236</option>
                            <option value="Separarted">+237</option>
                        </select>
                        <br>
                        <label for="gd-phone-number">Second (2<sup>nd</sup>) Choice</label>
                        <select name="country" id="country">
                            <option value="" hidden>Select a programme</option>
                            <option value="Single" selected>+233</option>
                            <option value="Married">+234</option>
                            <option value="Divorced">+235</option>
                            <option value="Widowed">+236</option>
                            <option value="Separarted">+237</option>
                        </select>
                        <br>
                        <label for="gd-phone-number">Third (3<sup>rd</sup>) Choice</label>
                        <select name="country" id="country">
                            <option value="" hidden>Select a programme</option>
                            <option value="Single" selected>+233</option>
                            <option value="Married">+234</option>
                            <option value="Divorced">+235</option>
                            <option value="Widowed">+236</option>
                            <option value="Separarted">+237</option>
                        </select>
                    </div>
                </fieldset>

                <div style="margin-bottom: 20px">
                    <label for="">* Do you have any previous University records?</label>
                    <input type="radio" name="prev-uni-rec" id="prev-uni-rec-yes" style="margin-left: 20px;"> YES
                    <input type="radio" name="prev-uni-rec" id="prev-uni-rec-no" style="margin-left: 20px;"> NO
                </div>

                <fieldset style="margin-bottom: 0px">
                    <legend>Previous University Enrollment Information</legend>
                    <div>
                        <label for="gd-postal-address">Name of University</label>
                        <input type="text" name="gd-postal-address" id="gd-postal-address">
                    </div>
                    <div>
                        <label for="gd-postal-town">Program Pursued</label>
                        <input type="text" name="gd-postal-town" id="gd-postal-town">
                    </div>
                    <div>
                        <label for="gd-postal-town">Date enrolled</label>
                        <select name="country" id="country">
                            <option value="" hidden>Month</option>
                            <option value="Single" selected>+233</option>
                            <option value="Married">+234</option>
                            <option value="Divorced">+235</option>
                            <option value="Widowed">+236</option>
                            <option value="Separarted">+237</option>
                        </select>
                        <select name="country" id="country">
                            <option value="" hidden>Year</option>
                            <option value="Single" selected>+233</option>
                            <option value="Married">+234</option>
                            <option value="Divorced">+235</option>
                            <option value="Widowed">+236</option>
                            <option value="Separarted">+237</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 20px">
                        <label for="">* Did you complete?</label>
                        <input type="radio" name="prev-uni-rec" id="prev-uni-rec-yes" style="margin-left: 20px;"> YES
                        <input type="radio" name="prev-uni-rec" id="prev-uni-rec-no" style="margin-left: 20px;"> NO
                    </div>

                    <div>
                        <label for="gd-postal-town">Date of Completion</label>
                        <select name="country" id="country">
                            <option value="" hidden>Month</option>
                            <option value="Single" selected>+233</option>
                            <option value="Married">+234</option>
                            <option value="Divorced">+235</option>
                            <option value="Widowed">+236</option>
                            <option value="Separarted">+237</option>
                        </select>
                        <select name="country" id="country">
                            <option value="" hidden>Year</option>
                            <option value="Single" selected>+233</option>
                            <option value="Married">+234</option>
                            <option value="Divorced">+235</option>
                            <option value="Widowed">+236</option>
                            <option value="Separarted">+237</option>
                        </select>
                    </div>

                    <div>
                        <label for="gd-postal-town">If you did not complete, select reason(s)</label>
                        <select name="country" id="country">
                            <option value="" hidden>Reasons</option>
                            <option value="Single">Deffered</option>
                            <option value="Married">Withdrawn</option>
                        </select>
                    </div>

                    <div>
                        <label for="">Reasons...</label>
                        <textarea name="" id="" cols="30" rows="5"></textarea>
                    </div>
                </fieldset>
            </fieldset>

            <div class="page-control">
                <button type="submit" id="prevStep" onclick="whatNext(0)" class="control-button btn">Previous Step</button>
                <button type="submit" id="saveAndExit" onclick="whatNext(1)" class="control-button btn">Save and Exit</button>
                <button type="submit" id="saveAndCont" onclick="whatNext(4)" class="control-button btn">Submit and Print</button>
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