<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 10/7/2016
 * Time: 4:44 PM
 */

require 'User.php';
/**
 * This page is created to handle the user able in the database
 */
/**
 * Class UserAdapter is used to add new users,
 * delete old users, log users in and log users out
 */

class UserAdapter {

    protected $db;

    /**
     * This function constructs a DBTools object     *
     * @param PDO $db - the database we are storing information in.
     * @return db
     */
    public function UserAdapter(PDO $db) {
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
        $query = "SELECT * FROM users WHERE username = :login AND password = :password";

        //prepare the statement
        $statement = $this->db->prepare($query);

        //bind parameters
        $statement->bindParam(':login', $login, PDO::PARAM_STR);
        $statement->bindParam(':password', $pass, PDO::PARAM_STR);

        //execute
        $statement->execute();

        $row = $statement->fetch();
        if ($row != null) {
            $user = new User();
            $user->user_id = $row['user_id'];
            $user->username = $row['username'];
            $user->setPassword($row['password']);
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
     * @return user
     */
    public function createNewUser($username, $password, $priority) {
        // Define the query
        $query = "INSERT INTO users (username, password, priority) VALUES (:username, :password, :priority)";

        // prepare the statement
        $statement = $this->db->prepare($query);

        //bind parameters
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
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
     * This function removes one user from the user table
     * @param $username - the id of the user you wish to delete
     * @return bool- true if one row was removed from the table
     *
     */
    public function deleteOneUser($username) {
        // define query
        $query = "DELETE FROM users WHERE username = :$username";

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