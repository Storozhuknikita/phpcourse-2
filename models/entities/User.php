<?php

namespace App\models\entities;

class User extends Entity
{

    public $id;
    public $user_name;
    public $user_login;
    public $user_password;
    public $date;
    public $is_admin;

    public function getFullName()
    {
        return $this->user_login . '| ' . $this->user_name;
    }

}