<?php
/**
 * User: Yegor Shemereko
 * Date: 11/17/2016
 * Time: 8:13 AM
 */
session_start();
$thisPage = 'Dictionary';

if ($_SESSION['priority'] == null) {
    header("Location: student.php");
} else {
    require 'views/teacherView.php';
}