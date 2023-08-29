<?php
require_once('../../bootstrap.php');

use Src\Controller\UsersController;

use Src\Controller\ExposeDataController;

$data = new ExposeDataController();
$user = new UsersController();

$academic_BG = $user->fetchApplicantAcaB($user_id);
$uploads = $user->fetchUploadedDocs($user_id);
$appStatus = $user->getApplicationStatus($user_id);
?>

<fieldset class="fieldset row">
    <div class="col-md-4 col-sm-12">
        <legend>Academic Qualifications</legend>
    </div>
    <div class="col-md-8 col-sm-12">
        <div class="mb-4">
            <p>Upload <b>certified true copies</b> of certificates and transcripts related to the education information you provide in the education background section.</p>
            <p>For <b>Upgraders</b>, you are required to submit <b>Statement of Results</b> (SOR) from GMA as your transcript.</p>
        </div>
        <div class="mb-4">
            <!--<button type="button" id="attach-cert-btn" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addDocumentModal">Upload</button>-->

            <hr>

            <h5 style="font-size: 16px;" class="form-label mb-4 mt-4"><b>Certificates <span class="input-required">*</span></b></h5>

            <form id="certificate-upload-form" name="certificate-upload-form" method="POST" action="" enctype="multipart/form-data" class="mb-4">
                <div class="mb-4">
                    <input type="file" name="upload-file" id="certificate" accept=".pdf" class="form-control">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <input type="hidden" class="edu-mod-select form-select form-select-sm" name="doc-type" value="certificate">
            </form>

            <h5 style="font-size: 16px;" class="form-label mb-4"><b>List of uploaded certificate <span class="input-required">*</span></b></h5>

            <div class="certificates mb-4">
                <?php
                $certificates = $user->fetchUploadedDocsByType($user_id, 'certificate');
                if (!empty($certificates)) {
                ?>
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">DOCUMENT TYPE</th>
                                <th scope="col">DATE</th>
                                <th scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ind = 1;
                            foreach ($uploads as $cert) {
                                if (strtolower($cert["type"]) == "certificate") {
                            ?>
                                    <tr>
                                        <th scope="row"><?= $ind ?></th>
                                        <td><?= ucwords(strtoupper($cert["type"])) ?></td>
                                        <td><?= ucwords(strtolower($cert["updated_at"])) ?></td>
                                        <td> <button type="button" style="cursor: pointer;" class="btn btn-danger btn-sm delete-file" id="tran-delete-<?= $cert["id"] ?>" title="Delete"><span class="bi bi-trash"></span></button></td>
                                    </tr>
                            <?php
                                    $ind += 1;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                } else {
                ?>
                    <p>No document</p>
                <?php
                }
                ?>
            </div>

            <hr>

            <h5 style="font-size: 16px;" class="form-label mb-4 mt-4"><b>Transcripts <span class="input-required">*</span></b></h5>

            <form id="transcript-upload-form" name="transcript-upload-form" method="POST" action="" enctype="multipart/form-data" class="mb-4">
                <div class="mb-4">
                    <input type="file" name="upload-file" id="transcript" accept=".pdf" class="form-control">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <input type="hidden" class="edu-mod-select form-select form-select-sm" name="doc-type" value="transcript">
            </form>

            <h5 style="font-size: 16px;" class="form-label mb-4"><b>List of uploaded transcript <span class="input-required">*</span></b></h5>

            <div class="certificates mb-4">
                <?php
                $transcripts = $user->fetchUploadedDocsByType($user_id, 'transcript');
                if (!empty($transcripts)) {
                ?>
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">S/N</th>
                                <th scope="col">DOCUMENT TYPE</th>
                                <th scope="col">DATE</th>
                                <th scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $ind = 1;
                            foreach ($uploads as $cert) {
                                if (strtolower($cert["type"]) == "transcript") {
                            ?>
                                    <tr>
                                        <th scope="row"><?= $ind ?></th>
                                        <td><?= ucwords(strtoupper($cert["type"])) ?></td>
                                        <td><?= ucwords(strtolower($cert["updated_at"])) ?></td>
                                        <td> <button type="button" style="cursor: pointer;" class="btn btn-danger btn-sm delete-file" id="tran-delete-<?= $cert["id"] ?>" title="Delete"><span class="bi bi-trash"></span></button></td>
                                    </tr>
                            <?php
                                    $ind += 1;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                } else {
                ?>
                    <p>No document</p>
                <?php
                }
                ?>
            </div>
        </div>
        <p><b><span style=" color: brown">Allowed file type:</span></b> PDF</p>
    </div>
</fieldset>

<?php
$progName = $user->fetchApplicantProgI($user_id)[0]["first_prog"];
if (!$progName) {
?>
    <p style="color: red;">You will have to choose a programme from the <b>Programme Information</b> section in other to validate this page or view additional information below</p>
    <?php
} else {
    $proInfo = $user->fetchAllFromProgramByName($progName);
    if (strtolower($proInfo[0]["program_code"]) == "msc") {

        $cv = $user->fetchUploadedDocsByType($user_id, 'cv');
        $sop = $user->fetchUploadedDocsByType($user_id, 'sop');
        $nid = $user->fetchUploadedDocsByType($user_id, 'nid');
        $recommendations = $user->fetchUploadedDocsByType($user_id, 'recommendation');
    ?>

        <fieldset class="fieldset row">
            <div class="col-md-4 col-sm-12">
                <legend>Curriculum Vitae (CV)</legend>
            </div>
            <div class="col-md-8 col-sm-12">
                <div class="mb-4">
                    <p>Upload a copy of your current CV.</p>
                </div>
                <div class="mb-4">

                    <?php if (empty($cv)) { ?>
                        <form id="cv-upload-form" name="cv-upload-form" method="POST" action="" enctype="multipart/form-data">
                            <div class="mb-4">
                                <input type="file" name="upload-file" id="cv-file" accept=".pdf" class="form-control">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            <input type="hidden" class="edu-mod-select form-select form-select-sm" name="doc-type" value="cv">
                        </form>
                    <?php } ?>

                    <?php if (!empty($cv)) { ?>
                        <div class="curriculum-vitae mb-4">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">DOCUMENT TYPE</th>
                                        <th scope="col">DATE UPLOADED</th>
                                        <th scope="col"> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= ucwords(strtoupper($cv[0]["type"])) ?></td>
                                        <td><?= ucwords(strtolower($cv[0]["updated_at"])) ?></td>
                                        <td> <button type="button" style="cursor: pointer;" class="btn btn-danger btn-sm delete-file" id="tran-delete-<?= $cv[0]["id"] ?>" title="Delete"><span class="bi bi-trash"></span></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
                <p><b><span style=" color: brown">Allowed file types:</span></b> PDF</p>
            </div>
        </fieldset>

        <fieldset class="fieldset row">
            <div class="col-md-4 col-sm-12">
                <legend>Recommendations</legend>
            </div>
            <div class="col-md-8 col-sm-12">
                <div class="mb-4">
                    <p>
                        This application process requires <b>two letters</b> of recommendation. We strongly prefer a letter from your current direct supervisor.
                        If you have very little to no professional work experience, you can use a recommender that you've worked with in a professional capacity, such as a thesis advisor.
                    </p>
                </div>
                <div class="mb-4">

                    <?php if (empty($recommendations) || (!empty($recommendations) && count($recommendations) < 2)) { ?>
                        <form id="recommend-upload-form" name="recommend-upload-form" method="POST" action="" enctype="multipart/form-data">
                            <div class="mb-4">
                                <input type="file" name="upload-file" id="recommend-file" accept=".pdf" class="form-control">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            <input type="hidden" class="edu-mod-select form-select form-select-sm" name="doc-type" value="recommendation">
                        </form>
                    <?php } ?>

                    <h5 style="font-size: 16px;" class="form-label mb-4 mt-4"><b>List of document <span class="input-required">*</span></b></h5>

                    <?php if (!empty($recommendations)) { ?>
                        <div class="recommendations">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">S/N</th>
                                        <th scope="col">DOCUMENT TYPE</th>
                                        <th scope="col">DATE</th>
                                        <th scope="col"> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ind = 1;
                                    foreach ($recommendations as $rec) {
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $ind ?></th>
                                            <td><?= ucwords(strtoupper($rec["type"])) ?></td>
                                            <td><?= ucwords(strtolower($rec["updated_at"])) ?></td>
                                            <td> <button type="button" style="cursor: pointer;" class="btn btn-danger btn-sm delete-file" id="tran-delete-<?= $rec["id"] ?>" title="Delete"><span class="bi bi-trash"></span></button></td>
                                        </tr>
                                    <?php
                                        $ind += 1;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
                <p><b><span style=" color: brown">Allowed file types:</span></b> PDF</p>
            </div>
        </fieldset>

        <fieldset class="fieldset row">
            <div class="col-md-4 col-sm-12">
                <legend>Personal Statement</legend>
            </div>
            <div class="col-md-8 col-sm-12">
                <div class="mb-4">
                    <p>Upload a copy of your Personal Statement (PS) or Statement of Purpose (SOP).</p>
                </div>
                <div class="mb-4">

                    <?php if (empty($sop)) { ?>
                        <form id="sop-upload-form" name="sop-upload-form" method="POST" action="" enctype="multipart/form-data">
                            <div class="mb-4">
                                <input type="file" name="upload-file" id="sop-file" accept=".pdf" class="form-control">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            <input type="hidden" class="edu-mod-select form-select form-select-sm" name="doc-type" value="sop">
                        </form>
                    <?php } ?>

                    <?php if (!empty($sop)) { ?>
                        <div class="curriculum-vitae mb-4">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">DOCUMENT TYPE</th>
                                        <th scope="col">DATE UPLOADED</th>
                                        <th scope="col"> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= ucwords(strtoupper($sop[0]["type"])) ?></td>
                                        <td><?= ucwords(strtolower($sop[0]["updated_at"])) ?></td>
                                        <td> <button type="button" style="cursor: pointer;" class="btn btn-danger btn-sm delete-file" id="tran-delete-<?= $sop[0]["id"] ?>" title="Delete"><span class="bi bi-trash"></span></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
                <p><b><span style=" color: brown">Allowed file types:</span></b> PDF</p>
            </div>
        </fieldset>

        <fieldset class="fieldset row">
            <div class="col-md-4 col-sm-12">
                <legend>National ID</legend>
            </div>
            <div class="col-md-8 col-sm-12">
                <div class="mb-4">
                    <p>Upload a scanned copy of any National ID of yours.</p>
                </div>
                <div class="mb-4">

                    <?php if (empty($nid)) { ?>
                        <form id="nid-upload-form" name="nid-upload-form" method="POST" action="" enctype="multipart/form-data">
                            <div class="mb-4">
                                <input type="file" name="upload-file" id="nid-file" accept=".pdf" class="form-control">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            <input type="hidden" class="edu-mod-select form-select form-select-sm" name="doc-type" value="nid">
                        </form>
                    <?php } ?>

                    <?php if (!empty($nid)) { ?>
                        <div class="national-id mb-4">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">DOCUMENT TYPE</th>
                                        <th scope="col">DATE UPLOADED</th>
                                        <th scope="col"> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= ucwords(strtoupper($nid[0]["type"])) ?></td>
                                        <td><?= ucwords(strtolower($nid[0]["updated_at"])) ?></td>
                                        <td> <button type="button" style="cursor: pointer;" class="btn btn-danger btn-sm delete-file" id="tran-delete-<?= $nid[0]["id"] ?>" title="Delete"><span class="bi bi-trash"></span></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
                <p><b><span style=" color: brown">Allowed file types:</span></b> PDF</p>
            </div>
        </fieldset>
<?php }
} ?>