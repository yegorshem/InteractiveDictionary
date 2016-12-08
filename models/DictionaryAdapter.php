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

    public function getAllWords($class_id, $deleted)
    {
        $sql = "SELECT dictionary.id, dictionary.word, dictionary.definition, dictionary.category, dictionary.image, dictionary.created_by, dictionary.creator_id, dictionary.deleted, class.class_name FROM dictionary INNER JOIN  class ON dictionary.class_id = class.class_id WHERE dictionary.class_id = :class_id AND dictionary.deleted = :deleted";
        $statement = $this->db->prepare($sql);

        $statement->bindValue(':class_id', $class_id, PDO::PARAM_INT);
        $statement->bindValue(':deleted', $deleted, PDO::PARAM_INT);


        $statement->execute();
        $rows = $statement->fetchAll();

        //turn rows into in array so that it can later be easily converted to JSON
        $result = array();
        foreach ($rows as $row) {
            array_push($result, $this->read($row));
        }

        return $result;
    }

    public function getStudentWords($creator_id, $deleted, $graded)
    {
        $sql = "SELECT dictionary.id, dictionary.word, dictionary.definition, dictionary.category, dictionary.image, dictionary.created_by, dictionary.creator_id, dictionary.graded, dictionary.deleted, class.class_name FROM dictionary INNER JOIN  class ON dictionary.class_id = class.class_id WHERE dictionary.creator_id = :creator_id AND dictionary.deleted = :deleted AND dictionary.graded = :graded";
        $statement = $this->db->prepare($sql);

        $statement->bindValue(':creator_id', $creator_id, PDO::PARAM_INT);
        $statement->bindValue(':graded', $graded, PDO::PARAM_INT);
        $statement->bindValue(':deleted', $deleted, PDO::PARAM_INT);



        $statement->execute();
        $rows = $statement->fetchAll();

        //turn rows into in array so that it can later be easily converted to JSON
        $result = array();
        foreach ($rows as $row) {
            array_push($result, $this->read($row));
        }

        return $result;
    }


    public function getGradedWords($class_code, $deleted, $graded)
    {
        $sql = "SELECT dictionary.id, dictionary.word, dictionary.definition, dictionary.category, dictionary.image, dictionary.created_by, dictionary.creator_id, dictionary.graded, dictionary.deleted, class.class_name FROM dictionary INNER JOIN  class ON dictionary.class_id = class.class_id WHERE dictionary.class_id = :class_code AND dictionary.deleted = :deleted AND dictionary.graded = :graded";
        $statement = $this->db->prepare($sql);

        $statement->bindValue(':class_code', $class_code, PDO::PARAM_INT);
        $statement->bindValue(':graded', $graded, PDO::PARAM_INT);
        $statement->bindValue(':deleted', $deleted, PDO::PARAM_INT);


        $statement->execute();
        $rows = $statement->fetchAll();

        //turn rows into in array so that it can later be easily converted to JSON
        $result = array();
        foreach ($rows as $row) {
            array_push($result, $this->read($row));
        }

        return $result;
    }

    public function getDeletedWords()
    {
        $sql = "SELECT dictionary.id, dictionary.word, dictionary.definition, dictionary.category, dictionary.image, dictionary.created_by, dictionary.creator_id, dictionary.graded, dictionary.deleted, class.class_name FROM dictionary INNER JOIN  class ON dictionary.class_id = class.class_id WHERE dictionary.deleted = 1";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $rows = $statement->fetchAll();

        //turn rows into in array so that it can later be easily converted to JSON
        $result = array();
        foreach ($rows as $row) {
            array_push($result, $this->read($row));
        }

        return $result;
    }

    private function read($row)
    {
        $result = new Word();
        $result->id = $row['id'];
        $result->word = $row['word'];
        $result->definition = $row['definition'];
        $result->image = $row['image'];
        $result->category = $row['category'];
        $result->created_by = $row['created_by'];
        $result->creator_id = $row['creator_id'];
        $result->class_name = $row['class_name'];
        $result->class_id = $row['class_id'];
        $result->graded = $row['graded'];
        $result->deleted = $row['deleted'];
        return $result;
    }

    public function submitWord($word, $definition, $image, $category, $created_by, $creator_id, $class_id, $graded, $deleted)
    {

        $sql = "INSERT INTO dictionary (word, definition, image, category, created_by, creator_id, class_id, graded, deleted) VALUES (:word, :definition, :image, :category, :created_by, :creator_id, :class_id, :graded, :deleted)";
        $statement = $this->db->prepare($sql);

        $statement->bindValue(':word', $word, PDO::PARAM_STR);
        $statement->bindValue(':definition', $definition, PDO::PARAM_STR);
        $statement->bindValue(':image', $image, PDO::PARAM_STR);
        $statement->bindValue(':category', $category, PDO::PARAM_STR);
        $statement->bindValue(':created_by', $created_by, PDO::PARAM_STR);
        $statement->bindValue(':creator_id', $creator_id, PDO::PARAM_INT);
        $statement->bindValue(':class_id', $class_id, PDO::PARAM_INT);
        $statement->bindValue(':graded', $graded, PDO::PARAM_INT);
        $statement->bindValue(':deleted', $deleted, PDO::PARAM_INT);


        $statement->execute();
    }

    public function updateWord($id, $word, $definition, $category)
    {

        $sql = "UPDATE dictionary SET word= :word, definition= :definition, category= :category WHERE id= :id";
        $statement = $this->db->prepare($sql);

        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':word', $word, PDO::PARAM_STR);
        $statement->bindValue(':definition', $definition, PDO::PARAM_STR);
        $statement->bindValue(':category', $category, PDO::PARAM_STR);


        $statement->execute();
    }

    public function deleteWord($id)
    {
        $sql = "UPDATE dictionary SET deleted = 1 WHERE id= :id";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function deleteWordForever($id)
    {
        $sql = "SELECT * FROM dictionary WHERE id= :id";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();

        foreach($result as $row) {
            $imagename = $row['image'];
            unlink("../uploads/" . $imagename);
        }

        $sql = "DELETE FROM dictionary WHERE id= :id";
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
}
