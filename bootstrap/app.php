<?php


use Controller\Client\HomeController;

require __DIR__ . '/../vendor/autoload.php';

$page = (function () {
    $client = require_once __DIR__ . '/../route/client.php';
    $admin = require_once __DIR__ . '/../route/admin.php';
    $routes = [
        '/' => [
            'controller' => HomeController::class,
            'action' => 'index',
        ],
        ...$client,
        ...$admin,
    ];

    // Lấy path từ URL
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    if (isset($routes[$uri])) {
        $controller = $routes[$uri]['controller'];
        $action = $routes[$uri]['action'];
    } else {
        $controller = HomeController::class;
        $action = 'index';
    }

    // Tạo instance controller
    if (class_exists($controller)) {
        $instance = new $controller();

        if (method_exists($instance, $action)) {
            // Gọi action
            // $instance->$action();

        } else {
            throw new Exception("Action $action không tồn tại trong $controller");
        }
    } else {
        throw new Exception("Controller $controller không tồn tại");
    }

    return new App\Page([
        'title' => 'Admin Page - ' . ($instance->title ?: 'Dashboard'),
        'controller' => $instance,
        'action' => $action,
    ]);
})();