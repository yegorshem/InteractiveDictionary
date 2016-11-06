<?php

/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 11/6/2016
 * Time: 9:48 AM
 */
require "ClassObject.php";

class ClassAdapter
{
    protected $db;

    /**
     * This function constructs a classAdapter object     *
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
     * @param-admin_id - Int of the admin id
     *
     *@return class
     */
    public function getClasses($admin_id) {
        // Define the query
        $query = "SELECT * FROM class WHERE admin_id = :admin_id";

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

        $result = new ClassObject();
        $result->class_id = $row['class_id'];
        $result->class_name = $row['class_name'];
        $result->admin_id = $row['admin_id'];

        return $result;
    }

    /**
     * This function creates a new user in the user table.
     *
     * @param-$class_name - String
     * @param-$admin_id - int
     */
    public function createNewUser($class_name, $admin_id) {
        // Define the query
        $query = "INSERT INTO class (class_name, admin_id) VALUES (:class_name, :admin_id)";

        // prepare the statement
        $statement = $this->db->prepare($query);

        //bind parameters
        $statement->bindParam(':class_name', $class_name, PDO::PARAM_STR);
        $statement->bindParam(':admin_id', $admin_id, PDO::PARAM_STR);


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
     * This function removes one class from the class table
     *
     * @param $class_code - the id of the class you wish to delete
     * @return bool- true if one row was removed from the table
     *
     */
    public function deleteOneClass($class_code) {
        // define query
        $query = "DELETE FROM class WHERE class_id = :class_code";

        //prepare the statement
        $statement = $this->db->prepare($query);

        $statement->bindParam(':class_code', $class_code, PDO::PARAM_STR);

        //execute
        $success = $statement->execute();

        $count = $statement->rowCount();

        if($count == 1) {
            return true;
        } else {
            return false;
        }
    }

}