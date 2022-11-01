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

<fieldset class="fieldset">
    <div class="field-header">
        <legend>Programmes</legend>
    </div>
    <div class="field-content">
        <div class="mb-4">
            <label class="form-label" for="medium">How did you hear about this program? (Optional)</label>
            <select class="form-select-option form-select form-select-sm mb-3" name="medium" id="medium">
                <option value="" hidden>Select</option>
                <option value="Social Media" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == strtoupper("Social Media") ? "selected" : "" ?>>Social Media</option>
                <option value="Graphics" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == strtoupper("Graphics") ? "selected" : "" ?>>Graphics</option>
                <option value="Surfing the Internet" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == strtoupper("Surfing the Internet") ? "selected" : "" ?>>Surfing the Internet</option>
                <option value="School Counselor" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == strtoupper("School Counselor") ? "selected" : "" ?>>School Counselor</option>
                <option value="Magazine" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == strtoupper("Magazine") ? "selected" : "" ?>>Magazine</option>
                <option value="Poster" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == strtoupper("Poster") ? "selected" : "" ?>>Poster</option>
                <option value="RMU Student" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == strtoupper("RMU Student") ? "selected" : "" ?>>RMU Student</option>
                <option value="RMU Brochure" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == strtoupper("RMU Brochure") ? "selected" : "" ?>>RMU Brochure</option>
                <option value="Family Member" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == strtoupper("Family Member") ? "selected" : "" ?>>Family Member</option>
                <option value="Other" <?= !empty($about_us[0]["medium"]) && $about_us[0]["medium"] == strtoupper("Other") ? "selected" : "" ?>>Other</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="form-label" for="app-prog-first">First (1<sup>st</sup>) Choice <span class="input-required">*</span></label>
            <select required class="form-select-option form-select form-select-sm mb-3" name="app-prog-first" id="app-prog-first">
                <option hidden value="">Choose </option>
                <?php
                $programs = $data->getPrograms(2);
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
            <select required class="form-select-option form-select form-select-sm mb-3" name="app-prog-second" id="app-prog-second">
                <option hidden value="">Choose </option>
                <?php
                $programs = $data->getPrograms(2);
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