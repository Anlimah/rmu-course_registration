<?php
require_once('../../bootstrap.php');

use Src\Controller\UsersController;

use Src\Controller\ExposeDataController;

$data = new ExposeDataController();
$user = new UsersController();


?>
<fieldset class="fieldset">
    <div class="field-header">
        <legend>Passport Picture</legend>
    </div>
    <div class="field-content" style="display: flex !important; flex-direction: row !important; justify-content: space-between !important;">
        <div style="margin-right: 15px;">
            <p>Please upload a passport size photo of yourself. The size of the image should not be more than 100KB. The background color of your image should be white.</p>
            <p style="color: brown"><b>NB: The image you use will not be changed. So use a most recent passport sized picture of yourself.</b></p>

            <label for="photo" class="upload-photo-label btn btn-primary">Upload photo</label>
            <input type="file" style="display: none;" name="photo" id="photo">
        </div>
        <div class="photo-display"></div>
    </div>
</fieldset>

<fieldset class="fieldset">
    <div class="field-header">
        <legend>Certificates</legend>
    </div>
    <div class="field-content">
        <div class="mb-4">
            <p ">Upload scanned copies of certificates related to the education information you provide in the education background section.</p>
            <p><b><span style=" color: brown">Allowed file types:</span></b> .pdf, .docx, .doc</p>
        </div>
        <div>
            <h5 style="font-size: 16px;" class="form-label"><b>Certificates <span class="input-required">*</b></span></h5>
            <div class="certificates mb-4"></div>
            <div></div>
            <label for="docs" class="form-label upload-photo-label btn btn-primary">Upload certificate</label>
            <input type="file" name="docs" id="docs" style="display: none;">
        </div>
    </div>
</fieldset>

<fieldset class="fieldset">
    <div class="field-header">
        <legend>Transcripts</legend>
    </div>
    <div class="field-content">
        <div class="mb-4">
            <p>Upload scanned copies of transcipts related to the education information you provide in the education background section.</p>
            <p><b><span style="color: brown">Allowed file types:</span></b> .pdf, .docx, .doc</p>
        </div>
        <div>
            <h5 style="font-size: 16px;"><b>Transcripts <span class="input-required">*</span></b></h5>
            <div class="transcripts mb-4"></div>
            <div></div>
            <label for="docs" class="form-label upload-photo-label btn btn-primary">Upload Transcript</label>
            <input type="file" name="docs" id="docs" style="display: none;">
        </div>
    </div>
</fieldset>