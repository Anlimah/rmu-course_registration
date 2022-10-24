<?php
require_once('../../bootstrap.php');

use Src\Controller\UsersController;

use Src\Controller\ExposeDataController;

$data = new ExposeDataController();
$user = new UsersController();
$personal_AB = $user->fetchApplicantProgI($user_id);
$personal_PU = $user->fetchApplicantPreUni($user_id);
$appStatus = $user->getApplicationStatus($user_id);

?>

<fieldset class="fieldset">
    <div class="field-header">
        <legend>Programmes</legend>
    </div>
    <div class="field-content">
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
            <br>
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