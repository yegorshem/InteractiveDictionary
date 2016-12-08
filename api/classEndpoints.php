<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 11/6/2016
 * Time: 11:11 AM
 */
session_start();

$config = include("../config.php");

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


//The switch chooses what server Request_Method is being submitted
SWITCH ($_SERVER["REQUEST_METHOD"]) {

    //get all classes associated with this admin
    case "GET":
        $result = $adapter->getClasses($_SESSION['admin_id']);
        break;

    case "POST":
        $class_name = $_POST['class_name'];
        $admin_id = $_POST['admin_id'];


        $randomFourDigitNumber = 9999;

        do{
            $randomFourDigitNumber = mt_rand(1001, 9998);
        }while($adapter->checkIfExists($randomFourDigitNumber) != 0);


        $created = $adapter->createNewClass($class_name, $admin_id, $randomFourDigitNumber);
        break;


    // Update class
    case "PUT":
        // Workaround... PHP does not support DELETE or PUT superglobals
        parse_str(file_get_contents("php://input"), $_PUT);
        //$result =
        break;

    // Delete class
    case "DELETE":
        // Workaround... PHP does not support DELETE or PUT superglobals
        parse_str(file_get_contents("php://input"), $_DELETE);
        //TODO
        // $result = $_DELETE;
        break;
}


//transform PHP array to JSON
echo json_encode($result);


?>