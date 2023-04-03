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
        $builder->where('password', $password);
        $query = $builder->get();
        if ($query->getRowArray()) {
            return true;
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
}
