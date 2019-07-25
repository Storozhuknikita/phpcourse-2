<?php

namespace App\controllers;

use App\models\User;

class UserController extends Controller
{

    protected $defaultAction = 'users';
    protected $action;

    public function userAction()
    {
        $id = (int)$_GET['id'];
        $params = [
            'user' => User::getOne($id)
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

    public function deleteAction(){

        $id = (int)$_GET['id'];
        $user = User::getOne($id);
        $user->delete();

        echo $this->render('user', $params);

    }

    public function insertAction()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $user = new User();
            $user->user_name = $_POST['username'];
            $user->user_login = $_POST['userlogin'];
            $user->user_password = $_POST['userpassword'];
            $user->save();

        }

        echo $this->render('userinsert', []);

    }





}