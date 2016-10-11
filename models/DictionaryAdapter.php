<?php

/**
 * Created by PhpStorm.
 * User: Yegor Shemereko
 * Date: 10/7/2016
 * Time: 3:10 PM
 */

require "Word.php";

class DictionaryAdapter
{

    // Fields
    protected $db;

    // Constructor
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllWords()
    {
        $sql = "SELECT * FROM dictionary";
        $query = $this->db->prepare($sql);
        $query->execute();
        $rows = $query->fetchAll();

        //turn rows into in array so that it can later be easily converted to JSON
        $result = array();
        foreach ($rows as $row) {
            array_push($result, $this->read($row));
        }

        return $result;
    }

    private function read($row)
    {
        // Format date
        //$date = new DateTime($row["post_date"]);
        //$formatted_date = $date->format('m/d/Y');
        $result = new Word();
        $result->word= $row["word"];
        $result->definition = $row["definition"];
        return $result;
    }


}
