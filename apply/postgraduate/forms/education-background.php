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
        <legend>Which schools have you attended?</legend>
    </div>

    <div class="col-md-8 col-sm-12">
        <div class="mb-4">
            <p>
                Please list all colleges, universities, or other secondary institutions in which you attended classes. If you went to multiple institutions, please enter each separately. </br>
            </p>
            <?php if ($app_type[0]["form_id"] == 1) { ?>
                <p>
                    </br>Many schools issue transcripts electronically, either through their own web services or through vendors. If this option is available through the institutions you attended, please specify that your transcript(s) be sent to the address below as this will expedite the delivery of your transcript(s) and the completion of your application: <a href="mailto:transcripts@rmu.edu.gh">transcripts@rmu.edu.gh</a>.
                </p>
            <?php } ?>
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

<?php
$appStatus = $user->getApplicationStatus($user_id);
$courses = $user->fetchCourses();
?>

<!-- Add education history Modal -->
<div class="modal fade" id="addSchoolModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class=" modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Education History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="education-form" name="education-form">
                    <div id="step-1" class="steps">
                        <div class="mb-4" id="sch-name-group">
                            <label class="form-label" for="sch-name">School Name <span class="input-required">*</span></label>
                            <input placeholder="School" class="edu-mod-text form-control" type="text" name="sch-name" id="sch-name">
                        </div>
                        <div class="mb-4" id="sch-country-group">
                            <label class="form-label" for="sch-country">School Country <span class="input-required">*</span></label>
                            <input placeholder="Country" class="edu-mod-text form-control" type="text" name="sch-country" id="sch-country">
                        </div>
                        <div class="mb-4" id="sch-region-group">
                            <label class="form-label" for="sch-region">School Province/Region <span class="input-required">*</span></label>
                            <input placeholder="Province/Region" class="edu-mod-text form-control" type="text" name="sch-region" id="sch-region">
                        </div>
                        <div class="mb-4" id="sch-city-group">
                            <label class="form-label" for="sch-city">School City <span class="input-required">*</span></label>
                            <input placeholder="City" class="edu-mod-text form-control" type="text" name="sch-city" id="sch-city">
                        </div>
                    </div>
                    <div id="step-2" class="steps hide">
                        <div class="mb-4" id="cert-type-group">
                            <label class="form-label" for="cert-type">Certificate or degree Earned <span class="input-required">*</span></label>
                            <select class="edu-mod-select form-select form-select-sm" name="cert-type" id="cert-type">
                                <option value="Select" hidden>Select</option>
                                <option value="DIPLOMA">DIPLOMA</option>
                                <option value="DEGREE">DEGREE</option>
                                <option value="MASTERS">MASTERS</option>
                            </select>
                            <div class="div-container mt-4 sepcific-cert" style="display: none">
                                <label class="form-label" for="other-cert-type"> Specify the certificate name <span class="input-required">*</span></label>
                                <input type="text" id="other-cert-type" name="other-cert-type" class="edu-mod-text form-control" placeholder="Input certificate">
                            </div>
                        </div>
                        <div class="mb-4" id="index-number-group">
                            <label class="form-label" for="index-number">Index Number <span class="input-required">*</span></label>
                            <input placeholder="Index Number" class="edu-mod-text form-control" type="text" name="index-number" id="index-number" placeholder="Index Number">
                        </div>
                        <div class="mb-4" id="date-started-group">
                            <label class="form-label" for="completion-date">Date Admitted <span class="input-required">*</span></label>
                            <div style="max-width: 280px !important; display:flex; flex-direction:row; justify-content: space-between">
                                <select class="edu-mod-date-m form-select form-select-sm" style="margin-right: 10px;" name="month-started" id="month-started">
                                    <option value="Month" hidden>Month</option>
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
                                <select class="edu-mod-date-y form-select form-select-sm" name="year-started" id="year-started">
                                    <option value="Year" hidden>Year</option>
                                    <option value="2023">2023</option>
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
                        </div>
                        <div class="mb-4" id="date-completed-group">
                            <label class="form-label" for="completion-date">Exam Date / Date Completed <span class="input-required">*</span></label>
                            <div style="max-width: 280px !important; display:flex; flex-direction:row; justify-content: space-between">
                                <select class="edu-mod-date-m form-select form-select-sm" style="margin-right: 10px;" name="month-completed" id="month-completed">
                                    <option value="Month" hidden>Month</option>
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
                                <select class="edu-mod-date-y form-select form-select-sm" name="year-completed" id="year-completed">
                                    <option value="Year" hidden>Year</option>
                                    <option value="2023">2023</option>
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
                        </div>
                    </div>
                    <div id="step-3" class="steps hide">
                        <div class="mb-4" id="course-studied-group">
                            <label class="form-label" for="course-studied">Course or program of Study <span class="input-required">*</span></label>
                            <div class="other-course-studied">
                                <input type="text" name="other-course-studied" id="other-course-studied" class="edu-mod-text form-control" placeholder="Enter course studied">
                            </div>
                        </div>
                    </div>
                    <input type="reset" name="reset" id="reset" style="display: none;">
                    <input type="hidden" name="awaiting_result_value" id="awaiting_result_value" value="0">
                </form>
            </div>
            <div class="modal-footer" style="display: flex !important; flex-direction: row-reverse !important; justify-content: space-between !important;">
                <button class="btn btn-primary hide" id="save-education-btn" style="width: 120px;">Save and Close</button>
                <button type="button" class="btn btn-primary" id="nextStep">Next Step</button>
                <p>Step <span class="step-count">1</span> of 3</p>
                <button type="button" class="btn btn-secondary hide" id="prevStep">Prev. Step</button>
            </div>
        </div>
    </div>
