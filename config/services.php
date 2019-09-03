<?php

use App\Kernel\ServiceInitializer\FormFactoryInitializer;
use App\Kernel\ServiceInitializer\RedisClientInitializer;
use App\Kernel\ServiceInitializer\RoutesManagerInitializer;
use App\Kernel\ServiceInitializer\TwigInitializer;

return [
    'routesManager'   => RoutesManagerInitializer::class,
    'twigEnvironment' => TwigInitializer::class,
    'formFactory'     => FormFactoryInitializer::class,
    'redisClient'     => RedisClientInitializer::class,
];
