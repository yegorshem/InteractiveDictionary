<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 10/7/2016
 * Time: 6:00 PM
 */
?>
<link href="css/navBar.css" rel="stylesheet">
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" id="collapse-btn" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" data-toggle="modal">
                <?php if ($_SESSION['name'] == null) {
                    echo "Carpentry English";
                } else {
                    echo "<span class='hidden-xs'>Welcome ".$_SESSION['first_name']."</span>&nbsp<span id='credentials-btn' class='glyphicon glyphicon-cog'></span>";
                } ?>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li <?php if ($thisPage == 'About') {
                    echo "class='active'";
                }
                ?>
                    id='aboutLink'><a href="about.php">Home</a></li>
                <li <?php if ($thisPage == 'Dictionary') {
                    echo "class='active'";
                }
                ?>
                    id='dictionaryLink'><a href="admin.php">Dictionary</a></li>
                <li <?php if ($thisPage == 'Class') {
                    echo "class='active'";
                }
                ?>
                    id='classLink'><a href=<?php if ($_SESSION['priority'] != null) {
                        //admin goes to teacherController
                        echo "teacherGrades.php";
                    } else {
                        echo "studentGrades.php";
                    }?>>Grades</a></li>
                <?php if($_SESSION['priority'] != null) { ?>
                    <li <?php if ($thisPage == 'Grades') {
                        echo "class='active'";
                    } ?>
                        id='gradingLink'><a href='class.php'>Grading</a></li>
                <?php } ?>
                <?php if($_SESSION['priority'] == 1) { ?>
                    <li <?php if ($thisPage == 'ManageWords') {
                        echo "class='active'";
                    } ?>
                            id='gradingLink'><a href='adminManageWords.php'>Archive</a></li>
                <?php } ?>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php if ($_SESSION['name'] == null) {
                    print "<li><a href='#' data-toggle='modal' data-target='#loginModal'>Sign In</a></li>";
                } else {
                    print "<li><a href='views/logout.php'>Sign Out</a></li>";
                } ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
