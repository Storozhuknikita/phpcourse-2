<?php


class User extends Model
{

    use CalcRows;

    public $id;
    public $name;
    public $login;
    public $password;

    protected function getTableName()
    {
        return 'users';
        // TODO: Implement getTableName() method.
    }
}
