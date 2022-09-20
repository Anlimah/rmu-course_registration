<?php
require_once('../../bootstrap.php');

use Src\Controller\UsersController;

$user = new UsersController();
$personal_PU = $user->fetchApplicantPreUni($user_id);
$data = $user->fetchApplicantAcaB($user_id);
$app_type = $user->getApplicationType($user_id);

require_once('../../inc/page-data.php');

?>

<fieldset class="fieldset" id="graduate">
    <div class="field-header">
        <legend>Education</legend>
    </div>

    <div class="field-content">
        <div class="mb-4">
            <label class="form-label" for="cert-type">Education History <span class="input-required">*</span></label>
            <p>
                Please list all colleges, universities, or other secondary institutions in which you attended classes. If you went to multiple institutions, please enter each separately. </br>
            </p>
            <?php if ($app_type[0]["form_type"] == 1) { ?>
                <p>
                    </br>Many schools issue transcripts electronically, either through their own web services or through vendors. If this option is available through the institutions you attended, please specify that your transcript(s) be sent to the address below as this will expedite the delivery of your transcript(s) and the completion of your application: <a href="mailto:transcripts@rmu.edu.gh">transcripts@rmu.edu.gh</a>.
                </p>
            <?php } ?>
        </div>

        <div class="mb-4" id="schools-area"></div>

        <button type="button" class="mb-4 btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSchool">Add School</button>

        <!-- Modal -->
        <div class="modal fade" id="addSchool" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Education History</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="step-1" class="steps" style="margin: auto 20%;">
                            <div class="mb-4">
                                <label class="form-label" for="school1">School Name <span class="input-required">*</span></label>
                                <input class="form-control" type="text" name="school1" id="school1" placeholder="School Name">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="school1">School Country <span class="input-required">*</span></label>
                                <input class="form-control" type="text" name="school1" id="school1" placeholder="School Name">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="school1">School City <span class="input-required">*</span></label>
                                <input class="form-control" type="text" name="school1" id="school1" placeholder="School Name">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="school1">Region Province/Region <span class="input-required">*</span></label>
                                <input class="form-control" type="text" name="school1" id="school1" placeholder="School Name">
                            </div>
                        </div>
                        <div id="step-2" class="steps hide" style="display:none; margin: auto 20%;">
                            <div class="mb-4">
                                <label class="form-label" for="cert-type"> Certificate/Degree Earned <span class="input-required">*</span></label>
                                <select class="form-select form-select-sm mb-3" name="cert-type1" id="cert-type1">
                                    <option value="" hidden>Examination Type</option>
                                    <option value="WASSCE">WASSCE</option>
                                    <option value="SSCE">SSCE</option>
                                    <option value="DIPLOMA">Diploma</option>
                                    <option value="DEGREE">Degree</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="index-number">Index Number <span class="input-required">*</span></label>
                                <input class="form-control" type="text" name="index-number" id="index-number" placeholder="Index Number">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="completion-date">Date Started <span class="input-required">*</span></label>
                                <div style="max-width: 280px !important; display:flex; flex-direction:row; justify-content: space-between">
                                    <select class="form-select form-select-sm" style="margin-right: 10px;" name="month-completed1" id="month-completed1" class="form-select form-select-lg mb-3">
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
                                    <select class="form-select form-select-sm" name="year-completed1" id="year-completed1" class="yearList">
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
                                <label class="form-label" for="completion-date">Date Completed <span class="input-required">*</span></label>
                                <div style="max-width: 280px !important; display:flex; flex-direction:row; justify-content: space-between">
                                    <select class="form-select form-select-sm" style="margin-right: 10px;" name="month-completed1" id="month-completed1" class="form-select form-select-lg mb-3">
                                        <option hidden>Month</option>
                                        <?php
                                        foreach (MONTHS as $month) {
                                            echo '<option value="' . $month["abbr"] . '" ' . $data[0]["month_completed"] == $month["abbr"] ? "selected" : "" . ' ?>>' . $month["abbr"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <select class="form-select form-select-sm" name="year-completed1" id="year-completed1" class="yearList">
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
                        <div id="step-3" class="steps hide" style="display:none; margin: auto 20%;">
                            <div class="mb-4">
                                <label class="form-label" for="cert-type">Course/Program Studied <span class="input-required">*</span></label>
                                <select class="form-select form-select-sm mb-3" name="cert-type1" id="cert-type1">
                                    <option hidden>Select</option>
                                    <option value="Business">Business</option>
                                    <option value="General Arts">General Arts</option>
                                    <option value="General Science">General Science</option>
                                    <option value="Home Economics">Home Economics</option>
                                    <option value="Visual Arts">Visual Arts</option>
                                    <option value="Technical">Technical</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="school1">School Name <span class="input-required">*</span></label>
                                <input class="form-control" type="text" name="school1" id="school1" placeholder="School Name">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="display: flex !important; flex-direction: row-reverse !important; justify-content: space-between !important;">
                        <button type="button" class="btn btn-secondary hide" id="prevStep">Prev. Step</button>
                        <button type="button" class="btn btn-primary" id="nextStep">Next Step</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>

<!--<div class="mb-4">
    <button class="btn btn-primary" style="padding: 10px; float:right;">Add Education</button>
</div>-->