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
     */
    public function __construct(PDO $db) {
        $this->db = $db;
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }


    public function getAdmins() {
        // Define the query
        $query = "SELECT * FROM teacher";

        //prepare the statement
        $statement = $this->db->prepare($query);

        //execute
        $statement->execute();
        $rows = $statement->fetchAll();
        $result = array();
        foreach ($rows as $row) {
            array_push($result, $this->read($row));
        }

        return $result;

    }

    public function getOneAdmin($admin_id) {
        // Define the query
        $query = "SELECT * FROM teacher WHERE admin_id = :admin_id";

        //prepare the statement
        $statement = $this->db->prepare($query);

        $statement->bindParam(':admin_id', $admin_id, PDO::PARAM_STR);

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

        $result = new Admin();
        $result->user_id = $row['admin_id'];
        $result->first_name = $row['first_name'];
        $result->last_name = $row['last_name'];
        $result->username = $row['email'];
        $result->password = ($row['pass_code']);
        $result->priority = ($row['priority']);

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
            $user->user_id = $row['admin_id'];
            $user->first_name = $row['first_name'];
            $user->last_name = $row['last_name'];
            $user->username = $row['email'];
            $user->password = ($row['pass_code']);
            $user->priority = ($row['priority']);

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


        return $count;
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
     * This function updates the current user
     */
    public function updateAdmin($first_name, $last_name, $pass_code, $admin_id) {
        $sql = "UPDATE teacher SET first_name= :first_name, last_name= :last_name, pass_code= :pass_code WHERE admin_id= :admin_id";

        $statement = $this->db->prepare($sql);

        $statement->bindValue(':first_name', $first_name, PDO::PARAM_STR);
        $statement->bindValue(':last_name', $last_name, PDO::PARAM_STR);
        $statement->bindValue(':pass_code', $pass_code, PDO::PARAM_STR);
        $statement->bindValue(':admin_id', $admin_id, PDO::PARAM_STR);

        $statement->execute();

        $count = $statement->rowCount();

        if($count == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function updates the current user password
     */
    public function forgotTeacherPassword($email, $pass_code)
    {
        $sql = "UPDATE teacher SET pass_code= :pass_code WHERE email= :email";

        $statement = $this->db->prepare($sql);

        $statement->bindValue(':pass_code', $pass_code, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);

        $statement->execute();

        $count = $statement->rowCount();

        return $count;
    }
}