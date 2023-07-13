<?php
session_start();
if (isset($_SESSION['ghAppLogin']) && $_SESSION['ghAppLogin'] == true) {
    if (!(isset($_SESSION["ghApplicant"]) && !empty($_SESSION['ghApplicant']))) {
        header('Location: ../index.php?status=error&message=Invalid access!');
    }
} else {
    header('Location: ../index.php?status=error&message=Invalid access!');
}

if (isset($_GET['logout'])) {
    unset($_SESSION['ghAppLogin']);
    unset($_SESSION['ghApplicant']);
    session_destroy();
    header('Location: ../index.php');
}

$user_id = $_SESSION['ghApplicant'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="Keywords" content="Regional Maritime University, Regional, Maritime, University in Ghana, RMU, University, Apply, Forms, School, Institution">
    <meta name="Description" content="The Regional Maritime University (RMU), Accra, Ghana, is an international tertiary institution. The overall objective for the establishment of RMU is to promote regional co-operation in the maritime industry focusing on the training to ensure the sustained growth and development of the industry.">
    <meta property="og:image" content="https://rmu.edu.gh/wp-content/uploads/2019/09/rmulogo-exp-3-400x75.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="400">
    <meta property="og:image:height" content="75">
    <meta property="og:description" content="Regional Maritime University (RMU) offers a comprehensive range of diploma and degree programs in Marine Engineering, Nautical Science, Electrical Engineering, Mechanical Engineering, Computer Science, Computer Engineering, Information Technology, Logistics, Port and Shipping Management, and other short courses. Explore our programs and gain expertise in the maritime industry. Join us and unlock your potential in the exciting world of maritime education.">
    <meta name="author" content="Francis A. Anlimah">
    <meta name="email" content="francis.ano.anlimah@gmail.com">
    <meta name="website" content="https://linkedin.com/in/francis-anlimah">
    <link href="../../assets/images/rmu-logo.png" rel="icon">
    <link href="../../assets/images/rmu-logo.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style>
    </style>
</head>