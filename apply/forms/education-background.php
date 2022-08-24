<?php

use Src\Controller\UsersController;

require_once('../src/Controller/UsersController.php');

$user = new UsersController();
$data = $user->fetchApplicantAcaB($user_id);

?>
<form id="appForm" method="POST" style="margin-top: 50px !important;">

    <?php


    ?>

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
                        <option hidden>Month</option>
                        <option value="Jan" <?= $personal_PU[0]["month_enrolled"] == "Jan" ? "selected" : "" ?>>Jan</option>
                        <option value="Feb" <?= $personal_PU[0]["month_enrolled"] == "Feb" ? "selected" : "" ?>>Feb</option>
                        <option value="Mar" <?= $personal_PU[0]["month_enrolled"] == "Mar" ? "selected" : "" ?>>Mar</option>
                        <option value="Apr" <?= $personal_PU[0]["month_enrolled"] == "Apr" ? "selected" : "" ?>>Apr</option>
                        <option value="May" <?= $personal_PU[0]["month_enrolled"] == "May" ? "selected" : "" ?>>May</option>
                        <option value="Jun" <?= $personal_PU[0]["month_enrolled"] == "Jun" ? "selected" : "" ?>>Jun</option>
                        <option value="Jul" <?= $personal_PU[0]["month_enrolled"] == "Jul" ? "selected" : "" ?>>Jul</option>
                        <option value="Aug" <?= $personal_PU[0]["month_enrolled"] == "Aug" ? "selected" : "" ?>>Aug</option>
                        <option value="Sep" <?= $personal_PU[0]["month_enrolled"] == "Sep" ? "selected" : "" ?>>Sep</option>
                        <option value="Oct" <?= $personal_PU[0]["month_enrolled"] == "Oct" ? "selected" : "" ?>>Oct</option>
                        <option value="Nov" <?= $personal_PU[0]["month_enrolled"] == "Nov" ? "selected" : "" ?>>Nov</option>
                        <option value="Dec" <?= $personal_PU[0]["month_enrolled"] == "Dec" ? "selected" : "" ?>>Dec</option>
                    </select>
                    <select class="form-select form-select-sm mb-3" name="app-exam-year" id="app-exam-year" class="yearList">
                        <option value="" hidden>Year</option>
                        <option value="2022" <?= $personal_PU[0]["year_enrolled"] == "2022" ? "selected" : "" ?>>2022</option>
                        <option value="2021" <?= $personal_PU[0]["year_enrolled"] == "2021" ? "selected" : "" ?>>2021</option>
                        <option value="2020" <?= $personal_PU[0]["year_enrolled"] == "2020" ? "selected" : "" ?>>2020</option>
                        <option value="2019" <?= $personal_PU[0]["year_enrolled"] == "2019" ? "selected" : "" ?>>2019</option>
                        <option value="2018" <?= $personal_PU[0]["year_enrolled"] == "2018" ? "selected" : "" ?>>2018</option>
                        <option value="2017" <?= $personal_PU[0]["year_enrolled"] == "2017" ? "selected" : "" ?>>2017</option>
                        <option value="2016" <?= $personal_PU[0]["year_enrolled"] == "2016" ? "selected" : "" ?>>2016</option>
                        <option value="2015" <?= $personal_PU[0]["year_enrolled"] == "2015" ? "selected" : "" ?>>2015</option>
                        <option value="2014" <?= $personal_PU[0]["year_enrolled"] == "2014" ? "selected" : "" ?>>2014</option>
                        <option value="2013" <?= $personal_PU[0]["year_enrolled"] == "2013" ? "selected" : "" ?>>2013</option>
                        <option value="2012" <?= $personal_PU[0]["year_enrolled"] == "2012" ? "selected" : "" ?>>2012</option>
                        <option value="2011" <?= $personal_PU[0]["year_enrolled"] == "2011" ? "selected" : "" ?>>2011</option>
                        <option value="2010" <?= $personal_PU[0]["year_enrolled"] == "2010" ? "selected" : "" ?>>2010</option>
                        <option value="2009" <?= $personal_PU[0]["year_enrolled"] == "2009" ? "selected" : "" ?>>2009</option>
                        <option value="2008" <?= $personal_PU[0]["year_enrolled"] == "2008" ? "selected" : "" ?>>2008</option>
                        <option value="2007" <?= $personal_PU[0]["year_enrolled"] == "2007" ? "selected" : "" ?>>2007</option>
                        <option value="2006" <?= $personal_PU[0]["year_enrolled"] == "2006" ? "selected" : "" ?>>2006</option>
                        <option value="2005" <?= $personal_PU[0]["year_enrolled"] == "2005" ? "selected" : "" ?>>2005</option>
                        <option value="2004" <?= $personal_PU[0]["year_enrolled"] == "2004" ? "selected" : "" ?>>2004</option>
                        <option value="2003" <?= $personal_PU[0]["year_enrolled"] == "2003" ? "selected" : "" ?>>2003</option>
                        <option value="2002" <?= $personal_PU[0]["year_enrolled"] == "2002" ? "selected" : "" ?>>2002</option>
                        <option value="2001" <?= $personal_PU[0]["year_enrolled"] == "2001" ? "selected" : "" ?>>2001</option>
                        <option value="2000" <?= $personal_PU[0]["year_enrolled"] == "2000" ? "selected" : "" ?>>2000</option>
                        <option value="1999" <?= $personal_PU[0]["year_enrolled"] == "1999" ? "selected" : "" ?>>1999</option>
                        <option value="1998" <?= $personal_PU[0]["year_enrolled"] == "1998" ? "selected" : "" ?>>1998</option>
                        <option value="1997" <?= $personal_PU[0]["year_enrolled"] == "1997" ? "selected" : "" ?>>1997</option>
                        <option value="1996" <?= $personal_PU[0]["year_enrolled"] == "1996" ? "selected" : "" ?>>1996</option>
                        <option value="1995" <?= $personal_PU[0]["year_enrolled"] == "1995" ? "selected" : "" ?>>1995</option>
                        <option value="1994" <?= $personal_PU[0]["year_enrolled"] == "1994" ? "selected" : "" ?>>1994</option>
                        <option value="1993" <?= $personal_PU[0]["year_enrolled"] == "1993" ? "selected" : "" ?>>1993</option>
                        <option value="1992" <?= $personal_PU[0]["year_enrolled"] == "1992" ? "selected" : "" ?>>1992</option>
                        <option value="1991" <?= $personal_PU[0]["year_enrolled"] == "1991" ? "selected" : "" ?>>1991</option>
                        <option value="1990" <?= $personal_PU[0]["year_enrolled"] == "1990" ? "selected" : "" ?>>1990</option>
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
            </div>
        </div>
    </fieldset>
</form>

<div class="mb-4">
    <button class="btn btn-primary" style="padding: 10px; float:right;">Add Education</button>
</div>