<?php
namespace App\controllers;

use App\main\App;
use App\models\entities\User;
use App\models\repositories\UserRepository;

class UserController extends Controller
{
    protected $defaultAction = 'users';

    public function userAction()
    {
        $id = $this->getId();
        $date = '20019-12-12';
        $params = [
            'date' => $date,
            'user' => App::call()->userRepository->getOne($id)
        ];

        echo $this->render('user', $params);
    }

    public function usersAction()
    {
        $params = [
            'users' =>  App::call()->userRepository->getAll()
        ];

        echo $this->render('users', $params);
    }

    public function deleteAction()
    {
        $id = $this->getId();
        $user = App::call()->userRepository->getOne($id);
        App::call()->userRepository->delete($user);
        return $this->redirect();
    }

    public function insertAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            $user->user_name = $_POST['fio'];
            $user->user_login = $_POST['login'];
            $user->user_password = $_POST['password'];
            App::call()->userRepository->save($user);
            return $this->redirect();
        }
        echo $this->render('userInsert', []);
    }
}