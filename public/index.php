<?php


error_reporting(E_ALL && E_NOTICE);
/**
 * 1) Корневой namespace: (App) \service\autoload; Соответствует структуре каталогов
 * 2) Переписать autoload без файлов
 * 3) Создать структуру классов ведения товарной номенклатуры.
        а) Есть абстрактный товар.
        б) Есть цифровой товар, штучный физический товар и товар на вес.
        в) У каждого есть метод подсчета финальной стоимости.
        г) У цифрового товара стоимость постоянная – дешевле штучного товара в два раза. У штучного товара обычная стоимость, у весового – в зависимости от продаваемого количества в килограммах. У всех формируется в конечном итоге доход с продаж.
        д) Что можно вынести в абстрактный класс, наследование?
 * 4) *Реализовать паттерн Singleton при помощи traits.
 */

function debug($text){
    echo '<pre>'; print_r($text); echo '</pre>';
}


use \App\models\User;
use \App\models\Good;
use \App\services\BD;

include '../services/Autoload.php';

spl_autoload_register([new Autoload(),'loadClass']);

$user = new User();
echo debug($user);

debug($user->getProperties());