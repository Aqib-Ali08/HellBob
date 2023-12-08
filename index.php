<?php
session_start();
include('config/db.php');
$request_uri = $_SERVER['REQUEST_URI'];
$routes = [
    '/' => 'public/index.php',
    '/product' => 'public/product.php',
    '/cart' => 'public/cart.php',
    '/checkout' => 'public/checkout.php',
    '/admin' => 'admin/login.php',
];

if (array_key_exists($request_uri, $routes)) {
    include($routes[$request_uri]);
} else {
    echo "404 Not Found";
}
