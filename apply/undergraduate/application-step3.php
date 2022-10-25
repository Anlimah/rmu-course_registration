<?php
session_start();
if (isset($_SESSION['ghAppLogin']) && $_SESSION['ghAppLogin'] == true) {
    if (!(isset($_SESSION["ghApplicant"]) && !empty($_SESSION['ghApplicant']))) {
        header('Location: ../../index.php?status=error&message=Invalid access!');
    }
} else {
    header('Location: ../../index.php?status=error&message=Invalid access!');
}

if (isset($_GET['logout'])) {
    unset($_SESSION['ghAppLogin']);
    unset($_SESSION['ghApplicant']);
    session_destroy();
    header('Location: ../../index.php');
}

$user_id = $_SESSION['ghApplicant'];

$page = array("id" => 3, "name" => "Programmes Information");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/css/main.css">
    <!--<link rel="stylesheet" href="../../assets/css/bootstrap.css">-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
    </style>
</head>

<body id="body">

    <?php require_once("../../inc/top-page-section.php") ?>

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <main>
                        <div id="page_info" style="margin-bottom: 0px !important;">
                            <h1 style="font-size: 40px; padding-bottom: 15px !important">Programmes Information</h1>
                            <div class="alert alert-danger text-danger hide" id="page_info_text" style="width: 100%; border: none !important">
                                <label class="text-danger">This form has errors:</label>
                                <p>Provide values for all <b>required *</b> fields in the form.</p>
                            </div>
                        </div>

                        <!-- Page form -->
                        <form class="needs-validation" id="appForm" name="4" method="POST" style="margin-top: 15px !important;" novalidate>
                            <?php require_once("forms/programmes-information.php") ?>

                            <!-- Bottom page navigation -->
                            <?php require_once("../../inc/bottom-page-section.php"); ?>
                        </form>


                    </main>
                </div>

                <!-- Right page navigation and help div -->
                <?php require_once("../../inc/right-page-section.php"); ?>

            </div>
        </div>
        <?php require_once('../../inc/app-page-footer.php') ?>
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

            $(".form-select-option").change("blur", function() {
                $.ajax({
                    type: "PUT",
                    url: "../../api/programmes",
                    data: {
                        what: this.name,
                        value: this.value,
                    },
                    success: function(result) {
                        console.log(result);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            $("#appForm").on("submit", function() {
                if (!incompleteForm) {
                    $.ajax({
                        type: "POST",
                        url: "../../api/validateForm/",
                        data: {
                            form: this.name,
                        },
                        success: function(result) {
                            console.log(result);
                            if (result.success) {
                                window.location.href = "application-step4.php";
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
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