<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 11/6/2016
 * Time: 11:11 AM
 */
session_start();

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

require '../models/ClassAdapter.php';

$adapter = new ClassAdapter($db);

$result = $adapter->getClasses($_SESSION['admin_id']);

echo json_encode($result);

?>