<?php

namespace App\models\entities;
use App\services\StringService;

/**
 * Class Good
 * @package App\models\entities
 */
class Good extends Entity
{
    public $id;
    public $price;
    public $name;
    public $info;

    private $a; //todo удалить

    public function getPreviewInfo($p = 10)
    {
        if (empty($p)) {
            $p = 10;
        }

        return $this->getStringService()
            ->cutString($this->info, $p);
    }

    public function getStringService()
    {
        return new StringService();
    }

    public function getA()
    {
        return $this->a;
    }

    private function getAF($string)
    {
        return $this->a . " $string";
    }
}
