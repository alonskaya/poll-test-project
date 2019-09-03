<?php

namespace App\Kernel;

/**
 * Class ProjectPathKeeper
 * @package App\Kernel
 */
class ProjectPathKeeper
{
    /**
     * @return string
     */
    public static function getRootDirectory(): string
    {
        return __DIR__ . '/../../';
    }

    /**
     * @return string
     */
    public static function getConfigDirectory(): string
    {
        return self::getRootDirectory() . 'config/';
    }

    /**
     * @return string
     */
    public static function getTemplatesDirectory(): string
    {
        return self::getRootDirectory() . 'views/';
    }
}
