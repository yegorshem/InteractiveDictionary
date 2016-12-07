<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 10/8/2016
 * Time: 6:05 PM
 */
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Carpentry English</title>

    <meta name="description" content="Phonetic and visual dictionary for I-BEST Students">
    <meta name="author" content="Team J.J.A.Y.">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/form_formatter.css" rel="stylesheet" media="screen">
    <link href="css/background.css" rel="stylesheet" media="screen">
</head>
<body>
    <?php include "navbarView.php"; ?>

    <div id="container">

    </div>

    <?php include 'modals/login.php'; ?>
    <?php include 'modals/register.php'; ?>
    <?php include 'modals/forgotPassword.php'; ?>
</body>

<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/login.js"></script>
<script src="js/register.js"></script>
<script src="js/forgotPassword.js"></script>

</html>
