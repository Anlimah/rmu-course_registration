<?php

use Src\Controller\UsersController;

require_once('../src/Controller/UsersController.php');

$user = new UsersController();
$data = $user->fetchApplicantAcaB($user_id);
$app_type = $user->getApplicationType($user_id);

?>
<form id="appForm" method="POST" style="margin-top: 50px !important;">

    <?php if ($app_type[0]["form_type"] == 1) { ?>

        <!--Exam sitting for people applying with masters, degree, diploma, and other certificate-->
        <fieldset class="fieldset" id="graduate">
            <legend>Examination Sittings</legend>
            <div class="field-content">
                <div class="form-fields" style="flex-grow: 8;">
                    <div class="mb-4">
                        <label class="form-label" for="school1">School Name <span class="input-required">*</span></label>
                        <input class="form-control" type="text" name="school" id="school" placeholder="School Name">
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="cert-type"> Certificate/Degree <span class="input-required">*</span></label>
                        <select class="form-select form-select-sm mb-3" name="cert-type1" id="cert-type">
                            <option value="" hidden>Examination Type</option>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                            <option value="2018">2018</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="index-number">Index Number <span class="input-required">*</span></label>
                        <input class="form-control" type="text" name="index-number1" id="index-number1" placeholder="Index Number">
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="completion-date">Date <span class="input-required">*</span></label>
                        <div style="max-width: 280px !important; display:flex; flex-direction:row; justify-content: space-between">
                            <select class="form-select form-select-sm mb-3" style="margin-right: 10px;" name="month-completed" id="month-completed" class="form-select form-select-lg mb-3">
                                <option value="" hidden>Month</option>
                                <option hidden>Month</option>
                                <option value="Jan" <?= $data[0]["month_completed"] == "Jan" ? "selected" : "" ?>>Jan</option>
                                <option value="Feb" <?= $data[0]["month_completed"] == "Feb" ? "selected" : "" ?>>Feb</option>
                                <option value="Mar" <?= $data[0]["month_completed"] == "Mar" ? "selected" : "" ?>>Mar</option>
                                <option value="Apr" <?= $data[0]["month_completed"] == "Apr" ? "selected" : "" ?>>Apr</option>
                                <option value="May" <?= $data[0]["month_completed"] == "May" ? "selected" : "" ?>>May</option>
                                <option value="Jun" <?= $data[0]["month_completed"] == "Jun" ? "selected" : "" ?>>Jun</option>
                                <option value="Jul" <?= $data[0]["month_completed"] == "Jul" ? "selected" : "" ?>>Jul</option>
                                <option value="Aug" <?= $data[0]["month_completed"] == "Aug" ? "selected" : "" ?>>Aug</option>
                                <option value="Sep" <?= $data[0]["month_completed"] == "Sep" ? "selected" : "" ?>>Sep</option>
                                <option value="Oct" <?= $data[0]["month_completed"] == "Oct" ? "selected" : "" ?>>Oct</option>
                                <option value="Nov" <?= $data[0]["month_completed"] == "Nov" ? "selected" : "" ?>>Nov</option>
                                <option value="Dec" <?= $data[0]["month_completed"] == "Dec" ? "selected" : "" ?>>Dec</option>
                            </select>
                            <select class="form-select form-select-sm mb-3" name="year-completed" id="year-completed" class="yearList">
                                <option value="" hidden>Year</option>
                                <option value="2022" <?= $data[0]["year_completed"] == "2022" ? "selected" : "" ?>>2022</option>
                                <option value="2021" <?= $data[0]["year_completed"] == "2021" ? "selected" : "" ?>>2021</option>
                                <option value="2020" <?= $data[0]["year_completed"] == "2020" ? "selected" : "" ?>>2020</option>
                                <option value="2019" <?= $data[0]["year_completed"] == "2019" ? "selected" : "" ?>>2019</option>
                                <option value="2018" <?= $data[0]["year_completed"] == "2018" ? "selected" : "" ?>>2018</option>
                                <option value="2017" <?= $data[0]["year_completed"] == "2017" ? "selected" : "" ?>>2017</option>
                                <option value="2016" <?= $data[0]["year_completed"] == "2016" ? "selected" : "" ?>>2016</option>
                                <option value="2015" <?= $data[0]["year_completed"] == "2015" ? "selected" : "" ?>>2015</option>
                                <option value="2014" <?= $data[0]["year_completed"] == "2014" ? "selected" : "" ?>>2014</option>
                                <option value="2013" <?= $data[0]["year_completed"] == "2013" ? "selected" : "" ?>>2013</option>
                                <option value="2012" <?= $data[0]["year_completed"] == "2012" ? "selected" : "" ?>>2012</option>
                                <option value="2011" <?= $data[0]["year_completed"] == "2011" ? "selected" : "" ?>>2011</option>
                                <option value="2010" <?= $data[0]["year_completed"] == "2010" ? "selected" : "" ?>>2010</option>
                                <option value="2009" <?= $data[0]["year_completed"] == "2009" ? "selected" : "" ?>>2009</option>
                                <option value="2008" <?= $data[0]["year_completed"] == "2008" ? "selected" : "" ?>>2008</option>
                                <option value="2007" <?= $data[0]["year_completed"] == "2007" ? "selected" : "" ?>>2007</option>
                                <option value="2006" <?= $data[0]["year_completed"] == "2006" ? "selected" : "" ?>>2006</option>
                                <option value="2005" <?= $data[0]["year_completed"] == "2005" ? "selected" : "" ?>>2005</option>
                                <option value="2004" <?= $data[0]["year_completed"] == "2004" ? "selected" : "" ?>>2004</option>
                                <option value="2003" <?= $data[0]["year_completed"] == "2003" ? "selected" : "" ?>>2003</option>
                                <option value="2002" <?= $data[0]["year_completed"] == "2002" ? "selected" : "" ?>>2002</option>
                                <option value="2001" <?= $data[0]["year_completed"] == "2001" ? "selected" : "" ?>>2001</option>
                                <option value="2000" <?= $data[0]["year_completed"] == "2000" ? "selected" : "" ?>>2000</option>
                                <option value="1999" <?= $data[0]["year_completed"] == "1999" ? "selected" : "" ?>>1999</option>
                                <option value="1998" <?= $data[0]["year_completed"] == "1998" ? "selected" : "" ?>>1998</option>
                                <option value="1997" <?= $data[0]["year_completed"] == "1997" ? "selected" : "" ?>>1997</option>
                                <option value="1996" <?= $data[0]["year_completed"] == "1996" ? "selected" : "" ?>>1996</option>
                                <option value="1995" <?= $data[0]["year_completed"] == "1995" ? "selected" : "" ?>>1995</option>
                                <option value="1994" <?= $data[0]["year_completed"] == "1994" ? "selected" : "" ?>>1994</option>
                                <option value="1993" <?= $data[0]["year_completed"] == "1993" ? "selected" : "" ?>>1993</option>
                                <option value="1992" <?= $data[0]["year_completed"] == "1992" ? "selected" : "" ?>>1992</option>
                                <option value="1991" <?= $data[0]["year_completed"] == "1991" ? "selected" : "" ?>>1991</option>
                                <option value="1990" <?= $data[0]["year_completed"] == "1990" ? "selected" : "" ?>>1990</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>

    <?php } else if ($app_type[0]["form_type"] == 2 || $app_type[0]["form_type"] == 3) { ?>
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
                        <div style="max-width: 280px !important; display:flex; flex-direction:row; justify-content: space-between">
                            <select class="form-select form-select-sm mb-3" style="margin-right: 10px;" name="app-exam-month" id="app-exam-month" class="form-select form-select-lg mb-3">
                                <option value="" hidden>Month</option>
                                <option hidden>Month</option>
                                <option value="Jan" <?= $data[0]["month_completed"] == "Jan" ? "selected" : "" ?>>Jan</option>
                                <option value="Feb" <?= $data[0]["month_completed"] == "Feb" ? "selected" : "" ?>>Feb</option>
                                <option value="Mar" <?= $data[0]["month_completed"] == "Mar" ? "selected" : "" ?>>Mar</option>
                                <option value="Apr" <?= $data[0]["month_completed"] == "Apr" ? "selected" : "" ?>>Apr</option>
                                <option value="May" <?= $data[0]["month_completed"] == "May" ? "selected" : "" ?>>May</option>
                                <option value="Jun" <?= $data[0]["month_completed"] == "Jun" ? "selected" : "" ?>>Jun</option>
                                <option value="Jul" <?= $data[0]["month_completed"] == "Jul" ? "selected" : "" ?>>Jul</option>
                                <option value="Aug" <?= $data[0]["month_completed"] == "Aug" ? "selected" : "" ?>>Aug</option>
                                <option value="Sep" <?= $data[0]["month_completed"] == "Sep" ? "selected" : "" ?>>Sep</option>
                                <option value="Oct" <?= $data[0]["month_completed"] == "Oct" ? "selected" : "" ?>>Oct</option>
                                <option value="Nov" <?= $data[0]["month_completed"] == "Nov" ? "selected" : "" ?>>Nov</option>
                                <option value="Dec" <?= $data[0]["month_completed"] == "Dec" ? "selected" : "" ?>>Dec</option>
                            </select>
                            <select class="form-select form-select-sm mb-3" name="app-exam-year" id="app-exam-year" class="yearList">
                                <option value="" hidden>Year</option>
                                <option value="2022" <?= $data[0]["year_completed"] == "2022" ? "selected" : "" ?>>2022</option>
                                <option value="2021" <?= $data[0]["year_completed"] == "2021" ? "selected" : "" ?>>2021</option>
                                <option value="2020" <?= $data[0]["year_completed"] == "2020" ? "selected" : "" ?>>2020</option>
                                <option value="2019" <?= $data[0]["year_completed"] == "2019" ? "selected" : "" ?>>2019</option>
                                <option value="2018" <?= $data[0]["year_completed"] == "2018" ? "selected" : "" ?>>2018</option>
                                <option value="2017" <?= $data[0]["year_completed"] == "2017" ? "selected" : "" ?>>2017</option>
                                <option value="2016" <?= $data[0]["year_completed"] == "2016" ? "selected" : "" ?>>2016</option>
                                <option value="2015" <?= $data[0]["year_completed"] == "2015" ? "selected" : "" ?>>2015</option>
                                <option value="2014" <?= $data[0]["year_completed"] == "2014" ? "selected" : "" ?>>2014</option>
                                <option value="2013" <?= $data[0]["year_completed"] == "2013" ? "selected" : "" ?>>2013</option>
                                <option value="2012" <?= $data[0]["year_completed"] == "2012" ? "selected" : "" ?>>2012</option>
                                <option value="2011" <?= $data[0]["year_completed"] == "2011" ? "selected" : "" ?>>2011</option>
                                <option value="2010" <?= $data[0]["year_completed"] == "2010" ? "selected" : "" ?>>2010</option>
                                <option value="2009" <?= $data[0]["year_completed"] == "2009" ? "selected" : "" ?>>2009</option>
                                <option value="2008" <?= $data[0]["year_completed"] == "2008" ? "selected" : "" ?>>2008</option>
                                <option value="2007" <?= $data[0]["year_completed"] == "2007" ? "selected" : "" ?>>2007</option>
                                <option value="2006" <?= $data[0]["year_completed"] == "2006" ? "selected" : "" ?>>2006</option>
                                <option value="2005" <?= $data[0]["year_completed"] == "2005" ? "selected" : "" ?>>2005</option>
                                <option value="2004" <?= $data[0]["year_completed"] == "2004" ? "selected" : "" ?>>2004</option>
                                <option value="2003" <?= $data[0]["year_completed"] == "2003" ? "selected" : "" ?>>2003</option>
                                <option value="2002" <?= $data[0]["year_completed"] == "2002" ? "selected" : "" ?>>2002</option>
                                <option value="2001" <?= $data[0]["year_completed"] == "2001" ? "selected" : "" ?>>2001</option>
                                <option value="2000" <?= $data[0]["year_completed"] == "2000" ? "selected" : "" ?>>2000</option>
                                <option value="1999" <?= $data[0]["year_completed"] == "1999" ? "selected" : "" ?>>1999</option>
                                <option value="1998" <?= $data[0]["year_completed"] == "1998" ? "selected" : "" ?>>1998</option>
                                <option value="1997" <?= $data[0]["year_completed"] == "1997" ? "selected" : "" ?>>1997</option>
                                <option value="1996" <?= $data[0]["year_completed"] == "1996" ? "selected" : "" ?>>1996</option>
                                <option value="1995" <?= $data[0]["year_completed"] == "1995" ? "selected" : "" ?>>1995</option>
                                <option value="1994" <?= $data[0]["year_completed"] == "1994" ? "selected" : "" ?>>1994</option>
                                <option value="1993" <?= $data[0]["year_completed"] == "1993" ? "selected" : "" ?>>1993</option>
                                <option value="1992" <?= $data[0]["year_completed"] == "1992" ? "selected" : "" ?>>1992</option>
                                <option value="1991" <?= $data[0]["year_completed"] == "1991" ? "selected" : "" ?>>1991</option>
                                <option value="1990" <?= $data[0]["year_completed"] == "1990" ? "selected" : "" ?>>1990</option>
                            </select>
                        </div>
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
                </div>
            </div>
        </fieldset>

    <?php } ?>

</form>

<!--<div class="mb-4">
    <button class="btn btn-primary" style="padding: 10px; float:right;">Add Education</button>
</div>-->