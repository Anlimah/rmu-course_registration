<?php
require_once('../../bootstrap.php');

use Src\Controller\UsersController;

use Src\Controller\ExposeDataController;

$data = new ExposeDataController();
$user = new UsersController();


?>
<form id="appForm" method="POST" style="margin-top: 50px !important;">
    <fieldset class="fieldset">
        <legend>Passport Picture</legend>
        <div class="field-content">
            <div class="form-fields" style="flex-grow: 8;">
                <div class="photo-upload-area">
                    <p style="font-size: 14px; color: brown">Please upload a passport size photo of yourself. The size of the image should not be more than 100KB. The background color of your image should be white.</p>
                    <p style="font-size: 14px; color: red"><b>NB: The image you use will not be changed. So use a most recent passport sized picture of yourself.</b></p>
                    <div class="photo-display"></div>
                    <label for="applicant-photo" class="upload-photo-label btn btn-primary">Upload photo</label>
                    <input class="form-control" type="file" style="display: none;" name="applicant-photo" id="applicant-photo">
                </div>
            </div>
        </div>

        <div class="photo-upload-area">
            <p style="font-size: 14px; color: brown">Upload a scanned PDF copy of your certificate and transcipts.</p>
            <label for="applicant-photo" class="upload-photo-label btn btn-default">Upload certificate <span class="input-required">*</span></label>
            <input class="form-control" type="file" name="applicant-photo" id="applicant-photo" style="display: none;">
        </div>
    </fieldset>
</form>