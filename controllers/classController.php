<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 11/19/2016
 * Time: 1:24 PM
 */
session_start();
$thisPage = 'Class';

if ($_SESSION['priority'] == null) {
    header("Location: studentController.php");
} else {
    require '../views/classView.php';
}