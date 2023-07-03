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

$page = array("id" => 2, "name" => "Education Background");
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
                            <h1>Education Background</h1>
                            <div class="alert alert-danger text-danger hide" id="page_info_text" style="width: 100%; border: none !important">
                                <label class="text-danger">This form is incomplete:</label>
                                <p id="data_info">Provide values for all <b>required *</b> fields in the form.</p>
                            </div>
                        </div>

                        <!-- Page form -->
                        <form class="needs-validation" id="appForm" name="2" method="#" novalidate>
                            <?php require_once("forms/education-background.php") ?>

                            <!-- Bottom page navigation -->
                            <?php require_once("../../inc/bottom-page-section.php"); ?>
                        </form>
                        <?php require_once("../../inc/education-bg.php") ?>
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

            $(".awaiting-result").click(function() {
                if ($('#awaiting-result-yes').is(':checked')) {
                    //$("#not-waiting").addClass("hide");
                    $("#not-waiting").slideUp(200);
                    $("#awaiting_result_value").attr("value", 1);
                }
                if ($('#awaiting-result-no').is(':checked')) {
                    //$("#not-waiting").removeClass("hide");
                    $("#not-waiting").slideDown(200);
                    $("#awaiting_result_value").attr("value", 0);
                }

                if ($('#edit-awaiting-result-yes').is(':checked')) {
                    //$("#edit-not-waiting").addClass("hide");
                    $("#edit-not-waiting").slideUp(200);
                    $("#edit-awaiting_result_value").attr("value", 1);
                }
                if ($('#edit-awaiting-result-no').is(':checked')) {
                    //$("#edit-not-waiting").removeClass("hide");
                    $("#edit-not-waiting").slideDown(200);
                    $("#edit-awaiting_result_value").attr("value", 0);
                }
            });

            $(".form-select").change("blur", function() {
                // For add education background
                if (this.id == "cert-type") {

                    var myArray = ['WASSCE', 'SSSCE', 'NECO', 'GBCE'];
                    let index = $.inArray(this.value, myArray);

                    if (index == -1) {
                        $("#course-studied").slideUp();
                        $("#course-studied option[value='OTHER']").attr('selected', 'selected');
                        $(".other-course-studied").slideDown();
                        $(".waec-course-content").slideUp();

                        if (this.value == "OTHER") $(".sepcific-cert").slideDown();

                        $("#awaiting-result-yes").attr("checked", "checked");
                        $("#awaiting-result-no").attr("checked", "");

                    } else {
                        $("#course-studied").slideDown();
                        $(".other-course-studied").slideUp();
                        $(".waec-course-content").slideDown();
                        $(".sepcific-cert").slideUp();

                        $("#awaiting-result-yes").attr("checked", "");
                        $("#awaiting-result-no").attr("checked", "checked");
                    }
                }

                if (this.id == "course-studied") {
                    if (this.value == "OTHER") {
                        $(".other-course-studied").slideDown(200);
                    } else {
                        $(".other-course-studied").slideUp(200);
                    }
                }

                // For edit education background
                if (this.id == "edit-cert-type") {
                    var myArray = ['WASSCE', 'SSSCE', 'NECO', 'GBCE'];
                    let index = $.inArray(this.value, myArray);

                    if (index == -1) {
                        $("#edit-course-studied").slideUp();
                        $("#edit-course-studied option[value='OTHER']").attr('selected', 'selected');
                        $(".edit-other-course-studied").slideDown();
                        $(".edit-waec-course-content").slideUp();

                        if (this.value == "OTHER") $(".edit-sepcific-cert").slideDown();

                        $("#edit-awaiting-result-yes").attr("checked", "checked");
                        $("#edit-awaiting-result-no").attr("checked", "");

                    } else {
                        $("#edit-course-studied").slideDown();
                        $(".edit-other-course-studied").slideUp();
                        $(".edit-waec-course-content").slideDown();
                        $(".edit-sepcific-cert").slideUp();

                        $("#edit-awaiting-result-yes").attr("checked", "");
                        $("#edit-awaiting-result-no").attr("checked", "checked");
                    }
                }

                if (this.id == "edit-course-studied") {
                    if (this.value == "OTHER") {
                        $(".edit-other-course-studied").slideDown(200);
                    } else {
                        $(".edit-other-course-studied").slideUp(200);
                    }
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

            $("#cert-type, #edit-cert-type").change("blur", function() {
                var myArray = ['WASSCE', 'SSSCE', 'NECO', 'GBCE'];
                let index = $.inArray(this.value, myArray);

                if (index == -1) return;

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
                let value = "technical";
                if (this.value != "TECHNICAL") value = "secondary";
                $.ajax({
                    type: "GET",
                    url: "../../api/elective-subjects",
                    data: {
                        value: value,
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