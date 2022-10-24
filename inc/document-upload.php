<!--image uploader-->
<div>
    <form id="picture-upload-form">
        <input type="file" class="hide" name="photo-upload" id="photo-upload" accept=".jpg, .png">
        <input type="submit" class="hide" id="sbmit__enetere">
        <input type="hidden" name="____entered___" id="____entered___">
    </form>
</div>

<!--Add document form modal-->
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