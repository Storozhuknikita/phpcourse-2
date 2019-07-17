<?php

/**
 * Homework 3
 * 1. Почитать про паттерны проектирования.
 * 2. В результате поиска одной записи возвращать объект с заполненными данными, а в результате поиска всех записей - массив из таких объектов.
 * 3. Реализовать CRUD.
 * 4. Объединить методы update и insert в метод save.
 */
error_reporting(E_ALL && E_NOTICE);

function debug($text){
    echo '<pre>'; print_r($text); echo '</pre>';
}

use \App\models\User;
use \App\models\Good;
use \App\services\BD;

include '../services/Autoload.php';

spl_autoload_register([new Autoload(),'loadClass']);

$user = new User();

$users = $user->getAll();

foreach ($users as $row) {
    echo 'UserId: '.$row['user_id'].'<br/>';
    echo 'User Name: '.$row['user_name'].'<br/>';
    echo 'User Login: '.$row['user_login'].'<br/>';
    echo '<hr>';
}


debug($users);



//echo debug($user);
//debug($user->getProperties());