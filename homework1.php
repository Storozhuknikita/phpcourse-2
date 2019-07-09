<?php
/*
 * 1. Придумать класс, который описывает любую сущность из предметной области интернет-магазинов: продукт, ценник, посылка и т.п.

2. Описать свойства класса из п.1 (состояние).

3. Описать поведение класса из п.1 (методы).

4. Придумать наследников класса из п.1. Чем они будут отличаться?

5. Дан код:

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo();
Что он выведет на каждом шаге? Почему?

Немного изменим п.5:

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A();
$b1 = new B();
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();
6. Объясните результаты в этом случае.

7. *Дан код:

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A;
$b1 = new B;
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();
Что он выведет на каждом шаге? Почему?
 */

include_once 'Model.php';

class Product extends Model {

    protected $product_id;
    protected $product_articul;
    protected $product_name;
    protected $product_type;
    protected $product_price;

    public function __construct($product_id, $product_articul, $product_name, $product_type, $product_price)
    {
        $this->product_id = $product_id;
        $this->product_articul = $product_articul;
        $this->product_name = $product_name;
        $this->product_type = $product_type;
        $this->product_price = $product_price;
    }

}
