<?php

namespace App\models;

use App\services\BD;
use App\services\IBD;

/**
 * Class Model
 * @package App\models
 */
abstract class Model {

    /**
     * @var mixed
     */
    protected $bd;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->bd = BD::getInstance();
    }

    /**
     * @return mixed
     */
    abstract protected function getTableName();

    public function getOne($id){
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM ($tableName) WHERE user_id = :user_id";
        return $this->bd->find($sql, [':id' => $id]);
    }

    public function getAll(){
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM ($tableName)";
        return $this->bd->findAll($sql);
    }



}