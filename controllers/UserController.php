<?php

namespace App\controllers;

use App\models\User;

class UserController {


    protected $defaultAction = 'users';
    protected $action;

    public function run($action)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = $this->action . 'Action';

        if(method_exists($this, $method)) {
            $this->$method();
        }else{
            echo '404';
        }
    }

    public function render($template, $params = [])
    {
        $content = $this->renderTemplate($template, $params);

        return $this->renderTemplate('main', [
            'content' => $content
        ]);
    }

    public function renderTemplate($template, $params = []){

        ob_start();
        extract($params);
        include '../views/'.$template.'.php';
        return ob_get_clean();

    }


    public function userAction()
    {
        $params = [
            'user' => User::getOne(1)
        ];

        echo $this->render('user', $params);
    }

    public function usersAction()
    {

        $params = [
          'users' => User::getAll()
        ];

        echo $this->render('users', $params);
    }





}