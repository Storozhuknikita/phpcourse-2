<?php

namespace App\services;

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

    private $config = [
        'user' => 'root',
        'password' => '1VZVMFZ8q!',
        'driver' => 'mysql',
        'dbname' => 'shop',
        'host' => 'localhost',
        'charset' => 'UTF8'
    ];

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

    private function getDSN()
    {
        return sprintf('%s:host=%s;dbname=%s;charset=%s',
            $this->config['driver'], $this->config['host'], $this->config['dbname'], $this->config['charset']
        );
    }


    public function quer123y(string $sql, array $params = [])
    {
        $PDOStatement = $this->getConnect()->prepare($sql);
        $PDOStatement->execute($params);
        //var_dump($PDOStatement);
        return $PDOStatement;
    }

    public function find(string $sql)
    {
        return $this->getConnect()->query($sql);
    }

    public function findAll(string $sql)
    {
        return $this->getConnect()->query($sql);
    }

    public function getCount()
    {
        echo 'true';
    }
}