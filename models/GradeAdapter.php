<?php

/**
 * Created by PhpStorm.
 * User: Joel
 * Date: 11/17/2016
 * Time: 8:00 PM
 */

require "Grade.php";

class gradeAdapter
{
    // Fields
    protected $db;

    // Constructor
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function createNewGrade($word, $definition, $category, $image, $score, $comment, $word_id)
    {
        $sql = "INSERT INTO grading (word, definition, category, image, score, comment, word_id) VALUES (:word, :definition, :category, :image, :score, :comment, :word_id)";
        $statement = $this->db->prepare($sql);

        //bind params
        $statement->bindValue(':word', $word, PDO::PARAM_INT);
        $statement->bindValue(':definition', $definition, PDO::PARAM_INT);
        $statement->bindValue(':image', $image, PDO::PARAM_INT);
        $statement->bindValue(':category', $category, PDO::PARAM_INT);
        $statement->bindValue(':score', $score, PDO::PARAM_INT);
        $statement->bindValue(':comment', $comment, PDO::PARAM_STR);
        $statement->bindValue(':word_id', $word_id, PDO::PARAM_INT);

        $statement->execute();

        $count = $statement->rowCount();

        return $count;
    }

    public function gradeWord($graded, $word_id)
    {
        $sql = "UPDATE dictionary SET graded= :graded WHERE id= :id";
        $statement = $this->db->prepare($sql);

        $statement->bindValue(':graded', $graded, PDO::PARAM_INT);
        $statement->bindValue(':id', $word_id, PDO::PARAM_INT);

        $statement->execute();
    }

    public function getGrades($creator_id, $deleted)
    {
        $sql = "SELECT grading.grade_id, grading.word, grading.definition, grading.category, grading.image, grading.score, grading.comment, grading.word_id, dictionary.word AS wordTxt, dictionary.creator_id, dictionary.deleted FROM grading INNER JOIN dictionary ON grading.word_id = dictionary.id WHERE dictionary.creator_id = :creator_id AND dictionary.deleted = :deleted";
        $statement = $this->db->prepare($sql);

        $statement->bindValue(':creator_id', $creator_id, PDO::PARAM_INT);
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

    private function read($row)
    {
        $result = new Grade();
        $result->grade_id = $row['grade_id'];
        $result->wordTxt = $row['wordTxt'];
        $result->word = $row['word'];
        $result->definition = $row['definition'];
        $result->category = $row['category'];
        $result->image = $row['image'];
        $result->score = $row['score'];
        $result->comment = $row['comment'];
        $result->word_id = $row['word_id'];
        return $result;
    }
}