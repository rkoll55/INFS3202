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
            echo $password;
            echo '</br>';
            echo $user->password;
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
}
