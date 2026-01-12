<?php

use Controller\Client\CartController;

return [
    '/cart' => [
        'controller' => CartController::class,
        'action' => 'index',
    ],
];