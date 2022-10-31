<?php
require_once('../../bootstrap.php');

use Src\Controller\UsersController;

use Src\Controller\ExposeDataController;

$data = new ExposeDataController();
$user = new UsersController();
$academic_BG = $user->fetchApplicantAcaB($user_id);
$uploads = $user->fetchUploadedDocs($user_id);
$appStatus = $user->getApplicationStatus($user_id);
$totalCertUploaded = $user->fetchTotalUploadByApp("Certificate", $user_id);
$totalTransUploaded = $user->fetchTotalUploadByApp("Transcript", $user_id);
$totalEduAdded = $user->fetchTotalEducationByApp($user_id);

?>

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


<fieldset class="fieldset">
    <div class="field-header">
        <legend>Other Qualifications</legend>
    </div>
    <div class="field-content">
        <div class="mb-4">
            <p>Upload scanned copies of other relevant qualifications.</p>
        </div>
        <div class="mb-4">
            <!--<h5 style="font-size: 16px;" class="form-label mb-4"><b>Certificates <span class="input-required">*</b></span></h5>-->
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