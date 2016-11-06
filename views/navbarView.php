<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 10/7/2016
 * Time: 6:00 PM
 */
?>
<link href="../css/navBar.css" rel="stylesheet">
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">Carpentry English</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li <?php if ($thisPage == 'Dictionary') {
                    echo "class='active'";
                }
                ?>
                    id='dictionaryLink'><a href="../controllers/adminController.php">Dictionary</a></li>
                <li <?php if ($thisPage == 'About') {
                    echo "class='active'";
                }
                ?>
                    id='aboutLink'><a href="../controllers/aboutController.php">Home</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <?php if ($_SESSION['name'] == null) {
                    print "<li><a href='#' data-toggle='modal' data-target='#loginModal'>Sign In</a></li>";
                } else {
                    print "<li><a>Welcome ".$_SESSION['name']."</a></li>";
                    print "<li><a href='../views/logout.php'>Sign Out</a></li>";
                } ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
