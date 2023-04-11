<?php

namespace App\Models;

use CodeIgniter\Model;

class subject_model extends Model
{
    public function getAllSubjects(){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT id, name, description FROM subjects');
        $subjects = $query->getResult();
        return $subjects;
    }

    public function getQuestions($subject){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT id, user_id, title, description FROM questions 
        WHERE subjectID = '.$subject.' ORDER BY time DESC');
        $questions = $query->getResult();
        return $questions;
    }

    public function addQuestion($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('questions');
        if ($builder->insert($data)){
            return true;
        } else {
            return false;
        }
    }

    public function addAnswer($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('answers');
        if ($builder->insert($data)){
            return true;
        } else {
            return false;
        }
    }


    public function getUserQuestions($username)
    {
        $db = \Config\Database::connect();
            $query = $db->query("SELECT q.id, q.title, q.description, s.name as subject_name, q.likes FROM questions q
            INNER JOIN subjects s ON q.subjectID = s.id
            INNER JOIN users u ON q.user_id = u.id
            WHERE u.username = '".$username."'");

        $questions = $query->getResult();
        return $questions;
    }

    public function getAnswers($questionId)
    {
        $db = \Config\Database::connect();
        $query = $db->query('SELECT id, description, likes FROM answers 
        WHERE question_id = '.$questionId.' ORDER BY likes DESC');
        $answers = $query->getResult();
        return $answers;
    }

}
?>