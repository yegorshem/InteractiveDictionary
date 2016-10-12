<?php
/**
 * Created by PhpStorm.
 * User: Yegor Shemereko
 * Date: 10/4/2016
 * Time: 2:32 PM
 */
session_start();
$thisPage = 'Dictionary';

if (!$_SESSION['user'] == 1) {

    header("Location: studentController.php");
} else {

    require '../views/adminView.php';
}