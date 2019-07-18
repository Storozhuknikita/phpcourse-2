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
use \App\services\BD;

include '../services/Autoload.php';

spl_autoload_register([new Autoload(),'loadClass']);

$controllerName = $_GET['c'] ?: 'user';
$actionName = $_GET['a'];

$controllerClass = 'App\\controllers\\'.ucfirst($controllerName).'Controller';

if(class_exists($controllerClass)){
    $controller = new $controllerClass;
    $controller->run($actionName);
}

/*$user = new User;

debug($user->getAll());


$user->user_name = 'Name';
$user->user_login = 'FFF';
$user->user_password = 'Password';
$user->is_admin = 0;

$user->save();
*/
