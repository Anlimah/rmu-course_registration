<?php

use Src\Controller\ExposeDataController;

session_start();
if (isset($_SESSION['ghAppLogin']) && $_SESSION['ghAppLogin'] == true) {
    if (!(isset($_SESSION["ghApplicant"]) && !empty($_SESSION['ghAppLogin']))) {
        header('Location: index.php?status=error&message=Invalid access!');
    }
} else {
    header('Location: index.php?status=error&message=Invalid access!');
}

require_once("../src/Controller/ExposeDataController.php");
$data = new ExposeDataController();

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
                        <label for="gd-phone-number"><span>*</span> First (1<sup>st</sup>) Choice</label>
                        <select name="country" id="country">
                            <option value="" hidden>Choose </option>
                            <?php
                            $programs = $data->getPrograms();
                            foreach ($programs as $program) {
                                echo '<option value="' . $program['id'] . '">' . $program['name'] . '</option>';
                            }
                            ?>
                        </select>
                        <br>
                        <label for="gd-phone-number"><span>*</span> Second (2<sup>nd</sup>) Choice</label>
                        <select name="country" id="country">
                            <option value="" hidden>Choose </option>
                            <?php
                            $programs = $data->getPrograms();
                            foreach ($programs as $program) {
                                echo '<option value="' . $program['id'] . '">' . $program['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Halls</legend>
                    <div>
                        <label for="gd-phone-number"><span>*</span> First (1<sup>st</sup>) Choice</label>
                        <select name="country" id="country">
                            <option value="" hidden>Choose</option>
                            <?php
                            $halls = $data->getHalls();
                            foreach ($halls as $hall) echo '<option value="' . $hall['id'] . '">' . $hall['name'] . '</option>';
                            ?>
                        </select>
                        <br>
                        <label for="gd-phone-number"><span>*</span> Second (2<sup>nd</sup>) Choice</label>
                        <select name="residence-choice-2" id="residence-choice-2">
                            <option value="" hidden>Choose</option>
                            <?php
                            $halls = $data->getHalls();
                            foreach ($halls as $hall) echo '<option value="' . $hall['id'] . '">' . $hall['name'] . '</option>';
                            ?>
                        </select>
                        <br>
                        <label for="gd-phone-number"><span>*</span> Third (3<sup>rd</sup>) Choice</label>
                        <select name="residence-choice-3" id="residence-choice-3">
                            <option value="" hidden>Choose</option>
                            <?php
                            $halls = $data->getHalls();
                            foreach ($halls as $hall) echo '<option value="' . $hall['id'] . '">' . $hall['name'] . '</option>';
                            ?>
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
                        <select name="month" id="month">
                            <option value="" hidden>Month</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                        <select name="year" id="year">
                            <option value="" hidden>Year</option>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                            <option value="2018">2018</option>
                            <option value="2017">2017</option>
                            <option value="2016">2016</option>
                            <option value="2015">2015</option>
                            <option value="2014">2014</option>
                            <option value="2013">2013</option>
                            <option value="2012">2012</option>
                            <option value="2011">2011</option>
                            <option value="2010">2010</option>
                            <option value="2009">2009</option>
                            <option value="2008">2008</option>
                            <option value="2007">2007</option>
                            <option value="2006">2006</option>
                            <option value="2005">2005</option>
                            <option value="2004">2004</option>
                            <option value="2003">2003</option>
                            <option value="2002">2002</option>
                            <option value="2001">2001</option>
                            <option value="2000">2000</option>
                            <option value="1999">1999</option>
                            <option value="1998">1998</option>
                            <option value="1997">1997</option>
                            <option value="1996">1996</option>
                            <option value="1995">1995</option>
                            <option value="1994">1994</option>
                            <option value="1993">1993</option>
                            <option value="1992">1992</option>
                            <option value="1991">1991</option>
                            <option value="1990">1990</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 20px">
                        <label for="">* Did you complete?</label>
                        <input type="radio" name="prev-uni-rec" id="prev-uni-rec-yes" style="margin-left: 20px;"> YES
                        <input type="radio" name="prev-uni-rec" id="prev-uni-rec-no" style="margin-left: 20px;"> NO
                    </div>

                    <div>
                        <label for="gd-postal-town">Date of Completion</label>
                        <select name="month" id="month">
                            <option value="" hidden>Month</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                        <select name="year" id="year">
                            <option value="" hidden>Year</option>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                            <option value="2018">2018</option>
                            <option value="2017">2017</option>
                            <option value="2016">2016</option>
                            <option value="2015">2015</option>
                            <option value="2014">2014</option>
                            <option value="2013">2013</option>
                            <option value="2012">2012</option>
                            <option value="2011">2011</option>
                            <option value="2010">2010</option>
                            <option value="2009">2009</option>
                            <option value="2008">2008</option>
                            <option value="2007">2007</option>
                            <option value="2006">2006</option>
                            <option value="2005">2005</option>
                            <option value="2004">2004</option>
                            <option value="2003">2003</option>
                            <option value="2002">2002</option>
                            <option value="2001">2001</option>
                            <option value="2000">2000</option>
                            <option value="1999">1999</option>
                            <option value="1998">1998</option>
                            <option value="1997">1997</option>
                            <option value="1996">1996</option>
                            <option value="1995">1995</option>
                            <option value="1994">1994</option>
                            <option value="1993">1993</option>
                            <option value="1992">1992</option>
                            <option value="1991">1991</option>
                            <option value="1990">1990</option>
                        </select>
                    </div>

                    <div>
                        <label for="gd-postal-town">If you did not complete, select reason(s)</label>
                        <select name="country" id="country">
                            <option value="" hidden>Reasons</option>
                            <option value="Deffered">Deffered</option>
                            <option value="Withdrawn">Withdrawn</option>
                        </select>
                    </div>

                    <div>
                        <label for="">Reasons...</label>
                        <textarea name="" id="" cols="30" rows="5"></textarea>
                    </div>
                </fieldset>
            </fieldset>

            <div class="page-control">
                <button type="submit" id="prevStep" onclick="whatNext(0, 3)" class="control-button btn">Previous Step</button>
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
                save(data, 3);
            });
        });
    </script>
</body>

</html>