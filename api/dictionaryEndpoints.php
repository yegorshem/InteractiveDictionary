<?php
/**
 * Created by PhpStorm.
 * User: Yegor Shemereko
 * Date: 10/7/2016
 * Time: 2:55 PM
 */


//Includes DB files
$config = include("../config.php");


try{
    $db = new PDO ($config["connectionString"], $config["username"], $config["password"]);

    //ser the PDO error mode to ecxeption
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
}
catch (PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}


require '../models/DictionaryAdapter.php';

$adapter = new DictionaryAdapter($db);

//The switch chooses what server Request_Method is being submitted
SWITCH ($_SERVER["REQUEST_METHOD"]) {

    // Retrieve all words
    case "GET":
        $result = $adapter->getAllWords();
        break;
}

//set header to JSON
header("Content-Type: application/json");

//transform PHP array to JSON
echo json_encode($result);