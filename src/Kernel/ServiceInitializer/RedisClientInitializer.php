<?php

namespace App\Kernel\ServiceInitializer;

use Klein\Klein;
use Predis\Client;

/**
 * Class RedisClientInitializer
 * @package App\Kernel\ServiceInitializer
 */
class RedisClientInitializer implements ServiceInitializerInterface
{
    /**
     * @param Klein $klein
     *
     * @return callable
     */
    public static function initService(Klein $klein): callable
    {
        return static function () {
            $redisClient = new Client(
                [
                    'host' => getenv('REDIS_HOST'),
                    'port' => getenv('REDIS_PORT')
                ]
            );

            return $redisClient;
        };
    }
}
