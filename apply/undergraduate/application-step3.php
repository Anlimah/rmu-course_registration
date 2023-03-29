<?php
session_start();
if (isset($_SESSION['ghAppLogin']) && $_SESSION['ghAppLogin'] == true) {
    if (!(isset($_SESSION["ghApplicant"]) && !empty($_SESSION['ghApplicant']))) {
        header('Location: ../index.php');
    }
} else {
    header('Location: ../index.php');
}

if (isset($_GET['logout'])) {
    unset($_SESSION['ghAppLogin']);
    unset($_SESSION['ghApplicant']);
    session_destroy();
    header('Location: ../index.php');
}

$user_id = $_SESSION['ghApplicant'];

$page = array("id" => 3, "name" => "Programmes Information");
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
                            <h1 style="font-size: 40px; padding-bottom: 15px !important">Programme Information</h1>
                            <div class="alert alert-danger text-danger hide" id="page_info_text" style="width: 100%; border: none !important">
                                <label class="text-danger">This form has errors:</label>
                                <p>Provide values for all <b>required *</b> fields in the form.</p>
                            </div>
                        </div>

                        <!-- Page form -->
                        <form class="needs-validation" id="appForm" name="3" method="POST" style="margin-top: 15px !important;" novalidate>
                            <?php require_once("forms/programmes-information.php") ?>

                            <!-- Bottom page navigation -->
                            <?php require_once("../../inc/bottom-page-section.php"); ?>
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

            $(".form-control").change("blur", function() {
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

            $(".form-select-option").change("blur", function() {
                var msg = "";
                if (this.name == "medium") {
                    if (this.value == "Social Media") {
                        msg = "(e.g. Facebook, LinkedIn, etc)"
                    }
                    if (this.value == "Print Media") {
                        msg = "(e.g. Daily Graphic, Ghanaian Times, etc)"
                    }
                    if (this.value == "Electronic Media - TV/Radio") {
                        msg = "(e.g. GTV, TV3, Peace FM, Joy FM etc)"
                    }
                    if (this.value == "Outreach Program / Career Fair") {
                        msg = "where"
                    }
                    if (this.value == "Other") {
                        msg = " "
                    }
                }
                $.ajax({
                    type: "PUT",
                    url: "../../api/programmes",
                    data: {
                        what: this.name,
                        value: this.value,
                    },
                    success: function(result) {
                        console.log(result);
                        if (msg != "") {
                            $("#state-where").text(msg);
                            $("#medium-desc").removeClass("hide");
                            $("#medium-desc").addClass("display");
                        } else {
                            $("#medium-desc").removeClass("display");
                            $("#medium-desc").addClass("hide");
                        }
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