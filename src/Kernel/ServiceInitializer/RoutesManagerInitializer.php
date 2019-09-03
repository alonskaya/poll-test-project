<?php

namespace App\Kernel\ServiceInitializer;

use App\Service\RoutesManager;
use Klein\Klein;

/**
 * Class RoutesManagerInitializer
 * @package App\Kernel\ServiceInitializer
 */
class RoutesManagerInitializer implements ServiceInitializerInterface
{
    /**
     * @param Klein $klein
     *
     * @return callable
     */
    public static function initService(Klein $klein): callable
    {
        return static function () use ($klein) {
            return new RoutesManager($klein);
        };
    }
}
