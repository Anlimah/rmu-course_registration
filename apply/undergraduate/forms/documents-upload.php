<?php
require_once('../../bootstrap.php');

use Src\Controller\UsersController;

use Src\Controller\ExposeDataController;

$data = new ExposeDataController();
$user = new UsersController();
//$program_info = $user->fetchApplicantProgI($user_id);
$academic_BG = $user->fetchApplicantAcaB($user_id);
$uploads = $user->fetchUploadedDocs($user_id);
$totalCertUploaded = $user->fetchTotalUploadByApp("Certificate", $user_id);
$totalTransUploaded = $user->fetchTotalUploadByApp("Transcript", $user_id);
$totalEduAdded = $user->fetchTotalEducationByApp($user_id);
?>
<fieldset class="fieldset">
    <div class="field-header">
        <legend>Passport Picture</legend>
    </div>
    <div class="field-content" style="display: flex !important; flex-direction: row !important; justify-content: space-between !important;">
        <div style="margin-right: 15px;">
            <p>Please upload a passport size photo of yourself. The size of the image should not be more than 100KB. The background color of your image should be white.</p>
            <p style="color: brown"><b>NB: The image you use will not be changed. So use a most recent passport sized picture of yourself.</b></p>

            <form id="picture-upload-form" method="post">
                <label for="photo-upload" class="upload-photo-label btn btn-primary">Upload photo</label>
                <input type="file" class="hide" name="photo-upload" id="photo-upload" accept=".jpg, .png">
                <input type="submit" class="hide" id="sbmit__enetere">
                <input type="hidden" name="____entered___" id="____entered___">
            </form>
        </div>
        <div class="photo-display" style="padding: 5px;">
            <img id="app-photo" src="" alt="" style="width: 100%;">
        </div>
    </div>
</fieldset>

<fieldset class="fieldset">
    <div class="field-header">
        <legend>Certificates</legend>
    </div>
    <div class="field-content">
        <div class="mb-4">
            <p>Upload scanned copies of certificates related to the education information you provide in the education background section.</p>
        </div>
        <div class="mb-4">
            <h5 style="font-size: 16px;" class="form-label mb-4"><b>Certificates <span class="input-required">*</b></span></h5>
            <div class="certificates mb-4">
                <?php
                if (!empty($uploads)) {
                    foreach ($uploads as $cert) {
                        if ($cert["type"] == "Certificate") {
                ?>
                            <div class="mb-4" style="max-width:400px; width:100%; border:1px solid #ccc;">
                                <div style="padding:2px 10px; background-color: #ccc;font-weight: 600; display: flex !important; flex-direction: row !important; justify-content: space-between !important;">
                                    <div>File uploaded for</div>
                                    <div style="cursor: pointer;" class="text-danger delete-file" id="cert-delete-<?= $cert["edu_code"] ?>">Delete</div>
                                </div>
                                <div style="font-weight: 600; padding:7px 10px; display: flex !important; flex-direction: row !important; justify-content: space-between !important;">
                                    <span class="text-primary"><?= ucwords(strtolower($cert["school_name"])) ?></span>
                                    <span><?= $cert["updated_at"] ?></span>
                                </div>
                            </div>
                <?php
                        }
                    }
                }
                ?>

            </div>
            <?php
            if ($totalCertUploaded[0]["total"] < $totalEduAdded[0]["total_edu"]) {
            ?>
                <button type="button" id="attach-cert-btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDocumentModal">Upload</button>
            <?php
            }
            ?>
        </div>
        <p><b><span style=" color: brown">Allowed file types:</span></b> .pdf, .docx, .doc</p>
    </div>
</fieldset>

<?php
if ($user->getApplicationType($_SESSION["ghApplicant"]) == 1) {
?>
    <fieldset class="fieldset">
        <div class="field-header">
            <legend>Transcripts</legend>
        </div>
        <div class="field-content">
            <div class="mb-4">
                <p>Upload scanned copies of transcipts related to the education information you provide in the education background section.</p>
            </div>
            <div class="mb-4">
                <h5 style="font-size: 16px;"><b>Transcripts <span class="input-required">*</span></b></h5>
                <div class="transcripts mb-4">
                    <?php
                    if (!empty($uploads)) {
                        foreach ($uploads as $tscript) {
                            if ($tscript["type"] == "Transcript") {
                    ?>
                                <div class="mb-4" style="max-width:400px; width:100%; border:1px solid #ccc;">
                                    <div style="padding:2px 10px; background-color: #ccc;font-weight: 600; display: flex !important; flex-direction: row !important; justify-content: space-between !important;">
                                        <div>File uploaded for</div>
                                        <div style="cursor: pointer;" class="text-danger delete-file" id="tran-delete-<?= $tscript["edu_code"] ?>">Delete</div>
                                    </div>
                                    <div style="font-weight: 600; padding:7px 10px; display: flex !important; flex-direction: row !important; justify-content: space-between !important;">
                                        <span class="text-primary"><?= ucwords(strtolower($tscript["school_name"])) ?></span>
                                        <span><?= $tscript["updated_at"] ?></span>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    }
                    ?>
                </div>
                <?php
                if ($totalTransUploaded[0]["total"] < $totalEduAdded[0]["total_edu"]) {
                ?>
                    <button type="button" id="attach-tscript-btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDocumentModal">Upload</button>
                <?php
                }
                ?>
            </div>
            <p><b><span style="color: brown">Allowed file types:</span></b> .pdf, .docx, .doc</p>
        </div>
    </fieldset>
<?php
}
?>

<div class="modal fade" id="addDocumentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-2" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class=" modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Upload <span class="doc-type">Certificate</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="doc-upload-form" name="doc-upload-form" method="POST" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-4" id="course-studied-group">
                        <label class="form-label" for="course-studied">Which of the education records you entered does this <span class="doc-type">certificate</span> applies to? <span class="input-required">*</span></label>
                        <select class="edu-mod-select form-select form-select-sm" name="user-doc" id="user-doc">
                            <option value="Select" hidden>Select</option>
                            <?php
                            if (!empty($academic_BG)) {
                                foreach ($academic_BG  as $academic) {
                            ?>
                                    <option value="<?= $academic["s_number"] ?>"><?= strtoupper($academic["school_name"]) ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="upload-doc hide">
                        <p id="fileUploadSuccess"></p>
                        <div style="display:flex !important; flex-direction:row !important; justify-content:baseline !important;">
                            <label for="upload-file" class="form-label upload-photo-label btn btn-warning">Choose file <span class="bi bi-upload" style="margin-left: 5px"></span></label>
                            <input type="file" name="upload-file" id="upload-file" class="hide" accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                            <p class="feedback" style="text-align: center; margin-left: 10px"></p>
                        </div>
                    </div>
                    <input type="hidden" name="20eh29v1Tf" id="20eh29v1Tf">
                    <input type="hidden" name="file-type" id="file-type">
                    <input type="reset" name="reset-upload" id="reset-upload" class="hide">
                </div>
                <div class="modal-footer" style="display: flex !important; flex-direction: row-reverse !important; justify-content: space-between !important;">
                    <button type="submit" class="btn btn-primary" id="save-doc-btn" style="width: 120px;">Save and Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End of Modal-->