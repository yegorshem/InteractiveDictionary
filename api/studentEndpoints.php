<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 11/5/2016
 * Time: 12:27 AM
 */

session_start();

//Includes DB files
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

//this function creates random strings for forgotten password
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

//The switch chooses what server Request_Method is being submitted
SWITCH ($_SERVER["REQUEST_METHOD"]) {

    //get all students
    case "GET":
        $class = $_GET['classPicker'];
        $string = $_GET['string'];
        if ($string != null) {
            $result = $adapter->getOneStudent($_SESSION['student_id']);
        } else {
            $result = $adapter->getStudents($class);

        }
        break;

    // student login
    case "POST":

        $studentPassword = md5($_POST['studentPassword']);
        $studentUsername = strtolower($_POST['studentUsername']);
        $user = $adapter->loginFunction($studentUsername, $studentPassword);

        if ($user != null) {
            $_SESSION['class_code'] = $user->class_code;
            $_SESSION['first_name'] = $user->first_name;
            $_SESSION['name'] = $user->first_name . ' ' . $user->last_name;
            $_SESSION['student_id'] = $user->user_id;
            echo $user->class_code;
        }
        break;


    // Update student
    case "PUT":
        // Workaround... PHP does not support DELETE or PUT superglobals
        parse_str(file_get_contents("php://input"), $_PUT);
        $first_name = $_PUT['first_name'];
        $last_name = $_PUT['last_name'];
        $old_pass_code = md5($_PUT['old_pass_code']);
        $old_pass = $_PUT['old_pass'];
        $new_pass_code = md5($_PUT['new_pass_code']);
        if ($old_pass == $old_pass_code) {
            $_SESSION['name'] = $first_name . " " . $last_name;
            $_SESSION['first_name'] = $first_name;
            $result = $adapter->updateStudent($first_name, $last_name, $new_pass_code, $_SESSION['student_id']);
        } else {
            $result = "Incorrect Password.";
        }
        break;

    // Delete teacher
    case "DELETE":
        // Workaround... PHP does not support DELETE or PUT superglobals
        parse_str(file_get_contents("php://input"), $_DELETE);
        //changing password for forgotten password
        $pass = generateRandomString();
        $new_pass = md5($pass);
        $email = $_DELETE['email'];

        $count = $adapter->forgotStudentPassword($email, $new_pass);

        $email_subject = "Password Reset";
        $email_body = "You have recently requested to reset your password.\n\n" . "Here is your password: $pass\n\n";
        $headers = "From: noreply@yourdomain.com\n";
        mail($email, $email_subject, $email_body, $headers);
        echo "$count";
        break;
}


if ($result != null) {
    //set header to JSON
    header("Content-Type: application/json");

    //transform PHP array to JSON

    echo json_encode($result);
}
