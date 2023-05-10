<?php

namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model
{
    public function login($username, $password)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('username', $username);
        $query = $builder->get();
        $user = $query->getRow();
        if ($user) {
            if (password_verify($password, $user->password)) {
                return true;
            }
        }
        return false;
    }

    public function signUp($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        if ($builder->insert($data)){
            return true;
        } else {
            return false;
        }
    }

    public function getUserId($username)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT id
            FROM users
            WHERE username = '".$username."'");

        $user = $query->getRow();
        return $user->id;

    }

    public function checkStaff($username)
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT isStaff
            FROM users
            WHERE username = '".$username."'");

        $user = $query->getRow();
        if (is_null($user->isStaff)){
            return 0;
        } else {
            return 1;
        }
    }
    public function updateCredentials($field, $username, $new)
    {
        $db = \Config\Database::connect();

        $query = $db->query("UPDATE users
        SET $field = '$new'
        WHERE username = '$username'");
    }

    public function boost($subject, $user, $question) 
    {
        $id = $this->getUserId($user);

        $data['user_id'] = $id;
        $data['subject_id'] = $subject;
        $data['question_id'] = $question;
        $data['timestamp'] = date('Y-m-d H:i:s', strtotime('now'));

        $db = \Config\Database::connect();
        $builder = $db->table('likes');
        $builder->insert($data);

        $db->query("UPDATE questions
        SET likes = likes + 1
        WHERE id = '$question'");
    }
}
