<?php

namespace App\models;

use App\services\BD;
use App\services\IBD;

/**
 * Class Model
 * @package App\models
 */
abstract class Model
{

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
     * Поиск одной записи
     */
    abstract protected function getTableName();

    public static function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM ($tableName) WHERE id = :id";
        return BD::getInstance()->queryObject(
            $sql,
            get_called_class(),
            [':id' => $id]
        );
    }

    /**
     * @return mixed
     * Поиск всех записей
     */
    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM ($tableName)";
        return BD::getInstance()->queryObjects(
            $sql,
            get_called_class()
        );
    }

    /**
     *
     */
    public function insert()
    {
        $col = [];
        $params = [];

        foreach ($this as $key => $value) {
            if ($key == 'bd') {
                continue;
            }
            $col[] = $key;
            $params[":{$key}"] = $value;
        }

        $colString = implode(', ', $col);
        $placeholders = implode(', ', array_keys($params));

        $tableName = static::getTableName();

        $sql = "INSERT INTO {$tableName} ({$colString}) VALUES ({$placeholders})";

        var_dump($this->bd);

        $this->bd->execute($sql, $params);

        $this->id = $this->bd->lastInsertId();
    }


    protected function update()
    {
        return true;
    }


    public function save()
    {
        if (empty($this->id)) {
            $this->insert();
        }

        $this->update();

        return true;
    }

}