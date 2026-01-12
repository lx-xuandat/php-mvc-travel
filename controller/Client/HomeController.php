<?php

namespace Controller\Client;

use Controller\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return include __DIR__ . '/../../views/client/cart.php';
    }
}
