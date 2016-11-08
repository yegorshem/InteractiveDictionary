<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 11/7/2016
 * Time: 7:10 PM
 */

//validation
$isValid = true;

if (isset($_POST['teacher_first_name']) && $_POST['teacher_first_name'] != "") {
    $first_name = $_POST['teacher_first_name'];
} else {
    $isValid = false;
}
if (isset($_POST['teacher_last_name']) && $_POST['teacher_last_name'] != "") {
    $last_name = $_POST['teacher_last_name'];
} else {
    $isValid = false;
}
if (isset($_POST['teacher_email']) && $_POST['teacher_email'] != "") {
    $email = $_POST['teacher_email'];
} else {
    $isValid = false;
}
if (isset($_POST['teacher_password']) && $_POST['teacher_password'] != "") {
    $pass_code = $_POST['teacher_password'];
} else {
    $isValid = false;
}

if ($isValid == true) {

    $config = include("../config.php");
    $pass_code = md5($pass_code);
    $email = strtolower($email);

    try {
        $db = new PDO ($config["connectionString"], $config["username"], $config["password"]);

        //set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    require '../models/AdminAdapter.php';

    $adapter = new AdminAdapter($db);

    //priority set to 0 for all teachers
    $created = $adapter->createNewUser($first_name, $last_name, $email, $pass_code, 0);

    echo $created;
}
?>