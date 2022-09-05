<?php
require_once("../../inc/head-section.php");
$page = array("id" => -1, "name" => "Personal Information");
?>

<body>

    <?php require_once("../../inc/top-page-section.php") ?>

    <div class="container-fluid" style="width: 100%; margin: 0; padding: 0;">
        <div class="main-content">
            <div class="container">
                <div class="row">
                    <div class="col-9">
                        <main>
                            <div class="page_info" style="margin-bottom: 30px !important;">
                                <h1 style="font-size: 40px; padding-bottom: 15px !important; font-weight: 700;">Welcome to your application</h1>
                            </div>

                            <hr>

                            <div style="margin-top: 50px !important">
                                <p style="margin-bottom: 50px !important">
                                    This is your dedicated application space. All of your progress will be saved automatically as you go, making it easy for you to access and update it as needed. You can return to your application to make changes to sections that have been saved or begin work on new sections.
                                    For applicants applying for posgraduate programmes or degree programs with diploma certificates, you may need to request transcripts from any colleges you’ve attended, as well as letters of recommendation from professional and/or academic references. Please note that these materials take time to process and should be requested as soon as possible.
                                </p>
                                <div class="fieldset" style="display: flex !important; flex-direction:column !important; justify-content:space-between;padding-bottom: 0 !important;margin-bottom: 0 !important">
                                    <h2 style="font-weight: 700; font-size:16px; margin-bottom: 20px">Having trouble? Contact Regional Maritime University, admissions.</h2>
                                    <p style="display: flex !important; flex-direction:column !important; justify-content:space-between;">

                                        <a href="mailto:university.registrar@rmu.edu.gh">
                                            <span class="bi bi-envelope-fill"> university.registrar@rmu.edu.gh</span>
                                        </a>
                                        <a href=" tel:+233302712775">
                                            <span class="bi bi-telephone-fill"> +233302712775</span>
                                        </a>
                                    </p>
                                </div>
                                <div class="page-control" style="margin-top:5px !important; display: flex; flex-direction: row-reverse; padding: 0; margin: 0;">
                                    <a style="width: 150px; padding: 5px 10px !important;" href="application-step0.php" id="prevPage" class="m-3 btn btn-primary text-white">Begin Application</a>
                                </div>
                            </div>
                        </main>
                    </div>

                    <!-- Right page navigation and help div -->
                    <?php require_once("../../inc/right-page-section.php"); ?>

                </div>
            </div>
            <?php require_once('../../inc/app-page-footer.php') ?>
        </div>
    </div>
</body>

</html>