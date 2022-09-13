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

$page = array("id" => 1, "name" => "Personal Information");
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

<body>

    <?php require_once("../../inc/top-page-section.php") ?>

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-9">
                    <main>
                        <div class="page_info" style="margin-bottom: 30px !important;">
                            <h1 style="font-size: 40px; padding-bottom: 15px !important">Personal Information</h1>
                        </div>

                        <hr>

                        <!-- Page form -->
                        <form id="appForm" method="POST" style="margin-top: 50px !important;">
                            <?php require_once("forms/personal-information.php") ?>

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

            $(".disability").click(function() {
                if ($('#disability-yes').is(':checked')) {
                    $("#disability-list").removeClass("hide");
                } else if ($('#disability-no').is(':checked')) {
                    $("#disability-list").addClass("hide");
                }
            });

            $(".english-native").click(function() {
                if ($('#english-native-yes').is(':checked')) {
                    $("#english-native-list").addClass("hide");
                } else if ($('#english-native-no').is(':checked')) {
                    $("#english-native-list").removeClass("hide");
                }
            });

            $(".country-code").on(":change", function() {
                $(this).find("option:selected").text("+" + $(this).find("option:selected").text().match(/(\d+)/g));
            })

            $(".form-select").change("blur", function() {
                $.ajax({
                    type: "PUT",
                    url: "../../api/personal",
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

            $(".form-control").on("blur", function() {
                $.ajax({
                    type: "PUT",
                    url: "../../api/personal",
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

            $(".form-radio").on("click", function() {
                $.ajax({
                    type: "PUT",
                    url: "../../api/personal",
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
</body>

</html>