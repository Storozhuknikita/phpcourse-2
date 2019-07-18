<?php


namespace App\traits;


trait TSingleton
{
    protected function __construct() {}

    protected function __clone() {}

    protected function __wakeup() {}

    /**
     * @return mixed Singleton
     */
    public static function getInstance(){

        if(empty(static::$items)){
            static::$items = new static();
        }

        return static::$items;

    }
}