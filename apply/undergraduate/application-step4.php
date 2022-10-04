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

$page = array("id" => 4, "name" => "Uploads");
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
                        <div class="page_info" style="margin-bottom: 0px !important;">
                            <h1 style="font-size: 40px; padding-bottom: 15px !important">Uploads</h1>
                        </div>

                        <!-- Page form -->
                        <!--<form id="appForm" method="POST" style="margin-top: 15px !important;">-->
                        <?php require_once("forms/documents-upload.php") ?>

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
    <script src="../../js/myjs.js"></script>
    <script>
        $(document).ready(function() {
            $("#attach-cert-btn").click(function() {
                $("#reset-upload").click();
                $(".mb-4").removeClass("has-error");
                $(".help-block").remove();
                $("#file-type").val("Certificate");
                $(".doc-type").text("Certificate");
                $(".upload-doc").addClass("hide");
                $(".upload-doc").removeClass("display");
                $(".feedback").removeClass("text-danger").text("");
                $("#fileUploadSuccess").text("");
                $("#20eh29v1Tf").val("");
            });
            $("#attach-tscript-btn").click(function() {
                $("#reset-upload").click();
                $(".mb-4").removeClass("has-error");
                $(".help-block").remove();
                $("#file-type").val("Transcript");
                $(".doc-type").text("Transcript");
                $(".upload-doc").addClass("hide");
                $(".upload-doc").removeClass("display");
                $(".feedback").removeClass("text-danger").text("");
                $("#fileUploadSuccess").text("");
                $("#20eh29v1Tf").val("");
            });
            $("#add-education-btn").click(function() {});

            $("#user-doc").change("blur", function(e) {
                $("#20eh29v1Tf").val(this.value);
                $(".upload-doc").addClass("display");
                $(".upload-doc").removeClass("hide");
                e.preventDefault();
            });

            function fileInfo() {
                var fileName = document.getElementById('upload-file').files[0].name;
                var fileSize = document.getElementById('upload-file').files[0].size;
                var fileType = document.getElementById('upload-file').files[0].type;
                var fileModifiedDate = document.getElementById('upload-file').files[0].lastModifiedDate;

                var file_info = fileName + "\n" + fileSize + "\n" + fileType + "\n" + fileModifiedDate;
                alert(file_info);
            }

            //when URL of file input changes
            $("#upload-file").change(function() {
                $("#fileUploadSuccess").text("Uploading File: " + document.getElementById('upload-file').files[0].name);
            });

            $("#doc-upload-form").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../../api/certificates",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                }).done(function(data) {
                    console.log(data);
                    if (!data.success) {
                        $('.feedback').addClass("text-danger").html('').text(data.error);
                        return;
                    }
                    window.location.reload();
                });
            });

            //function to display selected image
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#app-photo').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            //displays image when URL of file input changes
            $("#photo-upload").change(function() {
                readURL(this);
                $("#____entered___").val(1);
                $("#sbmit__enetere").click();
            });

            $("#picture-upload-form").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../../api/upload-photo",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                }).done(function(data) {
                    console.log(data);
                    alert(data.message);
                    window.location.reload();
                });
            })

            $(".delete-file").click(function() {
                $.ajax({
                    type: "DELETE",
                    url: "../../api/upload-file",
                    data: {
                        what: this.id
                    },
                    dataType: "json",
                    encode: true,
                }).done(function(data) {
                    console.log(data);
                    if (data.success) {
                        alert(data.message);
                        window.location.reload();
                    }
                });
            })
        });
    </script>
</body>

</html>