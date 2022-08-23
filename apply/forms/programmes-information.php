<?php

use Src\Controller\UsersController;

use Src\Controller\ExposeDataController;

require_once("../src/Controller/ExposeDataController.php");
$data = new ExposeDataController();

require_once('../src/Controller/UsersController.php');
$user = new UsersController();
$personal_AB = $user->fetchApplicantProgI($user_id);
$personal_PU = $user->fetchApplicantPreUni($user_id);

?>

<form id="appForm" method="POST" style="margin-top: 50px !important;">
    <fieldset class="fieldset">
        <legend>Programmes</legend>
        <div class="mb-4">
            <label class="form-label" for="app-prog-first">First (1<sup>st</sup>) Choice <span class="input-required">*</span></label>
            <select class="form-select form-select-sm mb-3" name="app-prog-first" id="app-prog-first">
                <option hidden>Choose </option>
                <?php
                $programs = $data->getPrograms();
                foreach ($programs as $program) {
                    if ($personal_AB[0]["first_prog"] == $program['id']) {
                        echo '<option value="' . $program['id'] . '" selected>' . $program['name'] . '</option>';
                    } else {
                        echo '<option value="' . $program['id'] . '">' . $program['name'] . '</option>';
                    }
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
                    if ($personal_AB[0]["second_prog"] == $program['id']) {
                        echo '<option value="' . $program['id'] . '" selected>' . $program['name'] . '</option>';
                    } else {
                        echo '<option value="' . $program['id'] . '">' . $program['name'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
    </fieldset>

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
            <label for="prev-uni-completed-yes">
                <input type="radio" name="prev-uni-completed" id="prev-uni-completed-yes" style="margin-left: 20px;"> Yes
            </label>
            <label for="prev-uni-completed-no">
                <input type="radio" name="prev-uni-completed" id="prev-uni-completed-no" style="margin-left: 20px;"> No
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
    </fieldset>

</form>