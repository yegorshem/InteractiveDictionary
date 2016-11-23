<?php
/**
 * Created by PhpStorm.
 * User: Yegor Shemereko
 * Date: 10/7/2016
 * Time: 2:55 PM
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
        //check if admin
        if ($_SESSION['priority'] != null) {


            $student = $_GET['creator_id'];
            $graded = $_GET['graded'];
            $class_code = $_GET['classPicker'];
            $_SESSION['class_code'] = $class_code;
            if ($student != null) {
                //by student and graded (zero is for not deleted)
                $result = $adapter->getStudentWords($student, 0, $graded);
            }
            else if($graded != null)
            {
                //by class and graded (zero is for not deleted)
                $result = $adapter->getGradedWords($class_code, 0, $graded);
            }
            else
            {
                //by class (zero is for not deleted)
                $result = $adapter->getAllWords($class_code, 0);
            }
        }
        else {
            //student (zero is for not deleted)
            $result = $adapter->getAllWords($_SESSION['class_code'], 0);
        }
        break;

    // Add word
    case "POST":
        $word = $_POST['word'];
        $definition = $_POST['definition'];
        $category = $_POST['category'];
        if ($_SESSION['priority'] != null) {
            //admin submits with student_id of 0 and already graded (the 1). Second 0 is for not deleted
            $adapter->submitWord($word, $definition, $image, $category, $_SESSION['name'], 0, $_SESSION['class_code'], 1, 0);
        }
        else {
            //student
            $adapter->submitWord($word, $definition, $image, $category, $_SESSION['name'], $_SESSION['student_id'], $_SESSION['class_code'], 0, 0);
        }
        //Initializing array to hold possible errors
        //$error = array();
        //$error = $adapter->validateWord($word, $definition);
        //If error array has no errors then submit the post
        //if (count($error) == 0) {
        //}

        $result = $error;
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

        $adapter->deleteWord($id);

        $result = $_DELETE;
        break;
}

//set header to JSON
header("Content-Type: application/json");

//transform PHP array to JSON
echo json_encode($result);