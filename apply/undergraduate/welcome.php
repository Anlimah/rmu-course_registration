<?php
session_start();
if (isset($_SESSION['ghAppLogin']) && $_SESSION['ghAppLogin'] == true) {
    if (!isset($_SESSION['loginType']) || empty($_SESSION['loginType']) || ($_SESSION['loginType'] != "undergraduate/welcome.php"))
        echo '<script>window.location.href = "?logout=true"</script>';

    if (!(isset($_SESSION["ghApplicant"]) && !empty($_SESSION['ghApplicant'])))
        header('Location: ../index.php');
} else {
    header('Location: ../index.php');
}

if ($_SESSION["submitted"]) header('Location: ../application-status.php');

if (isset($_GET['logout'])) {
    unset($_SESSION['ghAppLogin']);
    unset($_SESSION['ghApplicant']);
    session_destroy();
    header('Location: ../index.php');
}

$user_id = isset($_SESSION['ghApplicant']) && !empty($_SESSION["ghApplicant"]) ? $_SESSION["ghApplicant"] : "";

$page = array("id" => 0, "name" => "Welcome");


require_once('../../bootstrap.php');

use Src\Controller\UsersController;

$user = new UsersController();
$appStatus = $user->getApplicationStatus($user_id);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Application | Welcome</title>
    <link rel="stylesheet" href="../../assets/css/main.css">
    <?php require_once("../../inc/apply-head-section.php") ?>
</head>

<body>

    <div id="wrapper">

        <?php require_once("../../inc/page-nav2.php") ?>

        <main class="container">
            <div class="row">

                <div class="col-md-8">
                    <section class="easy-apply">
                        <div class="page_info" style="margin-bottom: 0px !important;">
                            <h1>Welcome to your application</h1>
                        </div>

                        <div style="margin-top: 0px !important">
                            <div class="fieldset-col" style="margin-bottom: 0px !important; padding: 10px 0px !important">
                                <p>
                                    This is your dedicated application space. All of your progress will be saved automatically as you go, making it easy for you to access and update it as needed. You can return to your application to make changes to sections that have been saved or begin work on new sections.
                                </p>
                                <p> For applicants applying for posgraduate programmes or degree programs with diploma certificates, you may need to request transcripts from any colleges you’ve attended, as well as letters of recommendation from professional and/or academic references. Please note that these materials take time to process and should be requested as soon as possible.
                                </p>
                            </div>

                            <div class="contact-area" style="display: flex !important; flex-direction:column !important; justify-content:space-between;padding-bottom: 0 !important;margin-bottom: 0 !important">
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
                            <div class="page-control" style="margin-top:30px !important; display: flex; flex-direction: row-reverse; padding: 0; margin: 0;">
                                <a style="width: 150px; padding: 5px 10px !important;" href="application-step1.php" id="prevPage" class="btn btn-primary text-white">Begin Application</a>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="col-md-4">
                    <!-- Right page navigation and help div -->
                    <?php require_once("../../inc/right-page-section.php"); ?>
                </div>

            </div>
        </main>
        <?php require_once("../../inc/page-footer.php"); ?>

        <?php require_once("../../inc/app-sections-menu.php"); ?>
    </div>

    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script src="../../js/myjs.js"></script>
</body>

</html>