<?php

/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 11/5/2016
 * Time: 5:23 PM
 */
class Student
{
    public $user_id;
    public $first_name;
    public $last_name;
    public $username;
    private $password;
    private $class_code;


    /**
     * This function sets the password for a user
     * @param $pass- A string of the desired password
     */
    public function setPassword($pass) {
        $password = $pass;
    }

    /**
     * This function gets the class_code of the user
     * @return int- priority
     */
    public function getClassCode()
    {
        return $this->class_code;
    }

    /**
     * This function sets the class_code of the user
     * @param $priority
     */
    public function setClassCode($class_code)
    {
        $this->class_code = $class_code;
    }
}