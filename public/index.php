<?php


error_reporting(E_ALL && E_NOTICE);

/**
* Homework 4
 * Реализовать методы update, delete и save.
 * Оптимизировать код ранее написанный код.
 * Реализовать вывод товаров, товара.

 * Homework 5
 * 1. Оставить только один загрузщик классов.
    2. Разобраться как работает twig.
    3. Добавить шаблоны для твиг и новый layout.
    4*. Реализовать TwigRenderServices, чтобы он производил рендер шаблонов.
 */

include '../services/Autoload.php';
include '../vendor/autoload.php';

spl_autoload_register(
    [new Autoload(),
        'loadClass']
);

$controllerName = $_GET['c'] ?: 'user';
$actionName = $_GET['a'];

$controllerClass = 'App\\controllers\\' .
    ucfirst($controllerName) . 'Controller';
if (class_exists($controllerClass)) {
    $controller = new $controllerClass(new \App\services\renders\TmplRenderServices());
    $controller->run($actionName);
}

//$loader = new \Twig\Loader\ArrayLoader([
//    'index' => 'Hello {{ name }}!',
//]);
//$a = new \Twig\Environment($loader);






