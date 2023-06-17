<?php
require_once('../../bootstrap.php');

use Src\Controller\UsersController;

use Src\Controller\ExposeDataController;

$data = new ExposeDataController();
$user = new UsersController();
$personal_AB = $user->fetchApplicantProgI($user_id);
$personal_PU = $user->fetchApplicantPreUni($user_id);
$appStatus = $user->getApplicationStatus($user_id);
$about_us = $user->fetchHowYouKnowUs($user_id);
?>

<fieldset class="fieldset row">
    <div class="col-md-4 col-sm-12">
        <legend>Programme of Study</legend>
    </div>
    <div class="col-md-8 col-sm-12">
        <div class="mb-4">
            <label class="form-label" for="app-term">To what term are you applying? <span class="input-required">*</span></label>
            <select required name="app-term" id="app-term" class="transform-text form-select-option form-select form-select-sm mb-3">
                <option value="" hidden>Select</option>
                <option value="AUGUST" <?= $personal_AB[0]["application_term"] == strtoupper("AUGUST") ? "selected" : "" ?>>August Intake</option>
                <option value="JANUARY" <?= $personal_AB[0]["application_term"] == strtoupper("JANUARY") ? "selected" : "" ?>>January Intake</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="form-label" for="study-stream">Choose a study stream <span class="input-required">*</span></label>
            <select required name="study-stream" id="study-stream" class="transform-text form-select-option form-select form-select-sm mb-3">
                <option value="" hidden>Select</option>
                <option value="REGULAR" <?= $personal_AB[0]["study_stream"] == strtoupper("REGULAR") ? "selected" : "" ?>>Regular</option>
                <option value="WEEKEND" <?= $personal_AB[0]["study_stream"] == strtoupper("WEEKEND") ? "selected" : "" ?>>Weekend</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="form-label" for="medium">Where did you hear of RMU? (Optional)</label>
            <select name="medium" id="medium" class="transform-text form-select-option form-select form-select-sm mb-3">
                <option value="" hidden>Select</option>
                <option value="Social Media" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == "Social Media" ? "selected" : "" ?>>Social Media</option>
                <option value="Print Media" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == "Print Media" ? "selected" : "" ?>>Print Media</option>
                <option value="Electronic Media - TV/Radio" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == "Electronic Media - TV/Radio" ? "selected" : "" ?>>Electronic Media - TV/Radio</option>
                <option value="Outreach Program / Career Fair" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == "Outreach Program / Career Fair" ? "selected" : "" ?>>Outreach Program / Career Fair</option>
                <option value="Surfing the Internet" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == "Surfing the Internet" ? "selected" : "" ?>>Surfing the Internet</option>
                <option value="School Counselor" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == "School Counselor" ? "selected" : "" ?>>School Counselor</option>
                <option value="Magazine" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == "Magazine" ? "selected" : "" ?>>Magazine</option>
                <option value="Poster" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == "Poster" ? "selected" : "" ?>>Poster</option>
                <option value="RMU Student" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == "RMU Student" ? "selected" : "" ?>>RMU Student</option>
                <option value="RMU Brochure" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == "RMU Brochure" ? "selected" : "" ?>>RMU Brochure</option>
                <option value="Relative" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == "Relative" ? "selected" : "" ?>>Relative</option>
                <option value="Friend" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == "Friend" ? "selected" : "" ?>>Friend</option>
                <option value="Other" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == "Other" ? "selected" : "" ?>>Other</option>
            </select>
        </div>
        <div class="mb-4 <?= !empty($about_us[0]["description"]) ? "display" : "hide" ?> hide" id="medium-desc">
            <label class="form-label" for="medium-descript">Please state <span id="state-where"></span></label>
            <input name="medium-descript" id="medium-descript" class="transform-text form-control" type="text" value="<?= $about_us[0]["description"] ?>">
        </div>
        <div class="mb-4">
            <div class="div-container alert alert-info" role="alert">
                <h4 class="alert-heading">Attention!</h4>
                <p>Programmes, displayed below to choose, are based on the type of form you purchased.</p>
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label" for="app-prog-first">First (1<sup>st</sup>) Choice <span class="input-required">*</span></label>
            <select required name="app-prog-first" id="app-prog-first" class="transform-text form-select-option form-select form-select-sm mb-3">
                <option hidden value="">Choose </option>
                <?php
                $programs = $data->getPrograms($_SESSION['applicantType']);
                foreach ($programs as $program) {
                ?>
                    <option value="<?= strtoupper($program['name']) ?>" <?= $personal_AB[0]["first_prog"] == strtoupper($program['name']) ? "selected" : "" ?>><?= strtoupper($program['name']) ?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <div class="mb-4">
            <label class="form-label" for="app-prog-second"> Second (2<sup>nd</sup>) Choice <span class="input-required">*</span></label>
            <select required name="app-prog-second" id="app-prog-second" class="transform-text form-select-option form-select form-select-sm mb-3">
                <option hidden value="">Choose </option>
                <?php
                $programs = $data->getPrograms($_SESSION['applicantType']);
                foreach ($programs as $program) {
                ?>
                    <option value="<?= strtoupper($program['name']) ?>" <?= $personal_AB[0]["second_prog"] == strtoupper($program['name']) ? "selected" : "" ?>><?= strtoupper($program['name']) ?></option>
                <?php
                }
                ?>
            </select>
        </div>
    </div>
</fieldset>