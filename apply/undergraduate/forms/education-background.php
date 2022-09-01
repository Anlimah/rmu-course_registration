<?php
require_once('../../bootstrap.php');

use Src\Controller\UsersController;

$user = new UsersController();
$personal_PU = $user->fetchApplicantPreUni($user_id);
$data = $user->fetchApplicantAcaB($user_id);
$app_type = $user->getApplicationType($user_id);
?>
<form id="appForm" method="#" style="margin-top: 50px !important;">

    <fieldset class="fieldset" id="graduate">
        <div class="field-header">
            <legend>Examination Sittings</legend>
        </div>
        <div class="field-content">
            <div class="mb-4">
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
                            <div id="step-1" style="margin: auto 20%;">
                                <div class="mb-4">
                                    <label class="form-label" for="school1">School Name <span class="input-required">*</span></label>
                                    <input class="form-control" type="text" name="school1" id="school1" placeholder="School Name">
                                </div>
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
                                    <input class="form-control" type="text" name="index-number1" id="index-number1" placeholder="Index Number">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="completion-date">Date Started <span class="input-required">*</span></label>
                                    <div style="max-width: 280px !important; display:flex; flex-direction:row; justify-content: space-between">
                                        <select class="form-select form-select-sm mb-3" style="margin-right: 10px;" name="month-completed1" id="month-completed1" class="form-select form-select-lg mb-3">
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
                                        <select class="form-select form-select-sm mb-3" name="year-completed1" id="year-completed1" class="yearList">
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
                                        <select class="form-select form-select-sm mb-3" style="margin-right: 10px;" name="month-completed1" id="month-completed1" class="form-select form-select-lg mb-3">
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
                                        <select class="form-select form-select-sm mb-3" name="year-completed1" id="year-completed1" class="yearList">
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
                        <div class="modal-footer" style="display: flex !important; flex-direction: row !important; justify-content: space-between !important;">
                            <button type="button" class="btn btn-secondary">Prev. Step</button>
                            <button type="button" class="btn btn-primary">Next Step</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>

    <?php if ($app_type[0]["form_type"] == 1) { ?>

        <!--Exam sitting for people applying with masters, degree, diploma, and other certificate-->
        <!--<fieldset class="fieldset" id="graduate">
            <div class="field-header">
                <legend>Examination Sittings</legend>
            </div>
            <div class="field-content">
                <div class="mb-4">
                    <p>
                        Please list all colleges, universities, or other postsecondary institutions in which you attended classes. If you went to multiple institutions, please enter each separately. </br>
                    </p>
                    <p>
                        </br>Many schools issue transcripts electronically, either through their own web services or through vendors. If this option is available through the institutions you attended, please specify that your transcript(s) be sent to the address below as this will expedite the delivery of your transcript(s) and the completion of your application: <a href="mailto:transcripts@rmu.edu.gh">transcripts@rmu.edu.gh</a>.
                    </p>
                </div>
                <button class="btn btn-primary">Add School</button>
                <div class="mb-4">
                    <label class="form-label" for="school1">School Name <span class="input-required">*</span></label>
                    <input class="form-control" type="text" name="school1" id="school1" placeholder="School Name">
                </div>
                <div class="mb-4">
                    <label class="form-label" for="cert-type"> Certificate/Degree <span class="input-required">*</span></label>
                    <select class="form-select form-select-sm mb-3" name="cert-type1" id="cert-type1">
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
                    <label class="form-label" for="completion-date">Date Completed <span class="input-required">*</span></label>
                    <div style="max-width: 280px !important; display:flex; flex-direction:row; justify-content: space-between">
                        <select class="form-select form-select-sm mb-3" style="margin-right: 10px;" name="month-completed1" id="month-completed1" class="form-select form-select-lg mb-3">
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
                        <select class="form-select form-select-sm mb-3" name="year-completed1" id="year-completed1" class="yearList">
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
        </fieldset>-->

    <?php } ?>
    <?php if ($app_type[0]["form_type"] == 2 || $app_type[0]["form_type"] == 3) { ?>
        <!-- Exam sitting for people applying with wassce/ssce    -->
        <!--<fieldset class="fieldset" id="undergraduate">
            <div class="field-header">
                <legend>Examination Sittings</legend>
            </div>
            <div class="field-content">
                <div class="mb-4">
                    <label class="form-label" for="school1">School Name <span class="input-required">*</span></label>
                    <input class="form-control" type="text" name="school1" id="school1" value="<?= $personal[0]["middle_name"] ?>" placeholder="School Name">
                </div>
                <div class="mb-4">
                    <label class="form-label" for="cert-type"> Certificate/Degree <span class="input-required">*</span></label>
                    <select class="form-select form-select-sm mb-3" name="cert-type1" id="cert-type1">
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
                        <select class="form-select form-select-sm mb-3" style="margin-right: 10px;" name="month-completed1" id="month-completed1" class="form-select form-select-lg mb-3">
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
                        <select class="form-select form-select-sm mb-3" name="year-completed1" id="year-completed1" class="yearList">
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
        </fieldset>

        <fieldset class="fieldset hide" id="prev-uni-yes">
            <div class="field-header">
                <legend>Previous University Enrollment Information</legend>
            </div>
            <div class="field-content">

                <div class="mb-4">
                    <label class="form-label" for="prev-uni-rec">Do you have any previous University records? <span class="input-required">*</span></label>
                    <div>
                        <label class="form-label radio-btn" for="prev-uni-rec-yes">
                            <input type="radio" style="margin: 0 !important; padding: 0 !important;" class="prev-uni-rec" name="prev-uni-rec" id="prev-uni-rec-yes" class="prev-uni-rec"> YES
                        </label>
                        <label class="form-label radio-btn" for="prev-uni-rec-no">
                            <input type="radio" style="margin: 0 !important; padding: 0 !important;" class="prev-uni-rec" name="prev-uni-rec" id="prev-uni-rec-no" class="prev-uni-rec"> NO
                        </label>
                    </div>

                </div>
                <div class="mb-4">
                    <label class="form-label" for="app-prev-uni-name">Name of University</label>
                    <input class="form-control" type="text" name="app-prev-uni-name" id="app-prev-uni-name" value="<?= $personal_PU[0]["name_of_uni"] ?>">
                </div>
                <div class="mb-4">
                    <label class="form-label" for="app-prev-uni-prog">Program Pursued</label>
                    <input class="form-control" type="text" name="app-prev-uni-prog" id="app-prev-uni-prog" value="<?= $personal_PU[0]["program"] ?>">
                </div>
                <div class="mb-4">
                    <label class="form-label" for="app-prev-uni-enrolled">Date enrolled</label>
                    <div style="max-width: 280px !important; display:flex; flex-direction:row; justify-content: space-between">
                        <select class="form-select form-select-sm mb-3" style="margin-right: 10px;" name="app-prev-uni-enrolled-month" id="app-prev-uni-enrolled-month">
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
                        <select class="form-select form-select-sm mb-3" name="app-prev-uni-enrolled-year" id="app-prev-uni-enrolled-year">
                            <option hidden>Year</option>
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

                </div>

                <div class="mb-4">
                    <label class="form-label" for="prev-uni-completed">* Did you complete?</label>
                    <label class="form-label  radio-btn" for="prev-uni-completed-yes">
                        <input type="radio" name="prev-uni-completed" id="prev-uni-completed-yes"> YES
                    </label>
                    <label class="form-label  radio-btn" for="prev-uni-completed-no">
                        <input type="radio" name="prev-uni-completed" id="prev-uni-completed-no"> NO
                    </label>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="prev-uni-completed-date">Date Completed</label>
                    <div style="max-width: 280px !important; display:flex; flex-direction:row; justify-content: space-between">
                        <select class="form-select form-select-sm mb-3" style="margin-right: 10px;" name="prev-uni-completed-date-month" id="prev-uni-completed-date-month">
                            <option hidden>Month</option>
                            <option value="Jan" <?= $personal_PU[0]["month_completed"] == "Jan" ? "selected" : "" ?>>Jan</option>
                            <option value="Feb" <?= $personal_PU[0]["month_completed"] == "Feb" ? "selected" : "" ?>>Feb</option>
                            <option value="Mar" <?= $personal_PU[0]["month_completed"] == "Mar" ? "selected" : "" ?>>Mar</option>
                            <option value="Apr" <?= $personal_PU[0]["month_completed"] == "Apr" ? "selected" : "" ?>>Apr</option>
                            <option value="May" <?= $personal_PU[0]["month_completed"] == "May" ? "selected" : "" ?>>May</option>
                            <option value="Jun" <?= $personal_PU[0]["month_completed"] == "Jun" ? "selected" : "" ?>>Jun</option>
                            <option value="Jul" <?= $personal_PU[0]["month_completed"] == "Jul" ? "selected" : "" ?>>Jul</option>
                            <option value="Aug" <?= $personal_PU[0]["month_completed"] == "Aug" ? "selected" : "" ?>>Aug</option>
                            <option value="Sep" <?= $personal_PU[0]["month_completed"] == "Sep" ? "selected" : "" ?>>Sep</option>
                            <option value="Oct" <?= $personal_PU[0]["month_completed"] == "Oct" ? "selected" : "" ?>>Oct</option>
                            <option value="Nov" <?= $personal_PU[0]["month_completed"] == "Nov" ? "selected" : "" ?>>Nov</option>
                            <option value="Dec" <?= $personal_PU[0]["month_completed"] == "Dec" ? "selected" : "" ?>>Dec</option>
                        </select>
                        <select class="form-select form-select-sm mb-3" name="prev-uni-completed-date-year" id="prev-uni-completed-date-year">
                            <option hidden>Year</option>
                            <option value="2022" <?= $personal_PU[0]["year_completed"] == "2022" ? "selected" : "" ?>>2022</option>
                            <option value="2021" <?= $personal_PU[0]["year_completed"] == "2021" ? "selected" : "" ?>>2021</option>
                            <option value="2020" <?= $personal_PU[0]["year_completed"] == "2020" ? "selected" : "" ?>>2020</option>
                            <option value="2019" <?= $personal_PU[0]["year_completed"] == "2019" ? "selected" : "" ?>>2019</option>
                            <option value="2018" <?= $personal_PU[0]["year_completed"] == "2018" ? "selected" : "" ?>>2018</option>
                            <option value="2017" <?= $personal_PU[0]["year_completed"] == "2017" ? "selected" : "" ?>>2017</option>
                            <option value="2016" <?= $personal_PU[0]["year_completed"] == "2016" ? "selected" : "" ?>>2016</option>
                            <option value="2015" <?= $personal_PU[0]["year_completed"] == "2015" ? "selected" : "" ?>>2015</option>
                            <option value="2014" <?= $personal_PU[0]["year_completed"] == "2014" ? "selected" : "" ?>>2014</option>
                            <option value="2013" <?= $personal_PU[0]["year_completed"] == "2013" ? "selected" : "" ?>>2013</option>
                            <option value="2012" <?= $personal_PU[0]["year_completed"] == "2012" ? "selected" : "" ?>>2012</option>
                            <option value="2011" <?= $personal_PU[0]["year_completed"] == "2011" ? "selected" : "" ?>>2011</option>
                            <option value="2010" <?= $personal_PU[0]["year_completed"] == "2010" ? "selected" : "" ?>>2010</option>
                            <option value="2009" <?= $personal_PU[0]["year_completed"] == "2009" ? "selected" : "" ?>>2009</option>
                            <option value="2008" <?= $personal_PU[0]["year_completed"] == "2008" ? "selected" : "" ?>>2008</option>
                            <option value="2007" <?= $personal_PU[0]["year_completed"] == "2007" ? "selected" : "" ?>>2007</option>
                            <option value="2006" <?= $personal_PU[0]["year_completed"] == "2006" ? "selected" : "" ?>>2006</option>
                            <option value="2005" <?= $personal_PU[0]["year_completed"] == "2005" ? "selected" : "" ?>>2005</option>
                            <option value="2004" <?= $personal_PU[0]["year_completed"] == "2004" ? "selected" : "" ?>>2004</option>
                            <option value="2003" <?= $personal_PU[0]["year_completed"] == "2003" ? "selected" : "" ?>>2003</option>
                            <option value="2002" <?= $personal_PU[0]["year_completed"] == "2002" ? "selected" : "" ?>>2002</option>
                            <option value="2001" <?= $personal_PU[0]["year_completed"] == "2001" ? "selected" : "" ?>>2001</option>
                            <option value="2000" <?= $personal_PU[0]["year_completed"] == "2000" ? "selected" : "" ?>>2000</option>
                            <option value="1999" <?= $personal_PU[0]["year_completed"] == "1999" ? "selected" : "" ?>>1999</option>
                            <option value="1998" <?= $personal_PU[0]["year_completed"] == "1998" ? "selected" : "" ?>>1998</option>
                            <option value="1997" <?= $personal_PU[0]["year_completed"] == "1997" ? "selected" : "" ?>>1997</option>
                            <option value="1996" <?= $personal_PU[0]["year_completed"] == "1996" ? "selected" : "" ?>>1996</option>
                            <option value="1995" <?= $personal_PU[0]["year_completed"] == "1995" ? "selected" : "" ?>>1995</option>
                            <option value="1994" <?= $personal_PU[0]["year_completed"] == "1994" ? "selected" : "" ?>>1994</option>
                            <option value="1993" <?= $personal_PU[0]["year_completed"] == "1993" ? "selected" : "" ?>>1993</option>
                            <option value="1992" <?= $personal_PU[0]["year_completed"] == "1992" ? "selected" : "" ?>>1992</option>
                            <option value="1991" <?= $personal_PU[0]["year_completed"] == "1991" ? "selected" : "" ?>>1991</option>
                            <option value="1990" <?= $personal_PU[0]["year_completed"] == "1990" ? "selected" : "" ?>>1990</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="prev-uni-reasons">If you did not complete, select reason(s)</label>
                    <select class="form-select form-select-sm mb-3" name="prev-uni-reasons" id="prev-uni-reasons">
                        <option hidden>Reasons</option>
                        <option value="Deffered" <?= $personal_PU[0]["state"] == "Deffered" ? "selected" : "" ?>>Deffered</option>
                        <option value="Withdrawn" <?= $personal_PU[0]["state"] == "Withdrawn" ? "selected" : "" ?>>Withdrawn</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="prev-uni-reasons-stmt">Reasons...</label>
                    <textarea name="prev-uni-reasons-stmt" id="" style="width: 280px !important;" cols="30" rows="5" class="form-control form-control-sm"><?= $personal_PU[0]["reasons"] ?></textarea>
                </div>
            </div>
        </fieldset>-->

    <?php } ?>

</form>

<!--<div class="mb-4">
    <button class="btn btn-primary" style="padding: 10px; float:right;">Add Education</button>
</div>-->