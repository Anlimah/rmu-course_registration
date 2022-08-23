<!-- Application progress tracker -->
<section class="col-3" style="margin-bottom: 400px;">

    <div class="container-sm" style=" display: flex; flex-direction: column;position: sticky; top: 10.7rem;">
        <fieldset class="fieldset" style="float:left; margin-top: 0px; max-width: 270px;min-width: 270px; width: 100%;">
            <legend style="width:100%; text-align: center; font-size: 20px; font-weight:700; margin-bottom:0px">Application Sections</legend>
            <span class="mb-5">In progress</span>
            <ul class="list-group mt-5" style="padding: 0 !important; margin: 0 important; font-size:medium; font-weight:500">
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
        </fieldset>

        <fieldset class="fieldset" style="display: flex; flex-direction: column; align-items:center; max-width: 270px; min-width: 270px;">
            <legend style="width:100%; text-align: center;">Need Help?</legend>
            <p style="width: 100%;">
                <span class="bi bi-telephone-fill"></span>
                <a href=" tel:+233302712775">+233302712775</a>
            </p>
            <p style="width: 100%;">
                <span class="bi bi-envelope-fill"></span>
                <a href="mailto:university.registrar@rmu.edu.gh">university.registrar@rmu.edu.gh</a>
            </p>
        </fieldset>

    </div>

</section>