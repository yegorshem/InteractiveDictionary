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
    public function __construct(PDO $db)
    {
        $this->db = $db;
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    /**
     * This function logs the user in
     *
     * @param-admin_id - Int of the admin id
     *
     * @return class
     */
    public function getClasses($admin_id)
    {
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
        $result->class_code = $row['class_code'];
        $result->admin_id = $row['admin_id'];

        return $result;
    }


    public function createNewClass($class_name, $admin_id, $class_code)
    {

        // Define the query
        $query = "INSERT INTO class (class_name, admin_id, class_code) VALUES (:class_name, :admin_id, :class_code)";

        // prepare the statement
        $statement = $this->db->prepare($query);

        //bind parameters
        $statement->bindParam(':class_name', $class_name, PDO::PARAM_STR);
        $statement->bindParam(':admin_id', $admin_id, PDO::PARAM_STR);
        $statement->bindParam(':class_code', $class_code, PDO::PARAM_INT);

        //execute the statement
        $success = $statement->execute();

        $count = $statement->rowCount();


        return $count;
    }

    /**
     * This function removes one class from the class table
     *
     * @param $class_code - the id of the class you wish to delete
     * @return bool- true if one row was removed from the table
     *
     */
    public function deleteOneClass($class_code)
    {
        // define query
        $query = "DELETE FROM class WHERE class_id = :class_code";

        //prepare the statement
        $statement = $this->db->prepare($query);

        $statement->bindParam(':class_code', $class_code, PDO::PARAM_INT);

        //execute
        $success = $statement->execute();

        $count = $statement->rowCount();

        if ($count == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIfExists($class_code)
    {
        // Define the query
        //$query = "SELECT * FROM class WHERE admin_id = :admin_id"

        $query = "SELECT 1 FROM class WHERE class_code = :class_code";
        //prepare the statement
        $statement = $this->db->prepare($query);

        $statement->bindParam(':class_code', $class_code, PDO::PARAM_INT);

        //execute
        $statement->execute();

        if($statement->rowCount() == 0) {
            return 0;
        }else{
            return 1;
        }


//        $row = $statement->fetchAll();
//
//        if (!$row) {
//            print_r("false");
//            return 0;
//        }
//
////        $count = $statement->rowCount();
////
////        if ($count == 1) {
////            return true;
////        } else {
////            return false;
////        }
//        //print_r("true");
//        return 1;
    }

}