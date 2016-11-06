<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 10/31/2016
 * Time: 10:57 AM
 */

//validation
$isValid = true;

if (isset($_POST['first_name']) && $_POST['first_name'] != "") {
    $first_name = $_POST['first_name'];
} else {
    $isValid = false;
}
if (isset($_POST['last_name']) && $_POST['last_name'] != "") {
    $last_name = $_POST['last_name'];
} else {
    $isValid = false;
}
if (isset($_POST['email']) && $_POST['email'] != "") {
    $email = $_POST['email'];
} else {
    $isValid = false;
}
if (isset($_POST['pass_code']) && $_POST['pass_code'] != "") {
    $pass_code = $_POST['pass_code'];
} else {
    $isValid = false;
}
if (isset($_POST['class_code']) && $_POST['class_code'] != "") {
    $class_code = $_POST['class_code'];
} else {
    $isValid = false;
}
if ($isValid == true) {

    $config = include("../config.php");
    $pass_code = md5($pass_code);

    try {
        $db = new PDO ($config["connectionString"], $config["username"], $config["password"]);

        //set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    require '../models/StudentAdapter.php';

    $adapter = new StudentAdapter($db);

    $created = $adapter->createNewUser($first_name, $last_name, $email, $pass_code, $class_code);

    echo $created;
}

?>