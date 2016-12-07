<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 12/7/2016
 * Time: 12:56 PM
 */
$actual_link = $_SERVER['PHP_SELF'];

if ($actual_link == '/views/manageWordsView.php') {
    header('Location: ../adminManageWords.php');
}
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
    <link href="css/dropzone.min.css" rel="stylesheet" media="screen">
    <link href="css/form_formatter.css" rel="stylesheet" media="screen">

</head>
<body>
<?php include "navbarView.php"; ?>
<div class="container">
    <h1>Carpentry English - Admin Manage Words</h1>
    <br>

    <div class="form-group row">
        <!-- delete button-->
        <button type="button" id="delete-btn" class="btn btn-danger" data-toggle="modal">
            Delete Word &nbsp;<span class="glyphicon glyphicon-minus"></span></button>
    </div>

    <hr>

    <table id="manageWordsTable"></table>

</div>

<?php include 'modals/showImage.php'; ?>
<?php include 'modals/manageModal.php'; ?>
<?php include 'modals/editCredentials.php'; ?>

<!--   jQuery-->
<script src="http://code.jquery.com/jquery.js"></script>
<!-- javascript for table -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.js"></script>
<!--bootstrap JS-->
<script src="js/bootstrap.min.js"></script>
<!--dropzone JS-->
<script src="js/dropzone.min.js"></script>
<!--responsiveVoice JS-->
<script src="http://code.responsivevoice.org/responsivevoice.js"></script>
<!--custom JS-->
<script src="js/manageWords.js"></script>
<script src="js/teacherCredentials.js"></script>

</body>
</html>