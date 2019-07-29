<?php

namespace App\services;

class Request
{
    private $requestString;
    private $controllerName;
    private $actionName;
    private $id;
    private $params;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        session_start();
        // костыль
        $this->requestString = str_replace('phpcourse-2/', '', $_SERVER['REQUEST_URI']);
        //$this->requestString = $_SERVER['REQUEST_URI'];
        var_dump($this->requestString);
        $this->parseRequest();
    }

    private function parseRequest()
    {
        $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";
        if (preg_match_all($pattern, $this->requestString, $matches)) {
            $this->controllerName = $matches['controller'][0];
            $this->actionName = $matches['action'][0];

            $this->params = [
                'get' => $_GET,
                'post' => $_POST,
            ];

            $this->id = (int)$this->getParams('get', 'id');
        }
    }

    /**
     * @return mixed
     */
    public function getRequestString()
    {
        return $this->requestString;
    }

    /**
     * @param mixed $requestString
     */
    public function setRequestString($requestString): void
    {
        $this->requestString = $requestString;
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @param mixed $controllerName
     */
    public function setControllerName($controllerName): void
    {
        $this->controllerName = $controllerName;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @param mixed $actionName
     */
    public function setActionName($actionName): void
    {
        $this->actionName = $actionName;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getParams($method, $key = null)
    {
        if (empty($key)) {
            return $this->params[$method];
        }
        return array_key_exists($key, $this->params[$method])
            ? $this->params[$method][$key]
            : null;
    }

    public function getSession($key = null)
    {
        if (empty($key)) {
            return $_SESSION;
        }
        return array_key_exists($key, $_SESSION)
            ? $_SESSION[$key]
            : [];
    }

    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}
