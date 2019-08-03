<?php

namespace App\main;

use App\models\repositories\BookingRepository;
use App\models\repositories\UserRepository;
use App\services\BD;
use App\traits\TSingleton;

/**
 * Class App
 * @package App\main
 * @property BD bd
 * @property UserRepository userRepository
 * @property BookingRepository bookingRepository
 */
class App
{
    use TSingleton;

    private $config;
    private $componentsData;
    private $components = [];

    static public function call() :App
    {
        return static::getInstance();
    }

    public function run($config)
    {
        $this->config = $config;
        $this->componentsData = $config['components'];
        $this->runController();
    }


    public function getConfig($key)
    {
        if ($key == 'components') {
            return [];
        }

        return array_key_exists($key, $this->config)
            ? $this->config[$key]
            : [];
    }

    private function runController()
    {
        $request = new \App\services\Request();

        $defaultControllerName = $this->config['defaultControllerName'];
        $controllerName = $request->getControllerName() ?: $defaultControllerName;
        $actionName = $request->getActionName();

        $controllerClass = 'App\\controllers\\' .
            ucfirst($controllerName) . 'Controller';
        if (class_exists($controllerClass)) {
            /**@var \App\controllers\Controller $controller */
            $controller = new $controllerClass(
                new \App\services\renders\TwigRenderServices(),
                $request
            );
            $controller->run($actionName);
        }
    }

    public function __get(string $name)
    {
        if (array_key_exists($name, $this->components)) {
            return $this->components[$name];
        }

        if (array_key_exists($name, $this->componentsData)) {
            $class = $this->componentsData[$name]['class'];
            if (!class_exists($class)) {
                return null;
            }

            if (array_key_exists('config', $this->componentsData[$name])) {
                $config = $this->componentsData[$name]['config'];
                $component = new $class($config);
            } else {
                $component = new $class();
            }
            $this->components[$name] = $component;
            return $component;
        }
        return null;
    }
}