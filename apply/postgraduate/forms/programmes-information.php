<?php
require_once('../../bootstrap.php');

use Src\Controller\UsersController;

use Src\Controller\ExposeDataController;

$data = new ExposeDataController();
$user = new UsersController();
$personal_AB = $user->fetchApplicantProgI($user_id);
$personal_PU = $user->fetchApplicantPreUni($user_id);

?>

<form id="appForm" method="POST" style="margin-top: 50px !important;">
    <fieldset class="fieldset">
        <div class="field-header">
            <legend>Programmes</legend>
        </div>
        <div class="field-content">
            <div class="mb-4">
                <label class="form-label" for="app-prog-first">What programme are you applying for? <span class="input-required">*</span></label>
                <select class="form-select form-select-sm mb-3" name="app-prog-first" id="app-prog-first">
                    <option hidden>Choose </option>
                    <?php
                    $programs = $data->getPrograms(1);
                    foreach ($programs as $program) {
                        if ($personal_AB[0]["first_prog"] == $program['id']) {
                            echo '<option value="' . $program['id'] . '" selected>' . $program['name'] . '</option>';
                        } else {
                            echo '<option value="' . $program['id'] . '">' . $program['name'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label" for="hear-about-prog">How did you hear about this program? <span class="input-required">*</span></label>
                <select class="form-select form-select-sm mb-3" name="hear-about-prog" id="hear-about-prog">
                    <option hidden>Choose </option>
                    <optionvalue="Recruiter">Recruiter</option>
                        <option value="Internet">Internet</option>
                        <option value="School Counselor">School Counselor</option>
                        <option value="Magasine">Magazine</option>
                        <option value="School Faculty Member">School Faculty Member</option>
                        <option value="Poster">Poster</option>
                        <option value="RMU Student">RMU Student</option>
                        <option value="RMU Brochure">RMU Brochure</option>
                        <option value="Family Member">Family Member</option>
                        <option id="how-heard-about" value="Other" selected>Other</option>
                </select>
                <div class="mt-4 hide" id="other-heard">
                    <label class="form-label" for="other-hear-about-prog">From which source did you hear about this program? <span class="input-required">*</span></label>
                    <input type="text" class="form-control form-control-sm" id="other-hear-about-prog">
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label" for="disability">Have you previously been enrolled as an undergraduate at RMU? <span class="input-required">*</span></label>
                <div>
                    <label class="form-label radio-btn" for="was-undergrad-yes">
                        <input style="margin: 0 !important; padding: 0 !important;" class="english-native form-radio" type="radio" name="was-undergrad" id="was-undergrad-yes" value="1" <?= 0 == 1 ? "checked" : "" ?>> YES
                    </label>
                    <label class="form-label radio-btn" for="was-undergrad-no">
                        <input style="margin: 0 !important; padding: 0 !important;" class="english-native form-radio" type="radio" name="was-undergrad" id="was-undergrad-no" value="0" <?= 0 == 0 ? "checked" : "" ?>> NO
                    </label>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label" for="earn-grad-deg">Have you previously earned a graduate degree from RMU? <span class="input-required">*</span></label>
                <div>
                    <label class="form-label radio-btn" for="earn-grad-deg-yes">
                        <input style="margin: 0 !important; padding: 0 !important;" class="english-native form-radio" type="radio" name="earn-grad-deg" id="earn-grad-deg-yes" value="1" <?= 0 == 1 ? "checked" : "" ?>> YES
                    </label>
                    <label class="form-label radio-btn" for="earn-grad-deg-no">
                        <input style="margin: 0 !important; padding: 0 !important;" class="english-native form-radio" type="radio" name="earn-grad-deg" id="earn-grad-deg-no" value="0" <?= 0 == 0 ? "checked" : "" ?>> NO
                    </label>
                </div>
                <div class="mt">
                </div>
            </div>
        </div>
    </fieldset>

</form>