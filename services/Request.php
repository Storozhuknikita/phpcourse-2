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
        // костыль
        $this->requestString = str_replace('phpcourse-2/public/', $_SERVER['REQUEST_URI'], $this->requestString);
        $this->parseRequest();
    }

//    public function getError()
//    {
//        try {
//            $request = $this->getRequest();
////            $this->runJob();
//        } catch (\Exception $exception) {
//            throw new newException($exception->getMessage());
//        } finally {
//            echo 'Я раюотаю!';
//        }
//    }
//
//    private function getRequest()
//    {
//        throw new \Exception('asd');
//        return 'Ok';
//    }


    /**
     *
     */
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

            $this->id = (int)$_GET['id'];
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

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params): void
    {
        $this->params = $params;
    }
}

//class newException extends \Exception
//{
//    public function dumpError()
//    {
//        var_dump(parent::getMessage());
//    }
//}