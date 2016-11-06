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

if (isset($_POST['studentUsername']) && $_POST['studentUsername'] != "") {
    $studentUsername = $_POST['studentUsername'];
} else {
    $isValid = false;
}
if (isset($_POST['studentPassword']) && $_POST['studentPassword'] != "") {
    $studentPassword = $_POST['studentPassword'];
} else {
    $isValid = false;
}

if ($isValid) {
    //Includes DB files
    $studentPassword = md5($studentPassword);
    $config = include("../config.php");

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

    //The switch chooses what server Request_Method is being submitted
    SWITCH ($_SERVER["REQUEST_METHOD"]) {

        //get all students
        case "GET":
            //$result = $adapter->getAllTeachers();
            break;

        // student login
        case "POST":
            $user = $adapter->loginFunction($studentUsername, $studentPassword);

            if ($user != null) {
                $_SESSION['class_code'] = $user->getClassCode();
                $_SESSION['name'] = $user->first_name . ' ' . $user->last_name;
                echo $user->getClassCode();
            }
            break;


        // Update student
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