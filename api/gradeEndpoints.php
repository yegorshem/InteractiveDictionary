<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 11/19/2016
 * Time: 12:50 AM
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

require '../models/GradeAdapter.php';

$adapter = new GradeAdapter($db);

//The switch chooses what server Request_Method is being submitted
SWITCH ($_SERVER["REQUEST_METHOD"]) {

    //get all classes associated with this admin
    case "GET":
        //check if teacher
        if ($_SESSION['student_id'] != null) {
            //gets all not deleted grades for the student
            $result = $adapter->getGrades($_SESSION['student_id'], 0);
        } else {
            //gets all not deleted grades for the class
            $class_id = $_GET['classPicker'];
            $creator_id = $_GET['creator_id'];
            if ( $creator_id == null) {
                $result = $adapter->getClassGrades($class_id, 0);
            } else {
                $result = $adapter->getGrades($creator_id, 0);
            }

        }
        break;

    case "POST":
        $word_id = $_POST['word_id'];
        $word = $_POST['word_grade'];
        $definition = $_POST['definition_grade'];
        $category = $_POST['category_grade'];
        $image = $_POST['image_grade'];
        $score = $word+$definition+$category+$image;
        $comment = $_POST['comments'];
        $created = $adapter->createNewGrade($word, $definition, $category, $image, $score, $comment, $word_id);
        //set as graded
        $adapter->gradeWord(1, $word_id);
        echo $created;
        break;


    // Update class
    case "PUT":
        // Workaround... PHP does not support DELETE or PUT superglobals
        parse_str(file_get_contents("php://input"), $_PUT);
        //TODO

        // $result = $_PUT;
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