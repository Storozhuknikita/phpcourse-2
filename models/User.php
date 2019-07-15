<?php

namespace App\models;

class User extends Model
{

    public $id;
    public $name;
    public $login;
    public $password;

    protected function getTableName()
    {
        return 'users';
        // TODO: Implement getTableName() method.
    }

    public function getProperties(){
        $properties = [];
        foreach($this as $key => $value){
            $properties[] = $key;
        }

        return $properties;
    }


}
