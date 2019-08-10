<?php
namespace App\controllers;

use App\models\entities\User;
use App\models\repositories\UserRepository;

class UserController extends Controller
{
    protected $defaultAction = 'users';

    public function userAction()
    {
//        $id = $this->request->get(); // array
//        $id = $this->request->post(); // array
//        $id = $this->request->get('id'); // string|null
//        $id = $this->request->post('id');// string|null

        $id = $this->getId();
        $date = '20019-12-12';
        $params = [
            'date' => $date,
            'user' =>  (new UserRepository())->getOne($id)
        ];

        echo $this->render('user', $params);
    }

    public function usersAction()
    {
        $params = [
            'users' =>  (new UserRepository())->getAll()
        ];

        echo $this->render('users', $params);
    }

    public function deleteAction()
    {
        $id = $this->getId();
        $userRepository = new UserRepository();
        $user = $userRepository->getOne($id);
        $userRepository->delete($user);
        header('Location: ?a=users');
    }

    public function insertAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            $user->fio = $_POST['fio'];
            $user->login = $_POST['login'];
            $user->password = $_POST['password'];
            $user->save();
            header('Location: ?a=users');
            exit;
        }
        echo $this->render('userInsert', []);
    }
}