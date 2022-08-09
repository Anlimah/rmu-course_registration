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
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/application-form.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>

<body>
    <header class="top-nav-bar card">
        <div class="logo-board"></div>
        <div class="info-card"></div>
    </header>

    <nav>

    </nav>

    <div class="main-content">
        <main>
            <div class="page_info" style="margin-bottom: 50px; border-bottom: 1px solid #909090">
                <h1 style="font-size: 40px; padding-bottom: 15px">Programmes Information</h1>
            </div>
            <form id="appForm" method="POST">
                <fieldset class="fieldset">
                    <legend>Programmes</legend>
                    <div class="mb-4">
                        <label class="form-label" for="app-prog-first">First (1<sup>st</sup>) Choice <span class="input-required">*</span></label>
                        <select class="form-select form-select-sm mb-3" name="app-prog-first" id="app-prog-first">
                            <option hidden>Choose </option>
                            <?php
                            $programs = $data->getPrograms();
                            foreach ($programs as $program) {
                                echo '<option value="' . $program['id'] . '">' . $program['name'] . '</option>';
                            }
                            ?>
                        </select>
                        <br>
                        <label class="form-label" for="app-prog-second"> Second (2<sup>nd</sup>) Choice <span class="input-required">*</span></label>
                        <select class="form-select form-select-sm mb-3" name="app-prog-second" id="app-prog-second">
                            <option hidden>Choose </option>
                            <?php
                            $programs = $data->getPrograms();
                            foreach ($programs as $program) {
                                echo '<option value="' . $program['id'] . '">' . $program['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </fieldset>

                <!--<fieldset class="fieldset">
                <legend>Halls</legend>
                <div class="mb-4">
                    <label class="form-label" for="app-hall-first">First (1<sup>st</sup>) Choice <span class="input-required">*</span> </label>
                    <select class="form-select form-select-sm mb-3" name="app-hall-first" id="app-hall-first">
                        <option hidden>Choose</option>
                        <?php
                        $halls = $data->getHalls();
                        foreach ($halls as $hall) echo '<option value="' . $hall['id'] . '">' . $hall['name'] . '</option>';
                        ?>
                    </select>
                    <br>
                    <label class="form-label" for="app-hall-second">Second (2<sup>nd</sup>) Choice <span class="input-required">*</span> </label>
                    <select class="form-select form-select-sm mb-3" name="app-hall-second" id="app-hall-second">
                        <option hidden>Choose</option>
                        <?php
                        $halls = $data->getHalls();
                        foreach ($halls as $hall) echo '<option value="' . $hall['id'] . '">' . $hall['name'] . '</option>';
                        ?>
                    </select>
                    <br>
                    <label class="form-label" for="app-hall-third">Third (3<sup>rd</sup>) Choice <span class="input-required">*</span></label>
                    <select class="form-select form-select-sm mb-3" name="app-hall-third" id="app-hall-third">
                        <option hidden>Choose</option>
                        <?php
                        $halls = $data->getHalls();
                        foreach ($halls as $hall) echo '<option value="' . $hall['id'] . '">' . $hall['name'] . '</option>';
                        ?>
                    </select>
                </div>
            </fieldset>-->

                <div style="margin-bottom: 20px">
                    <label class="form-label" for="">Do you have any previous University records? <span class="input-required">*</span></label>
                    <label class="form-label" for="prev-uni-rec-yes">
                        <input type="radio" name="prev-uni-rec" id="prev-uni-rec-yes" class="prev-uni-rec" style="margin-left: 20px;"> YES
                    </label>
                    <label class="form-label" for="prev-uni-rec-no">
                        <input type="radio" name="prev-uni-rec" id="prev-uni-rec-no" class="prev-uni-rec" style="margin-left: 20px;"> NO
                    </label>

                </div>

                <fieldset class="fieldset">
                    <legend>Previous University Enrollment Information</legend>
                    <div class="mb-4">
                        <label class="form-label" for="app-prev-uni-name">Name of University</label>
                        <input class="form-control" type="text" name="app-prev-uni-name" id="app-prev-uni-name">
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="app-prev-uni-prog">Program Pursued</label>
                        <input class="form-control" type="text" name="app-prev-uni-prog" id="app-prev-uni-prog">
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="app-prev-uni-enrolled">Date enrolled</label>
                        <select class="form-select form-select-sm mb-3" name="app-prev-uni-enrolled-month" id="month">
                            <option hidden>Month</option>
                            <option value="Jan">Jan</option>
                            <option value="Feb">Feb</option>
                            <option value="Mar">Mar</option>
                            <option value="Apr">Apr</option>
                            <option value="May">May</option>
                            <option value="Jun">Jun</option>
                            <option value="Jul">Jul</option>
                            <option value="Aug">Aug</option>
                            <option value="Sep">Sep</option>
                            <option value="Oct">Oct</option>
                            <option value="Nov">Nov</option>
                            <option value="Dec">Dec</option>
                        </select>
                        <select class="form-select form-select-sm mb-3" name="app-prev-uni-enrolled-year" id="year">
                            <option hidden>Year</option>
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

                    <div class="mb-4">
                        <label class="form-label" for="prev-uni-completed">* Did you complete?</label>
                        <label for="prev-uni-completed-yes">
                            <input type="radio" name="prev-uni-completed" id="prev-uni-completed-yes" style="margin-left: 20px;"> Yes
                        </label>
                        <label for="prev-uni-completed-no">
                            <input type="radio" name="prev-uni-completed" id="prev-uni-completed-no" style="margin-left: 20px;"> No
                        </label>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="prev-uni-completed-date">Date of Completion</label>
                        <select class="form-select form-select-sm mb-3" name="prev-uni-completed-date-month" id="prev-uni-completed-date-month">
                            <option hidden>Month</option>
                        </select>
                        <select class="form-select form-select-sm mb-3" name="prev-uni-completed-date-year" id="prev-uni-completed-date-year">
                            <option hidden>Year</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="prev-uni-reasons">If you did not complete, select reason(s)</label>
                        <select class="form-select form-select-sm mb-3" name="prev-uni-reasons" id="prev-uni-reasons">
                            <option hidden>Reasons</option>
                            <option value="Deffered">Deffered</option>
                            <option value="Withdrawn">Withdrawn</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="prev-uni-reasons-stmt">Reasons...</label>
                        <textarea name="prev-uni-reasons-stmt" id="" cols="30" rows="5"></textarea>
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
        <?php require_once('../inc/page-footer.php') ?>
    </div>

    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/myjs.js"></script>
    <script>
        $(document).ready(function() {
            getYears(document.getElementById("prev-uni-completed-date-month"), 'm');
            getYears(document.getElementById("prev-uni-completed-date-year"), 'y');

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