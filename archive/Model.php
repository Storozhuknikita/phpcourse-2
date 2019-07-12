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

}