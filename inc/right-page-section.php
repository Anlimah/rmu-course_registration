<!-- Application progress tracker -->
<section class="col-3" style="margin-bottom: 0px !important">
    <div class="container-sm" style="margin-top: 77px; display: flex; flex-direction: column; position: -webkit-sticky; position: sticky; top: 10.3rem;">
        <fieldset class="right-section card" style="float:left; margin-top: 0px; max-width: 270px;min-width: 270px; width: 100%;">
            <legend style="width:100%; text-align: center; font-size: 20px; font-weight:700; margin-bottom:0px">Application Sections</legend>
            <span style="font-size: small;">In progress</span>
            <ul class="list-group mt-4 mb-4" style="padding: 5px 0 !important; margin: 0 important; font-size:medium; font-weight:600">
                <li class="list-group-item <?= $appStatus[0]["use_of_info"] == 1 ? "form-checked" : "" ?>" style="padding-left: 0 !important; border: none !important; display:flex; flex-direction:row;justify-content:space-between">
                    <a href="application-step0.php" class="<?= $page["id"] == 0 ? "active" : "" ?>">Use of Information</a>
                </li>
                <li class="list-group-item <?= $appStatus[0]["personal"] == 1 ? "form-checked" : "" ?>" style="padding-left: 0 !important; border: none !important; display:flex; flex-direction:row;justify-content:space-between">
                    <a href="application-step1.php" class="<?= $page["id"] == 1 ? "active" : "" ?>">Personal Information</a>
                </li>
                <li class="list-group-item <?= $appStatus[0]["education"] == 1 ? "form-checked" : "" ?>" style="padding-left: 0 !important; border: none !important; display:flex; flex-direction:row;justify-content:space-between">
                    <a href="application-step2.php" class="<?= $page["id"] == 2 ? "active" : "" ?>">Education Background</a>
                </li>
                <li class="list-group-item <?= $appStatus[0]["programme"] == 1 ? "form-checked" : "" ?>" style="padding-left: 0 !important; border: none !important; display:flex; flex-direction:row;justify-content:space-between">
                    <a href="application-step3.php" class="<?= $page["id"] == 3 ? "active" : "" ?>">Programme Information</a>
                </li>
                <li class="list-group-item <?= $appStatus[0]["uploads"] == 1 ? "form-checked" : "" ?>" style="padding-left: 0 !important; border: none !important; display:flex; flex-direction:row;justify-content:space-between">
                    <a href="application-step4.php" class="<?= $page["id"] == 4 ? "active" : "" ?>">Uploads</a>
                </li>
                <li class="list-group-item <?= $appStatus[0]["declaration"] == 1 ? "form-checked" : "" ?>" style="padding-left: 0 !important; border: none !important; display:flex; flex-direction:row;justify-content:space-between">
                    <a href="application-step5.php" class="<?= $page["id"] == 5 ? "active" : "" ?>">Declaration</a>
                </li>
            </ul>
            <?php if ($page["id"] >= 0) { ?>
                <span style="font-size: small;" id="progressStatus">All progress saved.</span>
            <?php } ?>
        </fieldset>
    </div>
</section>