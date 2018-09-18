<?php
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);
    ini_set('display_errors', 1);

    require_once 'autoload.php';
    require_once __DIR__ . '/model/Connect.php';

    $route = new Route('controller/');
    $route -> start();
