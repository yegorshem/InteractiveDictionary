<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 11/29/2016
 * Time: 12:40 PM
 */
session_start();
$thisPage = 'Class';

if ($_SESSION['priority'] == null) {
    header("Location: about.php");
} else {

    require 'views/teacherGradesView.php';
}