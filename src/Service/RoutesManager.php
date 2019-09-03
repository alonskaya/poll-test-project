<?php

namespace App\Service;

use App\Kernel\ProjectPathKeeper;
use Klein\Klein;

/**
 * Class RoutesManager
 * @package App\Service
 */
class RoutesManager
{
    /**
     * @var Klein
     */
    protected $klein;

    /**
     * RoutesManager constructor.
     *
     * @param Klein $klein
     */
    public function __construct(Klein $klein)
    {
        $this->klein = $klein;
    }

    /**
     * @return mixed
     */
    public function init()
    {
        $routes = (include ProjectPathKeeper::getConfigDirectory() . 'routes.php');

        foreach ($routes as $route => $config) {
            $this->addRoute($config['type'], $config['route'], $config['callback']);
        }
    }

    /**
     * @param string|array $type
     * @param string       $route
     * @param string       $callback
     */
    public function addRoute($type, string $route, string $callback)
    {
        $this->klein->respond($type, $route, $callback);
    }
}
