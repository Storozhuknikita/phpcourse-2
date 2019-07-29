<?php
return [
    'rootName' => $_SERVER['DOCUMENT_ROOT'] .'/../',
    'name' => 'Мой магазин',
    'defaultControllerName' => 'user',

    'components' => [
        'bd' => [
            'class' => \App\services\BD::class,
            'config' => [
                'user' => 'root',
                'pass' => '1VZVMFZ8q!',
                'driver' => 'mysql',
                'bd' => 'shop',
                'host' => 'localhost',
                'charset' => 'UTF8'
            ]
        ],
        'userRepository' => [
            'class' => \App\models\repositories\UserRepository::class
        ]
    ],
];