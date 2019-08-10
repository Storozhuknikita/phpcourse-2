<?php

class Good {

    const STATUS_OK = 'Доставлено';
    const STATUS_ERROR = 'Ошибка доставки';



    public static $count = 0;
    public $id;
    public $price;
    public $name;
    public $info;

    public function __construct($id, $price, $name, $info){

        $this->id = $id;
        $this->price = $price;
        $this->name = $name;
        $this->info = $info;

    }

    /*
     * Get
     */
    public function __get($name)
    {
        echo 'Нет такого свойства '. $name;
        // TODO: Implement __get() method.
    }

    public function __set($name, $value)
    {
        echo 'Нет такого свойства '. $name;
        echo 'Значение '. $value .' не сохранено';

        // TODO: Implement __set() method.
    }

    public static function getCount(){
        return self::$count;
    }

    public static function setCount($count){
        return self::$count = $count;
    }

    public function getPrice(){

        $price = <<<php
        <p>{$this->price} р.</p>
php;

        return $price;

    }

    public function getContent(){

        $count = static::$count++;

        echo "hello world";
        $content =  <<<tyut
        <p>{$count} {$this->id}</p>
        <h3>{$this->name}</h3>
tyut;

        return $content;
    }

    public function display() {

        $content = $this->getContent();
        $content .= $this->getPrice();
        echo $content;
    }

}

$good = new Good(1, 50, 'Стул', 'Стул хороший');
$good::$count++;

echo $good::STATUS_ERROR;

echo $good::setCount(100);
echo $good::getCount();

$good->display();
var_dump($good);

$good2 = new Good;
$good2->init(1, 50, 'Стол', 'Стол хороший');


var_dump($good2);

