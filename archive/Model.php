<?php


class Model {

    /*
     * Get
     */
    public function __get($name)
    {
        echo 'Нет такого свойства '. $name;
        // TODO: Implement __get() method.
    }

    /*
     * Set
     */
    public function __set($name, $value)
    {
        echo 'Нет такого свойства '. $name;
        echo 'Значение '. $value .' не сохранено';

        // TODO: Implement __set() method.
    }

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