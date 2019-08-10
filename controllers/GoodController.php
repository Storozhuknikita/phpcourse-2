<?php
namespace App\controllers;

use App\models\repositories\GoodRepository;

class GoodController extends Controller
{
    protected $defaultAction = 'goods';

    public function goodsAction()
    {
        $params = [
            'goods' =>  (new GoodRepository())->getAll()
        ];

        echo $this->render('goods', $params);
    }

}