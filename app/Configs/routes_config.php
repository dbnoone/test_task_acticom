<?php

use App\Modules\Products\Products;

$config = [
    '/' => [
        'type' => 'module',
        'class' => Products::class,
        'method' => 'load',
        'title' => 'Загрузка файла'
    ],
    '/load' => [
        'type' => 'module',
        'class' => Products::class,
        'method' => 'load',
        'title' => 'Загрузка файла'
    ],
    '/list' => [
        'type' => 'module',
        'class' => Products::class,
        'method' => 'list',
        'title' => 'Список товаров'
    ],
    '/404' => [
        'type' => 'template',
        'template' => '404',
        'title' => 404
    ]
];