<?php
/**
 * User: Yegor Shemereko
 * Date: 11/17/2016
 * Time: 8:12 AM
 */

$actual_link = $_SERVER['PHP_SELF'];

if ($actual_link == '/views/adminView.php') {
    header('Location: ../controllers/adminController.php');
}
?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Carpentry English</title>
    <meta name="description" content="Phonetic and visual dictionary for I-BEST Students">
    <meta name="author" content="Team J.J.A.Y.">

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../css/dropzone.min.css" rel="stylesheet" media="screen">
    <link href="../css/form_formatter.css" rel="stylesheet" media="screen">

</head>
<body>
<?php include "navbarView.php"; ?>
<div class="container">
    <h1>Carpentry English - Teacher Panel</h1>
    <br>

    <div class="form-group row">

        <!-- class selector-->
        <div class="col-xs-4">
            <select id="classPicker" class="selectpicker form-control">
                <option value="0" disabled="disabled" selected="selected">Select a class</option>
            </select>
        </div>

        <!-- add button-->
        <button type="button" id="add-btn" class="btn btn-success" data-toggle="modal"
                data-target="#addModal">
            Add Word &nbsp;<span class="glyphicon glyphicon-plus"></span></button>

        <!-- Edit button-->
        <button type="button" id="update-btn" class="btn btn-warning" data-toggle="modal">
            Edit Word &nbsp;<span class="glyphicon glyphicon-edit edit-icon"></span></button>

        <!-- delete button-->
        <button type="button" id="delete-btn" class="btn btn-danger" data-toggle="modal">
            Delete Word &nbsp;<span class="glyphicon glyphicon-minus"></span></button>


    </div>

    <hr>

    <table id="adminTable"></table>

</div>

<?php include 'modals/addWord.php'; ?>
<?php include 'modals/updateWord.php'; ?>
<?php include 'modals/showImage.php'; ?>
<?php include 'modals/newTeacher.php'; ?>
<?php include 'modals/newClass.php'; ?>
<?php include 'modals/deleteConfirmation.php'; ?>



<!--   jQuery-->
<script src="http://code.jquery.com/jquery.js"></script>
<!-- javascript for table -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.js"></script>
<!--bootstrap JS-->
<script src="../js/bootstrap.min.js"></script>
<!--dropzone JS-->
<script src="../js/dropzone.min.js"></script>
<!--responsiveVoice JS-->
<script src="http://code.responsivevoice.org/responsivevoice.js"></script>
<!--custom JS-->
<script src="../js/admin.js"></script>
<script src="../js/classWordsSelect.js"></script>
<script src="../js/createClass.js"></script>

</body>
</html>
