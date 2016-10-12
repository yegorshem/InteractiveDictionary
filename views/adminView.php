<?php
/**
 * Created by PhpStorm.
 * User: Yegor Shemereko
 * Date: 10/4/2016
 * Time: 2:32 PM
 */
?>
<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>InteractiveDictionary</title>
    <meta name="description" content="Phonetic and visual dictionary for I-BEST Students">
    <meta name="author" content="Team J.J.A.Y.">

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
<div class="container">
    <h1>Interactive Dictionary - Admin Panel</h1>
<br>
    <button type="button" id="add-btn" class="btn btn-primary btn-success" data-toggle="modal" data-target="#addModal">
        Add Word &nbsp;<span class="glyphicon glyphicon-plus"></span></button>
    <button type="button" id="delete-btn" class="btn btn-primary btn-danger" data-toggle="modal" >
        Delete Word &nbsp;<span class="glyphicon glyphicon-minus"></span></button>

    <table id="adminTable"></table>

</div>

<?php include 'modals/addWord.php'; ?>
<?php include 'modals/updateWord.php'; ?>

<!--   jQuery-->
<script src="http://code.jquery.com/jquery.js"></script>
<!-- javascript for table -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.js"></script>
<!--bootstrap JS-->
<script src="../js/bootstrap.min.js"></script>
<!--custom JS-->
<script src="../js/admin.js"></script>
</body>
</html>
