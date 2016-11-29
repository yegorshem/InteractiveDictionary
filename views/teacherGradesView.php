<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 11/29/2016
 * Time: 12:26 PM
 */

$actual_link = $_SERVER['PHP_SELF'];

if ($actual_link == '/views/teacherGradeView.php') {
    header('Location: ../teacherGrades.php');
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
    <link href="css/form_formatter.css" rel="stylesheet" media="screen">

</head>
<body>
<?php include "navbarView.php"; ?>

<div class="container">
    <h1>Submissions</h1>
    <br>

    <div class="form-group row">
        <!-- class selector-->
        <div class="col-xs-4">
            <select id="classPicker" class="selectpicker form-control">
                <option value="0" disabled="disabled" selected="selected">Select a class</option>
            </select>
        </div>
        <div id="selection" class="col-xs-4">

        </div>
    </div>
    <hr>
    <table id="teacherGradeTable"></table>

</div>

</body>
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
<script src="js/teacherGradeTable.js"></script>


</html>
