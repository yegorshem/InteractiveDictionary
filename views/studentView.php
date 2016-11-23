<?php
/**
 * Created by PhpStorm.
 * User: Yegor Shemereko
 * Date: 10/7/2016
 * Time: 10:42 AM
 */

if ($actual_link == '/views/studentView.php' ) {
    header('Location: ../controllers/studentController.php');
}

?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Carpentry Dictionary</title>
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

        <h1>Student Panel</h1>
        <br>
        <input id="update_id" value="<?php echo $_SESSION['student_id']; ?>" hidden>
        <!-- Add button-->
        <button type="button" id="add-btn" class="btn btn-primary btn-success" data-toggle="modal" data-target="#addModal">
        Add Word &nbsp;<span class="glyphicon glyphicon-plus"></span></button>

        <!-- Edit button-->
        <button type="button" id="update-btn" class="btn btn-warning" data-toggle="modal">
            Edit Word &nbsp;<span class="glyphicon glyphicon-edit edit-icon"></span></button>
        <br>
        <table id="studentTable"></table>
        
    </div>
<?php include 'modals/addWord.php'; ?>
<?php include 'modals/showImage.php'; ?>
<?php include 'modals/updateWord.php'; ?>
<?php include 'modals/editCredentials.php'; ?>



    <!--   jQuery-->
<script src="http://code.jquery.com/jquery.js"></script>
<!-- javascript for table -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.js"></script>
<!-- bootstrap JS-->
<script src="../js/bootstrap.min.js"></script>
<!--dropzone JS-->
<script src="../js/dropzone.min.js"></script>
<!-- custom JS-->
<script src="../js/student.js"></script>
<script src="http://code.responsivevoice.org/responsivevoice.js"></script>
<script src="../js/studentCredentials.js"></script>


</body>
</html>
