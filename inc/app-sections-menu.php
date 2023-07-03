<div class="app-sections-menu">
    <span class="close-sections-menu bi bi-x-lg" title="Close menu"></span>
    <legend class="mb-4" style="width:100%; text-align: center; font-size: 20px; font-weight:600;">Application Sections</legend>
    <div class="flex-column justify-space-around" style="height:100%">

        <div style="margin-top: 15px; margin-bottom: 50px">
            <span style="font-size: small;">Status: In progress</span>
            <ul class="list-group mt-4 mb-4" style="padding: 5px 0 !important; margin: 0 important; font-size:medium; font-weight:500">
                <li class="list-group-item <?= (isset($appStatus[0]["personal"]) && $appStatus[0]["personal"] == 1) ? "form-checked" : "" ?>" style="padding-left: 0 !important; border: none !important; display:flex; flex-direction:row;justify-content:space-between">
                    <a href="application-step1.php" class="<?= $page["id"] == 1 ? "active" : "" ?>">Personal Information</a>
                </li>
                <li class="list-group-item <?= (isset($appStatus[0]["education"]) && $appStatus[0]["education"] == 1) ? "form-checked" : "" ?>" style="padding-left: 0 !important; border: none !important; display:flex; flex-direction:row;justify-content:space-between">
                    <a href="application-step2.php" class="<?= $page["id"] == 2 ? "active" : "" ?>">Education Background</a>
                </li>
                <li class="list-group-item <?= (isset($appStatus[0]["programme"]) && $appStatus[0]["programme"] == 1) ? "form-checked" : "" ?>" style="padding-left: 0 !important; border: none !important; display:flex; flex-direction:row;justify-content:space-between">
                    <a href="application-step3.php" class="<?= $page["id"] == 3 ? "active" : "" ?>">Programme Information</a>
                </li>
                <li class="list-group-item <?= (isset($appStatus[0]["uploads"]) && $appStatus[0]["uploads"] == 1) ? "form-checked" : "" ?>" style="padding-left: 0 !important; border: none !important; display:flex; flex-direction:row;justify-content:space-between">
                    <a href="application-step4.php" class="<?= $page["id"] == 4 ? "active" : "" ?>">Uploads</a>
                </li>
                <li class="list-group-item <?= (isset($appStatus[0]["declaration"]) && $appStatus[0]["declaration"] == 1) ? "form-checked" : "" ?>" style="padding-left: 0 !important; border: none !important; display:flex; flex-direction:row;justify-content:space-between">
                    <a href="application-step5.php" class="<?= $page["id"] == 5 ? "active" : "" ?>">Declaration</a>
                </li>
            </ul>
            <?php if ($page["id"] >= 0) { ?>
                <span style="font-size: small;" id="progressStatus">All progress saved.</span>
            <?php } ?>
        </div>

        <a class="flex-row justify-space-between btn btn-outline-primary" href="?logout=true" style="align-items:center; width:100%;">
            <span>Sign out</span>
            <span class="bi bi-power"></span>
        </a>
    </div>
</div>