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

}
?>