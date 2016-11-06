<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 10/7/2016
 * Time: 4:44 PM
 */

require 'AdminUser.php';
/**
 * This page is created to handle the user able in the database
 */
/**
 * Class UserAdapter is used to add new users,
 * delete old users, log users in and log users out
 */

class AdminAdapter {

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
        $query = "SELECT * FROM teacher WHERE email = :login AND pass_code = :password";

        //prepare the statement
        $statement = $this->db->prepare($query);

        //bind parameters
        $statement->bindParam(':login', $login, PDO::PARAM_STR);
        $statement->bindParam(':password', $pass, PDO::PARAM_STR);

        //execute
        $statement->execute();

        $row = $statement->fetch();
        if ($row != null) {
            $user = new Admin();
            $user->user_id = $row['user_id'];
            $user->first_name = $row['first_name'];
            $user->last_name = $row['last_name'];
            $user->username = $row['email'];
            $user->setPassword($row['pass_code']);
            $user->setPriority($row['priority']);
            
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
    public function createNewUser($first_name, $last_name, $email, $pass_code, $priority) {
        // Define the query
        $query = "INSERT INTO teacher (first_name, last_name, email, pass_code, priority) VALUES 
                      (:first_name, :last_name, :email, :pass_code, :priority)";

        // prepare the statement
        $statement = $this->db->prepare($query);

        //bind parameters
        $statement->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $statement->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':pass_code', $pass_code, PDO::PARAM_STR);
        $statement->bindParam(':priority', $priority, PDO::PARAM_INT);


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
     *          *NOTE: you cant delete the admin(priority = 1)
     *                  only teachers(priority = 0)
     * @param $username - the id of the user you wish to delete
     * @return bool- true if one row was removed from the table
     *
     */
    public function deleteOneUser($username) {
        // define query
        $query = "DELETE FROM teachers WHERE username = :$username AND priority = :0";

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