<?php

namespace App\models;

class User extends Model
{

    public $user_id;
    public $user_name;
    public $user_login;
    public $user_password;

    protected function getTableName()
    {
        return 'users';
        // TODO: Implement getTableName() method.
    }

    /**
     * @return array
     */
    public function getProperties(){
        $properties = [];
        foreach($this as $key => $value){
            $properties[] = $key;
        }

        return $properties;
    }


}
