<?php
/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 10/7/2016
 * Time: 4:35 PM
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
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * This function sets the priority of the user
     * @param mixed $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }
}