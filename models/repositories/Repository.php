<?php
namespace App\models\repositories;

use App\main\App;
use App\models\entities\Entity;
use App\services\BD;

/**
 * Class Model
 * @package App\models
 *
 * @property int $id
 */
abstract class Repository
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
        $this->bd = App::call()->bd;
    }

    /**
     * Данный метод должен вернуть название таблицы
     * @return string
     */
    abstract protected function getTableName();

    abstract protected function getEntityName();

    /**
     * Возращает запись с указанным id
     *
     * @param int $id ID Записи таблицы
     * @return array
     */
    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->bd->queryObject(
            $sql,
            $this->getEntityName(),
            [':id' => $id]
        );
    }

    /**
     * Получение всех записей таблицы
     * @return mixed
     */
    public  function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} ";
        return $this->bd->queryObjects($sql, $this->getEntityName());
    }
    //INSERT INTO users(fio, login, password) VALUES (:fio, :login, :password)

    protected function insert(Entity $entity)
    {
        $dataForInsert = $this->getDataForInsert($entity);

        $columns = $dataForInsert['columns'];
        $params = $dataForInsert['params'];

        $columnsString = implode(', ', $columns);
        $placeholders = implode(', ', array_keys($params));
        $tableName = $this->getTableName();
        $sql = "INSERT INTO {$tableName} ({$columnsString})
          VALUES ({$placeholders})";
        $this->bd->execute($sql, $params);
        $this->id = $this->bd->lastInsertId();
    }

    protected function update($entity) {

    }

    public function save(Entity $entity) {
        if (empty($this->id)) {
            $this->insert($entity);
            return;
        }
        $this->update($entity);
        return;
    }

    public function delete(Entity $entity)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id ";
        $this->bd->execute($sql, [':id' => $entity->id]);
    }

    protected function getDataForInsert(Entity $entity)
    {
        $columns = [];
        $params = [];
        foreach ($entity as $key => $value) {
            if ($key == 'id' || is_null($value)) {
                continue;
            }
            $columns[] = $key;
            $params[":{$key}"] = $value;
        }
        return [
            'columns' => $columns,
            'params' => $params,
        ];
    }
}
