<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 11/5/2016
 * Time: 12:27 AM
 */

session_start();

//validation
$isValid = true;

if (isset($_POST['adminUsername']) && $_POST['adminUsername'] != "") {
    $adminUsername = $_POST['adminUsername'];
} else {
    $isValid = false;
}
if (isset($_POST['adminPassword']) && $_POST['adminPassword'] != "") {
    $adminPassword = $_POST['adminPassword'];
} else {
    $isValid = false;
}

if ($isValid) {
    //Includes DB files
    $adminPassword = md5($adminPassword);
    $adminUsername = strtolower($adminUsername);
    $config = include("../config.php");

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

    //The switch chooses what server Request_Method is being submitted
    SWITCH ($_SERVER["REQUEST_METHOD"]) {

        //get all admins
        case "GET":
            //$result = $adapter->getAllTeachers();
            break;

        // admin login
        case "POST":
            $user = $adapter->loginFunction($adminUsername, $adminPassword);

            if ($user != null) {
                $_SESSION['priority'] = $user->getPriority();
                $_SESSION['name'] = $user->first_name . ' ' . $user->last_name;
                echo $user->getPriority();
            }
            break;


        // Update admin
        case "PUT":
            // Workaround... PHP does not support DELETE or PUT superglobals
            parse_str(file_get_contents("php://input"), $_PUT);
            //TODO

//            $result = $_PUT;
            break;

        // Delete teacher
        case "DELETE":
            // Workaround... PHP does not support DELETE or PUT superglobals
            parse_str(file_get_contents("php://input"), $_DELETE);
            //TODO
//            $result = $_DELETE;
            break;
    }



    if ($result != null)
    {
        //set header to JSON
        header("Content-Type: application/json");

        //transform PHP array to JSON

        echo json_encode($result);
    }
}