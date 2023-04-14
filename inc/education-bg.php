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
                                <option value="WASSCE">WASSCE</option>
                                <option value="SSSCE">SSSCE</option>
                                <option value="GBCE">GBCE</option>
                                <option value="NECO">NECO</option>
                                <option value="DIPLOMA">DIPLOMA</option>
                                <option value="DEGREE">DEGREE</option>
                                <option value="BACCALAUREATE">BACCALAUREATE</option>
                                <option value="O LEVEL">O LEVEL</option>
                                <option value="A LEVEL">A LEVEL</option>
                                <option value="OTHER">OTHER</option>
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
                    <div id="step-3" class="steps hide">
                        <div class="mb-4" id="course-studied-group">
                            <label class="form-label" for="course-studied">Course or program of Study <span class="input-required">*</span></label>
                            <select class="mb-4 edu-mod-select form-select form-select-sm" name="course-studied" id="course-studied">
                                <option value="Select" hidden>Select</option>
                                <?php
                                foreach ($courses as $course) {
                                ?>
                                    <option value="<?= $course["course"] ?>"><?= $course["course"] ?></option>
                                <?php
                                }
                                ?>
                                <option value="OTHER">OTHER</option>
                            </select>
                            <div class="other-course-studied" style="display: none">
                                <input type="text" name="other-course-studied" id="other-course-studied" class="edu-mod-text form-control" placeholder="Enter course studied">
                            </div>
                        </div>
                        <div class="waec-course-content">
                            <div class="mb4">
                                <label class="form-label" for="awaiting-cert">Are you waiting for exam result ? <span class="input-required">*</span></label>
                                <label for="awaiting-result-yes" class="form-label radio-btn">
                                    <input class="awaiting-result" style="margin: 0 !important; padding: 0 !important;" type="radio" name="awaiting-result" id="awaiting-result-yes" value="Yes"> Yes
                                </label>
                                <label for="awaiting-result-no" class="form-label radio-btn">
                                    <input class="awaiting-result" style="margin: 0 !important; padding: 0 !important;" type="radio" name="awaiting-result" id="awaiting-result-no" value="No" checked> No
                                </label>
                            </div>
                            <div id="not-waiting" class="">
                                <div class="mb-4 mt-4" id="core-subjects">
                                    <label class="form-label">Core Subjects <span class="input-required">*</span></label>
                                    <?php
                                    $core_sbjs = $user->fetchSubjects("core");
                                    $i = 0;
                                    foreach ($core_sbjs as $core_sbj) {
                                    ?>
                                        <div id="core-sbj<?= ($i + 1) ?>-group" class="mb-2">
                                            <div style="display:flex !important; flex-direction:row !important; justify-content: space-between !important">
                                                <input style="margin-right: 10px; width: 75%" class="form-control" type="text" name="core-sbj<?= ($i + 1) ?>" id="core-sbj<?= ($i + 1) ?>" value="<?= $core_sbj["subject"] ?>" disabled>
                                                <select style="width: 25%" class="edu-mod-grade form-select form-select-sm subject-grade" name="core-sbj-grd<?= ($i + 1) ?>" id="core-sbj-grd<?= ($i + 1) ?>">
                                                    <option value="Grade" hidden>Grade</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </div>
                                <div class="mb-4" id="elective-subjects">
                                    <label class="form-label">Elective Subjects <span class="input-required">*</span></label>
                                    <?php
                                    for ($i = 0; $i < 4; $i++) {
                                    ?>
                                        <div id="elective-sbj<?= ($i + 1) ?>-group" class="mb-2">
                                            <div style="display:flex !important; flex-direction:row !important; justify-content: space-between !important">
                                                <select style="margin-right: 10px; width: 75%" class="edu-mod-select elective-subjects form-select form-select-sm" name="elective-sbj<?= ($i + 1) ?>" id="elective-sbj<?= ($i + 1) ?>">
                                                    <option value="Select" hidden>Select</option>
                                                </select>
                                                <select style="width: 25%" class="edu-mod-grade form-select form-select-sm" name="elective-sbj-grd<?= ($i + 1) ?>" id="elective-sbj-grd<?= ($i + 1) ?>">
                                                    <option value="Grade" hidden>Grade</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
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
                            <label class="form-label" for="sch-name">School Name <span class="input-required">*</span></label>
                            <input placeholder="School" class="transform-text edu-mod-text form-control" type="text" name="edit-sch-name" id="edit-sch-name">
                        </div>
                        <div class="mb-4" id="edit-sch-country-group">
                            <label class="form-label" for="sch-country">School Country <span class="input-required">*</span></label>
                            <input placeholder="Country" class="transform-text edu-mod-text form-control" type="text" name="edit-sch-country" id="edit-sch-country">
                        </div>
                        <div class="mb-4" id="edit-sch-region-group">
                            <label class="form-label" for="sch-region">School Province/Region <span class="input-required">*</span></label>
                            <input placeholder="Province/Region" class="transform-text edu-mod-text form-control" type="text" name="edit-sch-region" id="edit-sch-region">
                        </div>
                        <div class="mb-4" id="edit-sch-city-group">
                            <label class="form-label" for="sch-city">School City <span class="input-required">*</span></label>
                            <input placeholder="City" class="transform-text edu-mod-text form-control" type="text" name="edit-sch-city" id="edit-sch-city">
                        </div>
                    </div>
                    <div id="edit-step-2" class="steps hide">
                        <div class="mb-4" id="edit-cert-type-group">
                            <label class="form-label" for="edit-cert-type">Certificate or degree earned <span class="input-required">*</span></label>
                            <select class="transform-text edu-mod-select form-select form-select-sm" name="edit-cert-type" id="edit-cert-type">
                                <option value="Select" hidden>Select</option>
                                <option value="WASSCE">WASSCE</option>
                                <option value="SSSCE">SSSCE</option>
                                <option value="GBCE">GBCE</option>
                                <option value="NECO">NECO</option>
                                <option value="DIPLOMA">DIPLOMA</option>
                                <option value="DEGREE">DEGREE</option>
                                <option value="BACCALAUREATE">BACCALAUREATE</option>
                                <option value="O LEVEL">O LEVEL</option>
                                <option value="A LEVEL">A LEVEL</option>
                                <option value="OTHER">OTHER</option>
                            </select>
                            <div class="div-container mt-4 edit-sepcific-cert" style="display: none">
                                <label class="form-label" for="edit-other-cert-type"> Specify the certificate name <span class="input-required">*</span></label>
                                <input type="text" id="edit-other-cert-type" name="edit-other-cert-type" class="transform-text edu-mod-text form-control" placeholder="Input certificate">
                            </div>
                        </div>
                        <div class="mb-4" id="edit-index-number-group">
                            <label class="form-label" for="index-number">Index Number <span class="input-required">*</span></label>
                            <input placeholder="Index Number" class="transform-text edu-mod-text form-control" type="text" name="edit-index-number" id="edit-index-number" placeholder="Index Number">
                        </div>
                        <div class="mb-4" id="edit-date-started-group">
                            <label class="form-label" for="completion-date">Date Started <span class="input-required">*</span></label>
                            <div style="max-width: 280px !important; display:flex; flex-direction:row; justify-content: space-between">
                                <select class="transform-text edu-mod-date-m form-select form-select-sm" style="margin-right: 10px;" name="edit-month-started" id="edit-month-started">
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
                                <select class="transform-text edu-mod-date-y form-select form-select-sm" name="edit-year-started" id="edit-year-started">
                                    <option value="Year" hidden>Year</option>
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
                                <select class="transform-text edu-mod-date-m form-select form-select-sm" style="margin-right: 10px;" name="edit-month-completed" id="edit-month-completed">
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
                                <select class="transform-text edu-mod-date-y form-select form-select-sm" name="edit-year-completed" id="edit-year-completed">
                                    <option value="Year" hidden>Year</option>
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
                            <select class="transform-text edu-mod-select form-select form-select-sm" name="edit-course-studied" id="edit-course-studied">
                                <option value="Select" hidden>Select</option>
                                <?php
                                foreach ($courses as $course) {
                                ?>
                                    <option value="<?= $course["course"] ?>"><?= $course["course"] ?></option>
                                <?php
                                }
                                ?>
                                <option value="OTHER">OTHER</option>
                            </select>
                            <div class="edit-other-course-studied" style="display: none">
                                <input type="text" name="edit-other-course-studied" id="edit-other-course-studied" class="transform-text edu-mod-text form-control" placeholder="Enter course studied">
                            </div>
                        </div>
                        <div class="edit-waec-course-content">
                            <div class="mb4">
                                <label class="form-label" for="awaiting-cert">Are you waiting for exam result ? <span class="input-required">*</span></label>
                                <label for="edit-awaiting-result-yes" class="form-label radio-btn">
                                    <input class="awaiting-result" style="margin: 0 !important; padding: 0 !important;" type="radio" name="edit-awaiting-result" id="edit-awaiting-result-yes" value="Yes"> Yes
                                </label>
                                <label for="edit-awaiting-result-no" class="form-label radio-btn">
                                    <input class="awaiting-result" style="margin: 0 !important; padding: 0 !important;" type="radio" name="edit-awaiting-result" id="edit-awaiting-result-no" value="No" checked> No
                                </label>
                            </div>
                            <div id="edit-not-waiting" class="">
                                <div class="mb-4" id="edit-core-subjects">
                                    <label class="form-label">Core Subjects <span class="input-required">*</span></label>
                                    <?php
                                    for ($i = 0; $i < count(SHSCOURSES["subjects"]["core"]); $i++) {
                                    ?>
                                        <div id="edit-core-sbj<?= ($i + 1) ?>-group" class="mb-2">
                                            <div style="display:flex !important; flex-direction:row !important; justify-content: space-between !important">
                                                <input name="edit-core-sbj<?= ($i + 1) ?>" id="edit-core-sbj<?= ($i + 1) ?>" value="<?= SHSCOURSES["subjects"]["core"][$i] ?>" style="margin-right: 10px; width: 75%" class="form-control" type="text" disabled>
                                                <select name="edit-core-sbj-grd<?= ($i + 1) ?>" id="edit-core-sbj-grd<?= ($i + 1) ?>" style="width: 25%" class="edu-mod-grade form-select form-select-sm subject-grade">
                                                    <option value="Grade" hidden>Grade</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="mb-4" id="edit-elective-subjects">
                                    <label class="form-label">Elective Subjects <span class="input-required">*</span></label>
                                    <?php
                                    for ($i = 0; $i < 4; $i++) {
                                    ?>
                                        <div id="edit-elective-sbj<?= ($i + 1) ?>-group" class="mb-2">
                                            <div style="display:flex !important; flex-direction:row !important; justify-content: space-between !important">
                                                <select name="edit-elective-sbj<?= ($i + 1) ?>" id="edit-elective-sbj<?= ($i + 1) ?>" style="margin-right: 10px; width: 75%" class="edu-mod-select elective-subjects form-select form-select-sm">
                                                    <option value="Select" hidden>Select</option>
                                                    <?php
                                                    for ($j = 0; $j < count(SHSCOURSES["subjects"]["electives"]); $j++) {
                                                    ?>
                                                        <option value="<?= SHSCOURSES["subjects"]["electives"][$j] ?>"><?= SHSCOURSES["subjects"]["electives"][$j] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <select name="edit-elective-sbj-grd<?= ($i + 1) ?>" id="edit-elective-sbj-grd<?= ($i + 1) ?>" style="width: 25%" class="edu-mod-grade form-select form-select-sm subject-grade">
                                                    <option value="Grade" hidden>Grade</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                </div>
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