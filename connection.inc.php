<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!defined('SERVER_PATH')) {
    define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'] . 'Hellbob');
}

if (!defined('SITE_PATH')) {
    define('SITE_PATH', 'http://127.0.0.1/Hellbob/');
}

if (!defined('PRODUCT_IMAGE_SERVER_PATH')) {
    define('PRODUCT_IMAGE_SERVER_PATH', SERVER_PATH . 'assets/images/core_team_memb/');
}

if (!defined('PRODUCT_IMAGE_SITE_PATH')) {
    define('PRODUCT_IMAGE_SITE_PATH', SITE_PATH . 'assets/images/core_team_memb/');
}

$con = mysqli_connect("localhost", "root", "", "test");

// Rest of your code...
?>
