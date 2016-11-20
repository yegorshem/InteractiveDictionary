<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 11/5/2016
 * Time: 5:23 PM
 */
require "StudentUser.php";

class StudentAdapter
{

    protected $db;

    /**
     * This function constructs a DBTools object     *
     * @param PDO $db - the database we are storing information in.
     * @return db
     */
    public function __construct(PDO $db) {
        $this->db = $db;
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    public function getStudents($class_code) {
        // Define the query
        $query = "SELECT * FROM student WHERE class_code = :class_code";

        //prepare the statement
        $statement = $this->db->prepare($query);

        $statement->bindParam(':class_code', $class_code, PDO::PARAM_INT);

        //execute
        $statement->execute();
        $rows = $statement->fetchAll();
        $result = array();
        foreach ($rows as $row) {
            array_push($result, $this->read($row));
        }

        return $result;

    }

    private function read($row)
    {

        $result = new Student();
        $result->user_id = $row['student_id'];
        $result->first_name = $row['first_name'];
        $result->last_name = $row['last_name'];
        $result->username = $row['email'];
        $result->setPassword($row['pass_code']);
        $result->setClassCode($row['class_code']);

        return $result;
    }



    /**
     * This function logs the user in
     *
     * @param string $login - the username the admin uses to log in
     * @param string $pass - the password the admin uses to log in
     *
     *@return login
     */
    public function loginFunction($login, $pass) {
        // Define the query
        $query = "SELECT * FROM student WHERE email = :login AND pass_code = :password";

        //prepare the statement
        $statement = $this->db->prepare($query);

        //bind parameters
        $statement->bindParam(':login', $login, PDO::PARAM_STR);
        $statement->bindParam(':password', $pass, PDO::PARAM_STR);

        //execute
        $statement->execute();

        $row = $statement->fetch();
        if ($row != null) {
            $user = new Student();
            $user->user_id = $row['student_id'];
            $user->first_name = $row['first_name'];
            $user->last_name = $row['last_name'];
            $user->username = $row['email'];
            $user->setPassword($row['pass_code']);
            $user->setClassCode($row['class_code']);

            return $user;
        }
        else {
            return null;
        }
    }

    /**
     * This function creates a new user in the user table.
     *
     * @param-$username is a string
     * @param-$password is a string
     * @param-$priority is an int
     * @return Admin
     */
    public function createNewUser($first_name, $last_name, $email, $pass_code, $class_code) {
        // Define the query
        $query = "INSERT INTO student (first_name, last_name, email, pass_code, class_code) VALUES 
                      (:first_name, :last_name, :email, :pass_code, :class_code)";

        // prepare the statement
        $statement = $this->db->prepare($query);

        //bind parameters
        $statement->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $statement->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':pass_code', $pass_code, PDO::PARAM_STR);
        $statement->bindParam(':class_code', $class_code, PDO::PARAM_INT);


        //execute the statement
        $success = $statement->execute();

        $count = $statement->rowCount();


        if($count == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function removes one user from the teacher table
     *
     * @param $username - the id of the user you wish to delete
     * @return bool- true if one row was removed from the table
     *
     */
    public function deleteOneUser($username) {
        // define query
        $query = "DELETE FROM student WHERE username = :username";

        //prepare the statement
        $statement = $this->db->prepare($query);

        $statement->bindParam(':username', $username, PDO::PARAM_STR);

        //execute
        $success = $statement->execute();

        $count = $statement->rowCount();

        if($count == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function destroys the session, logging out the current user
     */
    public function logout() {
        session_destroy();
    }
}