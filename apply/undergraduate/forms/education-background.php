<?php
require_once('../../bootstrap.php');

use Src\Controller\UsersController;

$user = new UsersController();
$pre_uni_rec = $user->fetchApplicantPreUni($user_id);
$academic_BG = $user->fetchApplicantAcaB($user_id);
$app_type = $user->getApplicationType($user_id);
// /echo json_encode($academic_BG);

require_once('../../inc/page-data.php');

?>

<fieldset class="fieldset row" id="graduate">
    <div class="col-md-4 col-sm-12">
        <legend>Which Secondary/High Schools have you attended?</legend>
    </div>

    <div class="col-md-8 col-sm-12">
        <div class="mb-4">
            <p>
                Please list all colleges, universities, or other secondary institutions in which you attended classes. If you went to multiple institutions, please enter each separately. </br>
            </p>

            <?php
            if (isset($app_type[0]["form_id"]) && $app_type[0]["form_id"] == 1) { ?>
                <p>
                    </br>Many schools issue transcripts electronically, either through their own web services or through vendors. If this option is available through the institutions you attended, please specify that your transcript(s) be sent to the address below as this will expedite the delivery of your transcript(s) and the completion of your application: <a href="mailto:transcripts@rmu.edu.gh">transcripts@rmu.edu.gh</a>.
                </p>
            <?php
            } ?>
        </div>

        <!--Education List Display Area-->
        <div class="mb-4" id="education-list">
            <label class="form-label" for="cert-type">Education History</label>

            <?php
            if (!empty($academic_BG)) {
                foreach ($academic_BG as $edu_hist) {
            ?>
                    <div class="mb-4 edu-history" id="<?= $edu_hist["s_number"] ?>">
                        <div class="edu-history-header">
                            <div class="edu-history-header-info">
                                <p style="font-size: 16px; font-weight: 600;margin:0;padding:0">
                                    <?= htmlspecialchars_decode(html_entity_decode(ucwords(strtolower($edu_hist["school_name"])), ENT_QUOTES), ENT_QUOTES); ?>
                                </p>
                                <p style="color:#8c8c8c;margin:0;padding:0">
                                    <?= ucwords(strtolower($edu_hist["month_started"])) . " " . ucwords(strtolower($edu_hist["year_started"])) . " - " ?>
                                    <?= ucwords(strtolower($edu_hist["month_completed"])) . " " . ucwords(strtolower($edu_hist["year_completed"])) ?>
                                </p>
                            </div>
                            <div class="edu-history-control">
                                <button type="button" class="btn edit-edu-btn" name="edit-edu-btn" id="edit<?= $edu_hist["s_number"] ?>">
                                    <span class="bi bi-pencil-fill" style="font-size: 20px !important;"></span>
                                </button>
                                <button type="button" class="btn delete-edu-btn" name="delete-edu-btn" id="delete<?= $edu_hist["s_number"] ?>">
                                    <span class="bi bi-trash-fill" style="font-size: 20px !important;"></span>
                                </button>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <!--Education List Display Area End-->

        <button type="button" id="add-education-btn" class="mb-4 btn btn-primary">Add School</button>
    </div>
</fieldset>

<!--Previous university record section-->
<fieldset class="fieldset row">
    <div class="col-md-4 col-sm-12">
        <legend>Previous University Enrollment Information</legend>
    </div>

    <!--Previous university record-->
    <div class="col-md-8 col-sm-12">
        <div class="mb-4">
            <div class="mb-4">
                <label class="form-label">Do you have any previous University records? <span class="input-required">*</span></label>
                <div>
                    <label class="form-label radio-btn" for="prev-uni-rec-yes">
                        <input class="prev-uni-rec form-radio form-radio-btn" style="margin: 0 !important; padding: 0 !important;" type="radio" name="prev-uni-rec" id="prev-uni-rec-yes" value="1" <?= $pre_uni_rec[0]["pre_uni_rec"] == 1 ? "checked" : "" ?>> Yes
                    </label>
                    <label class="form-label radio-btn" for="prev-uni-rec-no">
                        <input class="prev-uni-rec form-radio form-radio-btn" style="margin: 0 !important; padding: 0 !important;" type="radio" name="prev-uni-rec" id="prev-uni-rec-no" value="0" <?= $pre_uni_rec[0]["pre_uni_rec"] == 0 ? "checked" : "" ?>> No
                    </label>
                </div>
            </div>

            <!--Previous university record information-->
            <div class="<?= $pre_uni_rec[0]["pre_uni_rec"] == 1 ? "" : "hide" ?>" id="prev-uni-rec-list">
                <div class="mb-4">
                    <label class="form-label" for="name_of_uni">Name of University <span class="input-required">*</span></label>
                    <input class="transform-text required-field form-control form-text-input" type="text" name="name_of_uni" id="name_of_uni" value="<?= $pre_uni_rec[0]["name_of_uni"] ?>" <?= $pre_uni_rec[0]["pre_uni_rec"] == 1 ? "required" : "" ?>>
                </div>
                <div class="mb-4">
                    <label class="form-label" for="program">Program Pursued <span class="input-required">*</span></label>
                    <input class="transform-text required-field form-control form-text-input" type="text" name="program" id="program" value="<?= $pre_uni_rec[0]["program"] ?>" <?= $pre_uni_rec[0]["pre_uni_rec"] == 1 ? "required" : "" ?>>
                </div>
                <div class="mb-4" id="date-enrolled-uni">
                    <label class="form-label" for="completion-date">Date Enrolled <span class="input-required">*</span></label>
                    <div style="max-width: 280px !important; display:flex; flex-direction:row; justify-content: space-between">
                        <select class="required-field form-select-option form-select form-select-sm" style="margin-right: 10px;" name="month-enrolled" id="month-enrolled" <?= $pre_uni_rec[0]["pre_uni_rec"] == 1 ? "required" : "" ?>>
                            <option hidden value="">Month</option>
                            <option value="Jan" <?= $pre_uni_rec[0]["month_enrolled"] == "JAN" ? "selected" : "" ?>>Jan</option>
                            <option value="Feb" <?= $pre_uni_rec[0]["month_enrolled"] == "FEB" ? "selected" : "" ?>>Feb</option>
                            <option value="Mar" <?= $pre_uni_rec[0]["month_enrolled"] == "MAR" ? "selected" : "" ?>>Mar</option>
                            <option value="Apr" <?= $pre_uni_rec[0]["month_enrolled"] == "APR" ? "selected" : "" ?>>Apr</option>
                            <option value="May" <?= $pre_uni_rec[0]["month_enrolled"] == "MAY" ? "selected" : "" ?>>May</option>
                            <option value="Jun" <?= $pre_uni_rec[0]["month_enrolled"] == "JUN" ? "selected" : "" ?>>Jun</option>
                            <option value="Jul" <?= $pre_uni_rec[0]["month_enrolled"] == "JUL" ? "selected" : "" ?>>Jul</option>
                            <option value="Aug" <?= $pre_uni_rec[0]["month_enrolled"] == "AUG" ? "selected" : "" ?>>Aug</option>
                            <option value="Sep" <?= $pre_uni_rec[0]["month_enrolled"] == "SEP" ? "selected" : "" ?>>Sep</option>
                            <option value="Oct" <?= $pre_uni_rec[0]["month_enrolled"] == "OCT" ? "selected" : "" ?>>Oct</option>
                            <option value="Nov" <?= $pre_uni_rec[0]["month_enrolled"] == "NOV" ? "selected" : "" ?>>Nov</option>
                            <option value="Dec" <?= $pre_uni_rec[0]["month_enrolled"] == "DEC" ? "selected" : "" ?>>Dec</option>
                        </select>
                        <select class="required-field form-select-option form-select form-select-sm" name="year-enrolled" id="year-enrolled" <?= $pre_uni_rec[0]["pre_uni_rec"] == 1 ? "required" : "" ?>>
                            <option hidden value="">Year</option>
                            <option value="2023" <?= $pre_uni_rec[0]["year_enrolled"] == "2023" ? "selected" : "" ?>>2023</option>
                            <option value="2022" <?= $pre_uni_rec[0]["year_enrolled"] == "2022" ? "selected" : "" ?>>2022</option>
                            <option value="2021" <?= $pre_uni_rec[0]["year_enrolled"] == "2021" ? "selected" : "" ?>>2021</option>
                            <option value="2020" <?= $pre_uni_rec[0]["year_enrolled"] == "2020" ? "selected" : "" ?>>2020</option>
                            <option value="2019" <?= $pre_uni_rec[0]["year_enrolled"] == "2019" ? "selected" : "" ?>>2019</option>
                            <option value="2018" <?= $pre_uni_rec[0]["year_enrolled"] == "2018" ? "selected" : "" ?>>2018</option>
                            <option value="2017" <?= $pre_uni_rec[0]["year_enrolled"] == "2017" ? "selected" : "" ?>>2017</option>
                            <option value="2016" <?= $pre_uni_rec[0]["year_enrolled"] == "2016" ? "selected" : "" ?>>2016</option>
                            <option value="2015" <?= $pre_uni_rec[0]["year_enrolled"] == "2015" ? "selected" : "" ?>>2015</option>
                            <option value="2014" <?= $pre_uni_rec[0]["year_enrolled"] == "2014" ? "selected" : "" ?>>2014</option>
                            <option value="2013" <?= $pre_uni_rec[0]["year_enrolled"] == "2013" ? "selected" : "" ?>>2013</option>
                            <option value="2012" <?= $pre_uni_rec[0]["year_enrolled"] == "2012" ? "selected" : "" ?>>2012</option>
                            <option value="2011" <?= $pre_uni_rec[0]["year_enrolled"] == "2011" ? "selected" : "" ?>>2011</option>
                            <option value="2010" <?= $pre_uni_rec[0]["year_enrolled"] == "2010" ? "selected" : "" ?>>2010</option>
                            <option value="2009" <?= $pre_uni_rec[0]["year_enrolled"] == "2009" ? "selected" : "" ?>>2009</option>
                            <option value="2008" <?= $pre_uni_rec[0]["year_enrolled"] == "2008" ? "selected" : "" ?>>2008</option>
                            <option value="2007" <?= $pre_uni_rec[0]["year_enrolled"] == "2007" ? "selected" : "" ?>>2007</option>
                            <option value="2006" <?= $pre_uni_rec[0]["year_enrolled"] == "2006" ? "selected" : "" ?>>2006</option>
                            <option value="2005" <?= $pre_uni_rec[0]["year_enrolled"] == "2005" ? "selected" : "" ?>>2005</option>
                            <option value="2004" <?= $pre_uni_rec[0]["year_enrolled"] == "2004" ? "selected" : "" ?>>2004</option>
                            <option value="2003" <?= $pre_uni_rec[0]["year_enrolled"] == "2003" ? "selected" : "" ?>>2003</option>
                            <option value="2002" <?= $pre_uni_rec[0]["year_enrolled"] == "2002" ? "selected" : "" ?>>2002</option>
                            <option value="2001" <?= $pre_uni_rec[0]["year_enrolled"] == "2001" ? "selected" : "" ?>>2001</option>
                            <option value="2000" <?= $pre_uni_rec[0]["year_enrolled"] == "2000" ? "selected" : "" ?>>2000</option>
                            <option value="1999" <?= $pre_uni_rec[0]["year_enrolled"] == "1999" ? "selected" : "" ?>>1999</option>
                            <option value="1998" <?= $pre_uni_rec[0]["year_enrolled"] == "1998" ? "selected" : "" ?>>1998</option>
                            <option value="1997" <?= $pre_uni_rec[0]["year_enrolled"] == "1997" ? "selected" : "" ?>>1997</option>
                            <option value="1996" <?= $pre_uni_rec[0]["year_enrolled"] == "1996" ? "selected" : "" ?>>1996</option>
                            <option value="1995" <?= $pre_uni_rec[0]["year_enrolled"] == "1995" ? "selected" : "" ?>>1995</option>
                            <option value="1994" <?= $pre_uni_rec[0]["year_enrolled"] == "1994" ? "selected" : "" ?>>1994</option>
                            <option value="1993" <?= $pre_uni_rec[0]["year_enrolled"] == "1993" ? "selected" : "" ?>>1993</option>
                            <option value="1992" <?= $pre_uni_rec[0]["year_enrolled"] == "1992" ? "selected" : "" ?>>1992</option>
                            <option value="1991" <?= $pre_uni_rec[0]["year_enrolled"] == "1991" ? "selected" : "" ?>>1991</option>
                            <option value="1990" <?= $pre_uni_rec[0]["year_enrolled"] == "1990" ? "selected" : "" ?>>1990</option>
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label">Did you complete? <span class="input-required">*</span></label>
                    <label class="form-label radio-btn" for="completed-prev-uni-yes">
                        <input class="required-field completed-prev-uni form-radio form-radio-btn" style="margin: 0 !important; padding: 0 !important;" type="radio" name="completed-prev-uni" id="completed-prev-uni-yes" value="1" <?= $pre_uni_rec[0]["completed"] == 1 ? "checked" : "" ?>> Yes
                    </label>
                    <label class="form-label radio-btn" for="completed-prev-uni-no">
                        <input class="required-field completed-prev-uni form-radio form-radio-btn" style="margin: 0 !important; padding: 0 !important;" type="radio" name="completed-prev-uni" id="completed-prev-uni-no" value="0" <?= $pre_uni_rec[0]["completed"] == 0 ? "checked" : "" ?>> No
                    </label>
                </div>
                <div class="mb-4 <?= $pre_uni_rec[0]["completed"] == 1 ? "" : "hide" ?>" id="date-completed-uni">
                    <label class="form-label" for="completion-date">Date Completed <span class="input-required">*</span></label>
                    <div style="max-width: 280px !important; display:flex; flex-direction:row; justify-content: space-between">
                        <select <?= $pre_uni_rec[0]["completed"] == 1 ? "required" : "" ?> class="completed-uni form-select-option form-select form-select-sm" style="margin-right: 10px;" name="month-completed-uni" id="month-completed-uni">
                            <option hidden value="">Month</option>
                            <option value="Jan" <?= $pre_uni_rec[0]["month_completed"] == "JAN" ? "selected" : "" ?>>Jan</option>
                            <option value="Feb" <?= $pre_uni_rec[0]["month_completed"] == "FEB" ? "selected" : "" ?>>Feb</option>
                            <option value="Mar" <?= $pre_uni_rec[0]["month_completed"] == "MAR" ? "selected" : "" ?>>Mar</option>
                            <option value="Apr" <?= $pre_uni_rec[0]["month_completed"] == "APR" ? "selected" : "" ?>>Apr</option>
                            <option value="May" <?= $pre_uni_rec[0]["month_completed"] == "MAY" ? "selected" : "" ?>>May</option>
                            <option value="Jun" <?= $pre_uni_rec[0]["month_completed"] == "JUN" ? "selected" : "" ?>>Jun</option>
                            <option value="Jul" <?= $pre_uni_rec[0]["month_completed"] == "JUL" ? "selected" : "" ?>>Jul</option>
                            <option value="Aug" <?= $pre_uni_rec[0]["month_completed"] == "AUG" ? "selected" : "" ?>>Aug</option>
                            <option value="Sep" <?= $pre_uni_rec[0]["month_completed"] == "SEP" ? "selected" : "" ?>>Sep</option>
                            <option value="Oct" <?= $pre_uni_rec[0]["month_completed"] == "OCT" ? "selected" : "" ?>>Oct</option>
                            <option value="Nov" <?= $pre_uni_rec[0]["month_completed"] == "NOV" ? "selected" : "" ?>>Nov</option>
                            <option value="Dec" <?= $pre_uni_rec[0]["month_completed"] == "DEC" ? "selected" : "" ?>>Dec</option>
                        </select>
                        <select <?= $pre_uni_rec[0]["completed"] == 1 ? "required" : "" ?> class="completed-uni form-select-option form-select form-select-sm" name="year-completed-uni" id="year-completed-uni">
                            <option hidden value="">Year</option>
                            <option value="2023" <?= $pre_uni_rec[0]["year_completed"] == "2023" ? "selected" : "" ?>>2023</option>
                            <option value="2022" <?= $pre_uni_rec[0]["year_completed"] == "2022" ? "selected" : "" ?>>2022</option>
                            <option value="2021" <?= $pre_uni_rec[0]["year_completed"] == "2021" ? "selected" : "" ?>>2021</option>
                            <option value="2020" <?= $pre_uni_rec[0]["year_completed"] == "2020" ? "selected" : "" ?>>2020</option>
                            <option value="2019" <?= $pre_uni_rec[0]["year_completed"] == "2019" ? "selected" : "" ?>>2019</option>
                            <option value="2018" <?= $pre_uni_rec[0]["year_completed"] == "2018" ? "selected" : "" ?>>2018</option>
                            <option value="2017" <?= $pre_uni_rec[0]["year_completed"] == "2017" ? "selected" : "" ?>>2017</option>
                            <option value="2016" <?= $pre_uni_rec[0]["year_completed"] == "2016" ? "selected" : "" ?>>2016</option>
                            <option value="2015" <?= $pre_uni_rec[0]["year_completed"] == "2015" ? "selected" : "" ?>>2015</option>
                            <option value="2014" <?= $pre_uni_rec[0]["year_completed"] == "2014" ? "selected" : "" ?>>2014</option>
                            <option value="2013" <?= $pre_uni_rec[0]["year_completed"] == "2013" ? "selected" : "" ?>>2013</option>
                            <option value="2012" <?= $pre_uni_rec[0]["year_completed"] == "2012" ? "selected" : "" ?>>2012</option>
                            <option value="2011" <?= $pre_uni_rec[0]["year_completed"] == "2011" ? "selected" : "" ?>>2011</option>
                            <option value="2010" <?= $pre_uni_rec[0]["year_completed"] == "2010" ? "selected" : "" ?>>2010</option>
                            <option value="2009" <?= $pre_uni_rec[0]["year_completed"] == "2009" ? "selected" : "" ?>>2009</option>
                            <option value="2008" <?= $pre_uni_rec[0]["year_completed"] == "2008" ? "selected" : "" ?>>2008</option>
                            <option value="2007" <?= $pre_uni_rec[0]["year_completed"] == "2007" ? "selected" : "" ?>>2007</option>
                            <option value="2006" <?= $pre_uni_rec[0]["year_completed"] == "2006" ? "selected" : "" ?>>2006</option>
                            <option value="2005" <?= $pre_uni_rec[0]["year_completed"] == "2005" ? "selected" : "" ?>>2005</option>
                            <option value="2004" <?= $pre_uni_rec[0]["year_completed"] == "2004" ? "selected" : "" ?>>2004</option>
                            <option value="2003" <?= $pre_uni_rec[0]["year_completed"] == "2003" ? "selected" : "" ?>>2003</option>
                            <option value="2002" <?= $pre_uni_rec[0]["year_completed"] == "2002" ? "selected" : "" ?>>2002</option>
                            <option value="2001" <?= $pre_uni_rec[0]["year_completed"] == "2001" ? "selected" : "" ?>>2001</option>
                            <option value="2000" <?= $pre_uni_rec[0]["year_completed"] == "2000" ? "selected" : "" ?>>2000</option>
                            <option value="1999" <?= $pre_uni_rec[0]["year_completed"] == "1999" ? "selected" : "" ?>>1999</option>
                            <option value="1998" <?= $pre_uni_rec[0]["year_completed"] == "1998" ? "selected" : "" ?>>1998</option>
                            <option value="1997" <?= $pre_uni_rec[0]["year_completed"] == "1997" ? "selected" : "" ?>>1997</option>
                            <option value="1996" <?= $pre_uni_rec[0]["year_completed"] == "1996" ? "selected" : "" ?>>1996</option>
                            <option value="1995" <?= $pre_uni_rec[0]["year_completed"] == "1995" ? "selected" : "" ?>>1995</option>
                            <option value="1994" <?= $pre_uni_rec[0]["year_completed"] == "1994" ? "selected" : "" ?>>1994</option>
                            <option value="1993" <?= $pre_uni_rec[0]["year_completed"] == "1993" ? "selected" : "" ?>>1993</option>
                            <option value="1992" <?= $pre_uni_rec[0]["year_completed"] == "1992" ? "selected" : "" ?>>1992</option>
                            <option value="1991" <?= $pre_uni_rec[0]["year_completed"] == "1991" ? "selected" : "" ?>>1991</option>
                            <option value="1990" <?= $pre_uni_rec[0]["year_completed"] == "1990" ? "selected" : "" ?>>1990</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4 <?= $pre_uni_rec[0]["completed"] == 0 ? "" : "hide" ?>" id="uni-not-completed">
                    <div>
                        <label class="form-label" for="state">Why did you not complete? <span class="input-required">*</span></label>
                        <select <?= ($pre_uni_rec[0]["completed"] == 0 && $pre_uni_rec[0]["pre_uni_rec"] == 1) ? "required" : "" ?> class="not-completed-uni form-select-option form-select form-select-sm mb-3" name="state" id="state">
                            <option hidden value="">Choose </option>
                            <option value="Deferred">Deferred</option>
                            <option value="Withdrawn">Withdrawn</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="reasons">Explain reasons <span class="input-required">*</span></label>
                        <textarea <?= ($pre_uni_rec[0]["completed"] == 0 && $pre_uni_rec[0]["pre_uni_rec"] == 1) ? "required" : "" ?> class="not-completed-uni form-control form-text-input" rows="5" style="max-width: 280px; width: 280px;" name="reasons" id="reasons" value="<?= $pre_uni_rec[0]["reasons"] ?>"></textarea>
                    </div>
                </div>
            </div>
            <!--End of Previous univeristy record information-->
        </div>
    </div>
</fieldset>

<!--<div class="mb-4">
    <button class="btn btn-primary" style="padding: 10px; float:right;">Add Education</button>
</div>-->