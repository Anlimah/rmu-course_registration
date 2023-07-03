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

$page = array("id" => 5, "name" => "Declaration");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $page["name"] ?></title>
    <link rel="stylesheet" href="../../assets/css/main.css">
    <?php require_once("../../inc/apply-head-section.php") ?>
</head>

<body id="body">

    <div id="wrapper">

        <?php require_once("../../inc/page-nav2.php") ?>

        <main class="container">
            <div class="row">

                <div class="col-md-8 ">
                    <section class="easy-apply">
                        <div id="page_info" style="margin-bottom: 0px !important;">
                            <h1>Declaration</h1>
                            <div class="alert alert-danger text-danger hide" id="page_info_text" style="width: 100%; border: none !important">
                                <label class="text-danger">This form is incomplete:</label>
                                <p id="data_info">Provide values for all <b>required *</b> fields in the form.</p>
                            </div>
                        </div>

                        <!-- Page form -->
                        <form class="needs-validation" id="appForm" name="5" method="POST" novalidate>
                            <?php require_once("forms/declaration.php") ?>

                        </form>
                    </section>
                </div>

                <div class="col-md-4 ">
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
    <script>
        $(document).ready(function() {
            var incompleteForm = false;
            var itsForm = false;
            (() => {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms = document.querySelectorAll('.needs-validation')

                // Loop over them and prevent submission
                Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                        event.preventDefault()
                        if (!form.checkValidity()) {
                            event.stopPropagation()
                            incompleteForm = true;
                            $("#page_info_text").removeClass("hide");
                            $("#page_info_text").addClass("display");
                            window.location.href = "#body";
                        } else {
                            incompleteForm = false;
                            itsForm = true;
                            $("#page_info_text").removeClass("display");
                            $("#page_info_text").addClass("hide");
                        }

                        form.classList.add('was-validated')
                    }, false)
                })

            })();

            $("#appForm").on("submit", function() {
                if (!incompleteForm) {
                    let advance = confirm("Are you sure you want to submit your application?");
                    if (advance) {
                        $.ajax({
                            type: "POST",
                            url: "../../api/validateForm/",
                            data: {
                                form: this.name,
                            },
                            success: function(result) {
                                console.log(result);
                                if (result.success) {
                                    window.location.href = "../application-status.php";
                                } else {
                                    $("#page_info_text").removeClass("hide");
                                    $("#page_info_text").addClass("display");
                                    $("#data_info").html("").append(result.message);
                                    window.location.href = "#body";
                                }
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    }
                }
            });

            $(document).on({
                ajaxStart: function() {
                    if (itsForm == true)
                        $("#submitBtn").prop("disabled", true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
                    else
                        $("#progressStatus").prop("disabled", true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving progress...');
                },
                ajaxStop: function() {
                    if (itsForm)
                        $("#submitBtn").prop("disabled", false).html('Check My Work and Continue');
                    else
                        $("#progressStatus").prop("disabled", false).html('All progress saved.');
                }
            });
        });
    </script>
</body>

</html>