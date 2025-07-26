<?php

use DevNoKage\App;
use DevNoKage\Enums\ClassName;
use DevNoKage\Enums\KeyRoute;

$routes = [
    '/' => [
        KeyRoute::CONTROLLER->value => App::getDependencie(ClassName::ERROR_CONTROLLER),
        KeyRoute::METHOD->value => '_404',
        KeyRoute::MIDDLEWARE->value => []
    ],
    '/404' => [
        KeyRoute::CONTROLLER->value => App::getDependencie(ClassName::ERROR_CONTROLLER),
        KeyRoute::METHOD->value => '_404',
        KeyRoute::MIDDLEWARE->value => []
    ]
];