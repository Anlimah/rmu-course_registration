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
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
    </style>
</head>

<body>

    <?php require_once("../../inc/top-page-section.php") ?>

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <main>
                        <div class="page_info" style="margin-bottom: 0px !important;">
                            <h1 style="font-size: 40px; padding-bottom: 15px !important">Education Background</h1>
                        </div>

                        <!-- Page form -->
                        <!--<form id="appForm" method="#" style="margin-top: 15px !important;">-->
                        <?php require_once("forms/education-background.php") ?>

                        <!-- Bottom page navigation -->
                        <?php require_once("../../inc/bottom-page-section.php"); ?>
                        <!--</form>-->

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

        });
    </script>
    <script src="../../js/add-education-form.js"></script>
</body>

</html>