</div>
<!--End of Modal-->

<!-- Edit education history Modal -->
<div class="modal fade" id="editSchoolModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-2" aria-labelledby="editStaticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class=" modal-header">
                <h5 class="modal-title" id="editStaticBackdropLabel">Edit Education History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-education-form" name="edit-education-form">
                    <div id="edit-step-1" class="steps">
                        <div class="mb-4" id="edit-sch-name-group">
                            <label class="form-label" for="edit-sch-name">School Name <span class="input-required">*</span></label>
                            <input placeholder="School" class="transform-text edu-mod-text form-control" type="text" name="edit-sch-name" id="edit-sch-name">
                        </div>
                        <div class="mb-4" id="edit-sch-country-group">
                            <label class="form-label" for="edit-sch-country">School Country <span class="input-required">*</span></label>
                            <input placeholder="Country" class="transform-text edu-mod-text form-control" type="text" name="edit-sch-country" id="edit-sch-country">
                        </div>
                        <div class="mb-4" id="edit-sch-region-group">
                            <label class="form-label" for="edit-sch-region">School Province/Region <span class="input-required">*</span></label>
                            <input placeholder="Province/Region" class="transform-text edu-mod-text form-control" type="text" name="edit-sch-region" id="edit-sch-region">
                        </div>
                        <div class="mb-4" id="edit-sch-city-group">
                            <label class="form-label" for="edit-sch-city">School City <span class="input-required">*</span></label>
                            <input placeholder="City" class="transform-text edu-mod-text form-control" type="text" name="edit-sch-city" id="edit-sch-city">
                        </div>
                    </div>
                    <div id="edit-step-2" class="steps hide">
                        <div class="mb-4" id="edit-cert-type-group">
                            <label class="form-label" for="edit-cert-type">Certificate or degree earned <span class="input-required">*</span></label>
                            <select class="transform-text edu-mod-select form-select form-select-sm" name="edit-cert-type" id="edit-cert-type" style="background-color: red;">
                                <option value="Select" hidden>Select</option>
                                <option value="DIPLOMA">DIPLOMA</option>
                                <option value="DEGREE">DEGREE</option>
                                <option value="MASTERS">MASTERS</option>
                            </select>
                            <div class="div-container mt-4 edit-sepcific-cert" style="display: none">
                                <label class="form-label" for="edit-other-cert-type"> Specify the certificate name <span class="input-required">*</span></label>
                                <input type="text" id="edit-other-cert-type" name="edit-other-cert-type" class="transform-text edu-mod-text form-control" placeholder="Input certificate">
                            </div>
                        </div>
                        <div class="mb-4" id="edit-index-number-group">
                            <label class="form-label" for="edit-index-number">Index Number <span class="input-required">*</span></label>
                            <input placeholder="Index Number" class="transform-text edu-mod-text form-control" type="text" name="edit-index-number" id="edit-index-number" placeholder="Index Number">
                        </div>
                        <div class="mb-4" id="edit-date-started-group">
                            <label class="form-label" for="completion-date">Date Started <span class="input-required">*</span></label>
                            <div style="max-width: 280px !important; display:flex; flex-direction:row; justify-content: space-between">
                                <select name="edit-month-started" id="edit-month-started" class="transform-text edu-mod-date-m form-select form-select-sm" style="margin-right: 10px;">
                                    <option value="Month" hidden>Month</option>
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
                                <select name="edit-year-started" id="edit-year-started" class="transform-text edu-mod-date-y form-select form-select-sm">
                                    <option value="Year" hidden>Year</option>
                                    <option value="2023">2023</option>
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
                        </div>
                        <div class="mb-4" id="edit-date-completed-group">
                            <label class="form-label" for="completion-date">Date Completed <span class="input-required">*</span></label>
                            <div style="max-width: 280px !important; display:flex; flex-direction:row; justify-content: space-between">
                                <select name="edit-month-completed" id="edit-month-completed" class="transform-text edu-mod-date-m form-select form-select-sm" style="margin-right: 10px;">
                                    <option value="Month" hidden>Month</option>
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
                                <select name="edit-year-completed" id="edit-year-completed" class="transform-text edu-mod-date-y form-select form-select-sm">
                                    <option value="Year" hidden>Year</option>
                                    <option value="2023">2023</option>
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
                        </div>
                    </div>
                    <div id="edit-step-3" class="steps hide">
                        <div class="mb-4" id="edit-course-studied-group">
                            <label class="form-label" for="course-studied">Course/Program of Study <span class="input-required">*</span></label>
                            <div class="edit-other-course-studied" style="display: none">
                                <input type="text" name="edit-other-course-studied" id="edit-other-course-studied" class="transform-text edu-mod-text form-control" placeholder="Enter course studied">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="edit-20eh29v1Tf" id="edit-20eh29v1Tf" value="1">
                    <input type="reset" name="edit-reset" id="edit-reset" style="display: none;">
                    <input type="hidden" name="edit-awaiting_result_value" id="edit-awaiting_result_value" value="0">
                    <input type="submit" id="submit-edit-education-form" style="display: none">
                </form>
            </div>
            <div class="modal-footer" style="display: flex !important; flex-direction: row-reverse !important; justify-content: space-between !important;">
                <label for="submit-edit-education-form" class="btn btn-primary hide" id="edit-save-education-btn" style="width: 120px;">Save and Close</label>
                <button type="button" class="btn btn-primary" id="edit-nextStep">Next Step</button>
                <p>Step 1 of 4</p>
                <button type="button" class="btn btn-secondary hide" id="edit-prevStep">Prev. Step</button>
            </div>
        </div>
    </div>
</div>
<!--End of Modal-->