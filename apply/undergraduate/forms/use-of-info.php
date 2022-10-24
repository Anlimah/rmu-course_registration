<?php

require_once('../../bootstrap.php');

use Src\Controller\UsersController;

$user = new UsersController();
$appStatus = $user->getApplicationStatus($user_id);
require_once('../../inc/page-data.php');
?>

<fieldset class="fieldset">
    <legend>Use of Information Agreement</legend>
    <div class="field-content">
        <label class="form-label" for="use-of-info">Do you agree to the terms outlined? <span class="input-required">*</span></label>
        <select required class="form-select form-select-sm" name="use-of-info" id="use-of-info">
            <option value="" hidden>Select</option>
            <option value="1" <?= $appStatus[0]["use_of_info"] ? "selected" : "" ?>>Yes, I have read and understand the above information and wish to proceed with my application</option>
        </select>
    </div>
</fieldset>