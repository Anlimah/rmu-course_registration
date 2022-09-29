<?php
require_once('../../bootstrap.php');

use Src\Controller\UsersController;

use Src\Controller\ExposeDataController;

$data = new ExposeDataController();
$user = new UsersController();
//$program_info = $user->fetchApplicantProgI($user_id);
$academic_BG = $user->fetchApplicantAcaB($user_id);
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
            <p>Upload scanned copies of certificates related to the education information you provide in the education background section.</p>
            <p><b><span style=" color: brown">Allowed file types:</span></b> .pdf, .docx, .doc</p>
        </div>
        <div>
            <h5 style="font-size: 16px;" class="form-label"><b>Certificates <span class="input-required">*</b></span></h5>
            <div class="certificates mb-4"></div>
            <button type="button" id="attach-cert-btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDocumentModal">Upload</button>
        </div>
    </div>
</fieldset>

<?php
//if ($user->getApplicationType($_SESSION["ghApplicant"]) == 1) {
?>
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
            <button type="button" id="attach-tscript-btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDocumentModal">Upload</button>
        </div>
    </div>
</fieldset>
<?php
//}
?>

<div class="modal fade" id="addDocumentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class=" modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Upload <span class="doc-type">Certificate</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="doc-upload-form" name="doc-upload-form">
                <div class="modal-body">
                    <div class="mb-4" id="course-studied-group">
                        <label class="form-label" for="course-studied">Which of the education records you entered does this <span class="doc-type">certificate</span> applies to? <span class="input-required">*</span></label>
                        <select class="edu-mod-select form-select form-select-sm" name="user-doc" id="user-doc">
                            <option value="Select" hidden>Select</option>
                            <?php
                            if (!empty($academic_BG)) {
                                foreach ($academic_BG  as $academic) {
                            ?>
                                    <option value="<?= $academic["s_number"] ?>"><?= $academic["school_name"] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-4 upload-doc hide">
                        <p id="fileUploadSuccess"></p>
                        <label for="certificate" class="form-label upload-photo-label btn btn-primary">Upload <span class="doc-type">certificate</span></label>
                        <input type="file" name="certificate" id="certificate" style="display: none;">
                    </div>
                    <input type="hidden" name="20eh29v1Tf" id="20eh29v1Tf" value="1">
                    <input type="reset" name="reset" id="reset" style="display: none;">
                </div>
                <div class="modal-footer" style="display: flex !important; flex-direction: row-reverse !important; justify-content: space-between !important;">
                    <button type="submit" class="btn btn-primary" id="save-doc-btn" style="width: 120px;">Save and Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End of Modal-->