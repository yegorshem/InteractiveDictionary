<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 12/7/2016
 * Time: 12:53 PM
 */
session_start();
$thisPage = 'ManageWords';

if ($_SESSION['priority'] == 0) {
    header("Location: teacher.php");
} else if ($_SESSION['priority'] == null) {
    header("Location: student.php");
}
else {
    require 'views/manageWordsView.php';
}
?>