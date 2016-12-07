<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 10/8/2016
 * Time: 5:07 PM
 */

session_start();
$thisPage = 'Dictionary';

if ($_SESSION['class_code'] == null) {
    header("Location: about.php");
} else {

    require 'views/studentView.php';
}
