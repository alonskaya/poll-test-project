<?php

namespace App\Kernel\ServiceInitializer;

use Klein\Klein;

/**
 * Interface ServiceInitializerInterface
 * @package App\Kernel\ServiceInitializer
 */
interface ServiceInitializerInterface
{
    /**
     * @param Klein $klein
     *
     * @return callable
     */
    public static function initService(Klein $klein): callable;
}
