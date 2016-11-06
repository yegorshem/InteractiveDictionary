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
        $sql = "SELECT dictionary.id, dictionary.word, dictionary.definition, dictionary.category, dictionary.image, dictionary.created_by, class.class_name FROM dictionary INNER JOIN  class ON dictionary.class_id = class.class_id WHERE dictinary.class_id = ".$_SESSION['class_code'];

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
        $result->image = $row['image'];
        $result->category = $row['category'];
        $result->created_by = $row['created_by'];
        $result->class_name = $row['class_name'];
        return $result;
    }

    public function submitWord($word, $definition, $image, $category, $created_by, $class_id)
    {

        $sql = "INSERT INTO dictionary (word, definition, image, category, created_by, class_id) VALUES (:word, :definition, :image, :category, :created_by, :class_id)";
        $statement = $this->db->prepare($sql);

        $statement->bindValue(':word', $word, PDO::PARAM_STR);
        $statement->bindValue(':definition', $definition, PDO::PARAM_STR);
        $statement->bindValue(':image', $image, PDO::PARAM_STR);
        $statement->bindValue(':category', $category, PDO::PARAM_STR);
        $statement->bindValue(':created_by', $created_by, PDO::PARAM_STR);
        $statement->bindValue(':class_id', $class_id, PDO::PARAM_INT);

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
