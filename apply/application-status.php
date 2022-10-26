<?php
session_start();
if (isset($_SESSION['ghAppLogin']) && $_SESSION['ghAppLogin'] == true) {
    if (!(isset($_SESSION["ghApplicant"]) && !empty($_SESSION['ghApplicant']))) {
        header('Location: ./apply/index.php?status=error&message=Invalid access!');
    }
} else {
    header('Location: ./apply/index.php?status=error&message=Invalid access!');
}

if (isset($_GET['logout'])) {
    unset($_SESSION['ghAppLogin']);
    unset($_SESSION['ghApplicant']);
    session_destroy();
    header('Location: ./apply/index.php');
}

$user_id = $_SESSION['ghApplicant'];

$page = array("id" => 0, "name" => "Application Status");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
    </style>
</head>

<body id="body">

    <?php require_once("../inc/top-page-section.php") ?>

    <div class="main-content" style="height: 100% !important;">
        <h1><?= $page["name"] ?></h1>
        <h4>Congratulations! Your application form was successfully submitted.</h4>

        <div class="mt-4">
            <label for="">
                <span>You can download a copy of your application form</span>
                <button type="button" class="btn btn-primary btn-sm">Download</button>
            </label>
        </div>
        <!--<div class="help_area">
            <div class="help_chat_area"></div>
            <button style="padding: 5px 10px; cursor: pointer">Chat with us</button>
        </div>-->
    </div>
</body>

</html>