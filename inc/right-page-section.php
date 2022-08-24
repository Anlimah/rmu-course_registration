<!-- Application progress tracker -->
<section class="col-3" style="margin-bottom: 110px;">
    <div class="container-sm" style="margin-top: 145px; display: flex; flex-direction: column; position: -webkit-sticky; position: sticky; top: 10.3rem;">
        <fieldset class="fieldset card" style="float:left; margin-top: 0px; max-width: 270px;min-width: 270px; width: 100%;">
            <legend style="width:100%; text-align: center; font-size: 20px; font-weight:700; margin-bottom:0px">Application Sections</legend>
            <span>In progress</span>
            <ul class="list-group mt-4 mb-4" style="padding: 10px 0 !important; margin: 0 important; font-size:medium; font-weight:500">
                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                    <a href="application-step0.php" class="<?= $page["id"] == 0 ? "active" : "" ?>">Use of Information</a>
                </li>
                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                    <a href="application-step1.php" class="<?= $page["id"] == 1 ? "active" : "" ?>">Personal Information</a>
                </li>
                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                    <a href="application-step2.php" class="<?= $page["id"] == 2 ? "active" : "" ?>">Education Background</a>
                </li>
                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                    <a href="application-step3.php" class="<?= $page["id"] == 3 ? "active" : "" ?>">Programme Information</a>
                </li>
                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                    <a href="application-step4.php" class="<?= $page["id"] == 4 ? "active" : "" ?>">Uploads</a>
                </li>
                <li class="list-group-item" style="padding-left: 0 !important; border: none !important;">
                    <a href="application-step5.php" class="<?= $page["id"] == 5 ? "active" : "" ?>">Declaration</a>
                </li>
            </ul>
            <span>All edit saved!</span>
        </fieldset>
    </div>
</section>