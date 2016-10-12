<?php

/**
 * Created by PhpStorm.
 * User: Yegor Shemereko
 * Date: 10/7/2016
 * Time: 3:10 PM
 */

require "Word.php";
/**
 * This page is created to work with dictionary table
 */
/**
 * The dictionaryAdapter class is used to select, insert, update and delete word
 */
 class DictionaryAdapter
{
    // Fields
    protected $db;

    // Constructor
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

     /**
      * This method is used to return an array of all the results fron the query
      *
      * @return array
      */
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

        $result = new Word();
        $result->id = $row['id'];
        $result->word = $row['word'];
        $result->definition = $row['definition'];
        return $result;
    }
    /**
     * This method is used to submit a word into the table
     * void
     */
    public function submitWord($word, $definition)
    {
        $sql = "INSERT INTO dictionary (word, definition) VALUES (:word, :definition)";
        $statement = $this->db->prepare($sql);

        $statement->bindValue(':word', $word, PDO::PARAM_STR);
        $statement->bindValue(':definition', $definition, PDO::PARAM_STR);

        $statement->execute();
    }

    public function updateWord($id, $word, $definition)
    {

        $sql = "UPDATE dictionary SET word= :word, definition= :definition WHERE id= :id";
        $statement = $this->db->prepare($sql);

        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':word', $word, PDO::PARAM_STR);
        $statement->bindValue(':definition', $definition, PDO::PARAM_STR);

        $statement->execute();
    }

    public function deleteWord($id)
    {

        $sql = "DELETE FROM dictionary WHERE id= :id";
        $statement = $this->db->prepare($sql);

        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

}
