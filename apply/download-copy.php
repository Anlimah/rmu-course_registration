<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['ghAppLogin']) && $_SESSION['ghAppLogin'] == true) {
    if (!(isset($_SESSION["ghApplicant"]) && !empty($_SESSION['ghApplicant']))) {
        header('Location: ./index.php?status=error&message=Invalid access!');
    }
} else {
    header('Location: ./index.php?status=error&message=Invalid access!');
}

if (isset($_GET['logout'])) {
    unset($_SESSION['ghAppLogin']);
    unset($_SESSION['ghApplicant']);
    session_destroy();
    header('Location: ./index.php');
}

$user_id = $_SESSION['ghApplicant'];

$page = array("id" => 0, "name" => "Application Status");
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download copy of application</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <?php require_once("../inc/apply-head-section.php") ?>
</head>

<body>

</body>

</html>