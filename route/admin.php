<?php

use Controller\Admin\DashboardController;

return [
    '/admin' => [
        'controller' => DashboardController::class,
        'action' => 'index',
    ],
];