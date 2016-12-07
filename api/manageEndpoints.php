<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 12/7/2016
 * Time: 1:26 PM
 */

session_start();

$ds = DIRECTORY_SEPARATOR;

$storeFolder = '../uploads';

if (!empty($_FILES)) {
    //creating random name to avoid overriding previously uploaded pictures
    $ext = pathinfo($_FILES['file']['name'][0], PATHINFO_EXTENSION);
    $newname = time();
    $random = rand(100, 999);
    $image = $newname.$random.'.'.$ext;

    $tempFile = $_FILES['file']['tmp_name'][0];

    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;

    $targetFile =  $targetPath. $image;

    move_uploaded_file($tempFile,$targetFile);
}

//Includes DB files
$config = include("../config.php");


try{
    $db = new PDO ($config["connectionString"], $config["username"], $config["password"]);

    //ser the PDO error mode to exception
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
        $result = $adapter->getDeletedWords();
        break;

    // Update word
    case "PUT":
        // Workaround... PHP does not support DELETE or PUT superglobals
        parse_str(file_get_contents("php://input"), $_PUT);

        $id = $_PUT['id_update'];
        $word = $_PUT['word_update'];
        $definition = $_PUT['definition_update'];
        $category = $_PUT['category_update'];

        $adapter->updateWord($id, $word, $definition, $category);

        $result = $_PUT;
        break;

    // Delete word
    case "DELETE":
        // Workaround... PHP does not support DELETE or PUT superglobals
        parse_str(file_get_contents("php://input"), $_DELETE);
        $id = $_DELETE["id"];

        $adapter->deleteWordForever($id);

        $result = $_DELETE;
        break;
}

//set header to JSON
header("Content-Type: application/json");

//transform PHP array to JSON
echo json_encode($result);