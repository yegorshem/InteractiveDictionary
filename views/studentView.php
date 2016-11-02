<?php
/**
 * Created by PhpStorm.
 * User: Yegor Shemereko
 * Date: 10/7/2016
 * Time: 10:42 AM
 */

?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Carpentry Dictionary</title>
    <meta name="description" content="Phonetic and visual dictionary for I-BEST Students">
    <meta name="author" content="Team J.J.A.Y.">

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../css/form_formatter.css" rel="stylesheet" media="screen">

</head>
<body>
<?php include "navbarView.php"; ?>
<div class="container">

        <h1>Student Panel</h1>
        <br>
        <table id="studentTable"></table>
        
    </div>

<?php include 'modals/login.php'; ?>
<?php include 'modals/register.php'; ?>
<!--   jQuery-->
<script src="http://code.jquery.com/jquery.js"></script>
<!-- javascript for table -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.js"></script>
<!-- bootstrap JS-->
<script src="../js/bootstrap.min.js"></script>
<!-- custom JS-->
<script src="../js/student.js"></script>
<script src="../js/login.js"></script>
<script src="http://code.responsivevoice.org/responsivevoice.js"></script>
<script src="../js/register.js"></script>

</body>
</html>
