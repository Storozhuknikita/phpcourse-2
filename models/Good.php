<?php


class Good extends Model {

    public $id;
    public $name;
    public $price;
    public $info;

    protected function getTableName()
    {
        return 'goods';
        // TODO: Implement getTableName() method.
    }

}