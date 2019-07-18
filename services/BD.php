<?php

namespace App\services;

use App\models\User;
use App\services\IBD;
use App\traits\TSingleton;


class BD implements IBD
{

    use TSingleton;

    protected $connect = null;
    private static $items;

    /**
     * @var array Config
     */

    /**
     * @var array
     */
    private $config = [
        'user' => 'root',
        'password' => '1VZVMFZ8q!',
        'driver' => 'mysql',
        'dbname' => 'shop',
        'host' => 'localhost',
        'charset' => 'UTF8'
    ];

    /**
     * @return \PDO|null
     */
    protected function getConnect()
    {
        if(empty($this->connect)){
            $this->connect = new \PDO(
                $this->getDSN(),
                $this->config['user'],
                $this->config['password']
            );

            $this->connect->setAttribute(
                \PDO::ATTR_DEFAULT_FETCH_MODE,
                \PDO::FETCH_ASSOC
            );
        }

        return $this->connect;
    }

    /**
     * @return string
     */
    private function getDSN()
    {
        return sprintf('%s:host=%s;dbname=%s;charset=%s',
            $this->config['driver'], $this->config['host'], $this->config['dbname'], $this->config['charset']
        );
    }

    /**
     * @param string $sql
     * @param array $params
     * @return bool|\PDOStatement
     */
    public function query(string $sql, array $params = [])
    {
        $PDOStatement = $this->getConnect()->prepare($sql);
        $PDOStatement->execute($params);
        //var_dump($PDOStatement);
        return $PDOStatement;
    }

    /**
     * @param string $sql
     * @param $class
     * @param array $params
     * @return mixed
     */
    public function queryObject(string $sql, $class, array $params = [])
    {
        $PDOStatement = $this->query($sql, $params);
        $PDOStatement->setFetchMode(\PDO::FETCH_CLASS, $class);
        return $PDOStatement->fetch();
    }

    /**
     * @param string $sql
     * @param $class
     * @param array $params
     * @return mixed
     */
    public function queryObjects(string $sql, $class, array $params = [])
    {
        $PDOStatement = $this->query($sql, $params);
        $PDOStatement->setFetchMode(\PDO::FETCH_CLASS, $class);
        return $PDOStatement->fetchAll();
    }

    /**
     * @return string
     */
    public function lastInsertId()
    {
        return $this->getConnect()->lastInsertId();
    }


    public function find()
    {
        return true;
    }

    public function findAll()
    {
            return true;
    }

    public function getCount()
    {
        echo 'true';
    }

    public function execute($sql, $params)
    {
        $this->query($sql, $params);
    }
}