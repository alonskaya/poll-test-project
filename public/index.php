<?php

use Klein\Klein;
use Klein\Request;

require_once __DIR__ . '/../vendor/autoload.php';

$klein   = new Klein();
$request = Request::createFromGlobals();

// Init global lazy-loading services
$services = (include __DIR__ . '/../config/services.php');

foreach ($services as $serviceName => $serviceClass) {
    $klein->app()->register($serviceName, call_user_func([$serviceClass, 'initService'], $klein));
}

// Init routes
$klein->app()->routesManager->init();

$klein->dispatch($request);
