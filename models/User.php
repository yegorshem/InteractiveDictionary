<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 10/7/2016
 * Time: 4:35 PM
 */

/**
 * This page defines the User class
 */

/**
 * Class User holds the user_id, username, password and priority level of each user
 */
class User
{
    public $user_id;
    public $username;
    private $password;
    private $priority;


    /**
     * This function sets the password for a user
     * @param $pass- A string of the desired password
     */
    public function setPassword($pass) {
        $password = $pass;
    }

    /**
     * This function gets the priority of the user
     * @return int- priority
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * This function sets the priority of the user
     * @param $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }
}