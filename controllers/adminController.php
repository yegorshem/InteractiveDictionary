<?php
/**
 * Created by PhpStorm.
 * User: Yegor Shemereko
 * Date: 10/4/2016
 * Time: 2:32 PM
 */
session_start();
$thisPage = 'Dictionary';

if ($_SESSION['priority'] == null) {
    header("Location: studentController.php");
} else {

    $adapter = new ClassAdapter();


    require '../views/adminView.php';
}