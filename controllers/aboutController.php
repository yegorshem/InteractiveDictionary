<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 10/8/2016
 * Time: 6:06 PM
 */
session_start();

//validation
$isValid = true;

if (isset($_POST['username']) && $_POST['username'] != "") {
    $username = $_POST['username'];
} else {
    $isValid = false;
}
if (isset($_POST['password']) && $_POST['password'] != "") {
    $password = $_POST['password'];
} else {
    $isValid = false;
}

if ($isValid) {
    //Includes DB files
    $config = include("../config.php");

    try {
        $db = new PDO ($config["connectionString"], $config["username"], $config["password"]);

        //ser the PDO error mode to ecxeption
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    require '../models/UserAdapter.php';

    $adapter = new UserAdapter($db);

    $user = $adapter->loginFunction($username, $password);
    $_SESSION['user'] = $user->getPriority();

    if ($_SESSION['user'] == 1) {
        header("Location: adminController.php");
    }

}

require '../views/aboutView.php';
?>