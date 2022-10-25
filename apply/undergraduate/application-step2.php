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

$page = array("id" => 2, "name" => "Education Background");
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
                            <h1 style="font-size: 40px; padding-bottom: 15px !important">Education Background</h1>
                            <div class="alert alert-danger text-danger hide" id="page_info_text" style="width: 100%; border: none !important">
                                <label class="text-danger">This form has errors:</label>
                                <p id="data_info">Provide values for all <b>required *</b> fields in the form.</p>
                            </div>
                        </div>

                        <!-- Page form -->
                        <form class="needs-validation" id="appForm" name="3" method="#" style="margin-top: 15px !important;" novalidate>
                            <?php require_once("forms/education-background.php") ?>

                            <!-- Bottom page navigation -->
                            <?php require_once("../../inc/bottom-page-section.php"); ?>
                        </form>
                        <?php require_once("../../inc/education-bg.php") ?>
                    </main>
                </div>

                <!-- Right page navigation and help div -->
                <?php require_once("../../inc/right-page-section.php"); ?>

            </div>
        </div>
        <?php require_once('../../inc/app-page-footer.php') ?>
    </div>

    <script src="../../js/jquery-3.6.0.min.js"></script>
    <!--<script src="../../js/myjs.js"></script>-->
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

            $(".prev-uni-rec").click(function() {
                if ($('#prev-uni-rec-yes').is(':checked')) {
                    $("#prev-uni-rec-list").removeClass("hide");
                } else if ($('#prev-uni-rec-no').is(':checked')) {
                    $("#prev-uni-rec-list").addClass("hide");
                }
            });
            $(".completed-prev-uni").click(function() {
                if ($('#completed-prev-uni-yes').is(':checked')) {
                    $("#date-completed-uni").removeClass("hide");
                    $("#uni-not-completed").addClass("hide");
                } else if ($('#completed-prev-uni-no').is(':checked')) {
                    $("#uni-not-completed").removeClass("hide");
                    $("#date-completed-uni").addClass("hide");
                }
            });

            $(".form-select-option").change("blur", function() {
                $.ajax({
                    type: "PUT",
                    url: "../../api/prev-uni-recs",
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

            $(".form-text-input").on("blur", function() {
                $.ajax({
                    type: "PUT",
                    url: "../../api/prev-uni-recs",
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

            $(".form-radio-btn").on("click", function() {

                const inputs = document.querySelectorAll('.required-field');
                const completed = document.querySelectorAll('.completed-uni');
                const not_completed = document.querySelectorAll('.not-completed-uni');

                if (this.id == "prev-uni-rec-yes") {
                    for (const input of inputs) {
                        input.setAttribute('required', '');
                    }
                } else if (this.id == "prev-uni-rec-no") {
                    for (const input of inputs) {
                        input.removeAttribute('required');
                    }
                    for (const inp of completed) {
                        inp.removeAttribute('required', '');
                    }
                    for (const inp of not_completed) {
                        inp.removeAttribute('required', '');
                    }
                }

                if (this.id == "completed-prev-uni-yes") {
                    for (const inp of completed) {
                        inp.setAttribute('required', '');
                    }
                    for (const inp of not_completed) {
                        inp.removeAttribute('required', '');
                    }
                } else if (this.id == "completed-prev-uni-no") {
                    for (const inp of completed) {
                        inp.removeAttribute('required', '');
                    }
                    for (const inp of not_completed) {
                        inp.setAttribute('required', '');
                    }
                }

                $.ajax({
                    type: "PUT",
                    url: "../../api/prev-uni-recs",
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

            $("#cert-type").change("blur", function() {
                $.ajax({
                    type: "GET",
                    url: "../../api/grades",
                    data: {
                        what: this.name,
                        value: this.value,
                    },
                    success: function(result) {
                        console.log(result);
                        $(".edu-mod-grade").html('<option value="Grade" hidden>Grade</option>');
                        $.each(result, function(index, value) {
                            $(".edu-mod-grade").append('<option value="' + value.grade + '">' + value.grade + '</option>');
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            $("#course-studied").change("blur", function() {
                $.ajax({
                    type: "GET",
                    url: "../../api/elective-subjects",
                    data: {
                        what: this.name,
                        value: this.value,
                    },
                    success: function(result) {
                        console.log(result);
                        $(".elective-subjects").html('<option value="Select" hidden>Select</option>');
                        $.each(result, function(index, value) {
                            $(".elective-subjects").append('<option value="' + value.subject + '">' + value.subject + '</option>');
                        });
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
                                window.location.href = "application-step3.php";
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
    <script src="../../js/add-education-form.js"></script>
</body>

</html>