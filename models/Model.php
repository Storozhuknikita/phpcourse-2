<?php
namespace App\models;

use App\services\BD;

/**
 * Class Model
 * @package App\models
 *
 * @property int $id
 */
abstract class Model
{
    /**
     * @var BD Класс для работы с базой данных
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
     * Данный метод должен вернуть название таблицы
     * @return string
     */
    abstract protected static function getTableName();

    /**
     * Возращает запись с указанным id
     *
     * @param int $id ID Записи таблицы
     * @return array
     */
    public function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return BD::getInstance()->queryObject(
            $sql,
            get_called_class(),
            [':id' => $id]
        );
    }

    /**
     * Получение всех записей таблицы
     * @return mixed
     */
    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} ";
        return BD::getInstance()->queryObjects($sql, get_called_class());
    }
    //INSERT INTO users(fio, login, password) VALUES (:fio, :login, :password)

    protected function insert()
    {
        $columns = [];
        $params = [];

        foreach ($this as $key => $value) {
            if ($key == 'bd') {
                continue;
            }
            $columns[] = $key;
            $params[":{$key}"] = $value;
        }

        $columnsString = implode(', ', $columns);
        $placeholders = implode(', ', array_keys($params));
        $tableName = static::getTableName();
        $sql = "INSERT INTO {$tableName} ({$columnsString})
          VALUES ({$placeholders})";
        $this->bd->execute($sql, $params);
        $this->id = $this->bd->lastInsertId();
    }

    protected function update() {

    }

    public function save() {
        if (empty($this->id)) {
            $this->insert();
            return;
        }
        $this->update();
        return;
    }

    public function delete()
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id ";
        $this->bd->execute($sql, [':id' => $this->id]);
    }
}
