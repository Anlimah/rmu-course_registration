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
            <p>Upload scanned copies of certificates related to the education information you provide in the education background section.</p>
        </div>
        <div class="mb-4">
            <button type="button" id="attach-cert-btn" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addDocumentModal">Upload</button>

            <h5 style="font-size: 16px;" class="form-label mb-4"><b>List of documents <span class="input-required">*</b></span></h5>

            <div class="certificates mb-4">
                <?php
                if (!empty($uploads)) {
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
                            ?>
                        </tbody>
                    </table>
                <?php
                }
                ?>
            </div>
        </div>
        <p><b><span style=" color: brown">Allowed file types:</span></b> PDF</p>
    </div>
</fieldset>