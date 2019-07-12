<?php

abstract class Model
{
    /**
     * @var BD Класс для работы с базой данных
     */
    protected $bd;

    public function __construct(IBD $bd)
    {
        $this->bd = $bd;
    }

    /**
     * Данный метод должен вернуть название таблицы
     * @return mixed
     */
    abstract protected function getTableName();

    /**
     * Данный метод возвращает пользователя
     * @param int $id
     * @return array
     */
    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "select * from {$tableName} where id = {$id}";
        $this->bd->find($sql);
        return [];
    }

    /**
     * @return BD
     */
    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "select * from {$tableName}";
        $this->bd->findAll($sql);
        return [];
    }

    /**
     * @return BD
     */
    public function getCount()
    {
        $tableName = $this->getTableName();
        $sql = "select * from {$tableName}";
        $this->bd->getCount($sql);
        return [];
    }

}