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
        <div class="field-header">
            <legend>Programmes</legend>
        </div>
        <div class="field-content">
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
        </div>
    </fieldset>

</form>