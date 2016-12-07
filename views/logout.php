<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 10/8/2016
 * Time: 3:05 PM
 */

session_start();

session_unset();
session_destroy();
header("Location: ../admin.php");
?>