<?php

namespace App\Controller\Admin;

use App\Controller\Admin;
use App\Model\Eloquent\User;

class Users extends Admin
{

    public function indexAction()
    {
        return $this->view->render('Admin/users.phtml',
          [
            'users' => User::getList(),
          ]);
    }

    public function saveUserAction()
    {
        $id = (int)$_POST['id'];
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password1']);

        $user = User::getById($id);
        if (!$user) {
            return $this->response(['error' => 'нет такого пользователя']);
        }

        if (!$name) {
            return $this->response(['error' => 'no name']);
        }

        if ($password && mb_strlen($password) < 4) {
            $error = $this->response([
              'error' =>
                'Длинна пароля должна не менее 4 символов',
            ]);
        }

        if (!$email) {
            return $this->response(['error' => 'no email']);
        }

        $emailDb = User::getByEmail($email);

        if ($emailDb) {
            return $this->response(['error' => 'пользователь с таким email уже существует']);
        }

        $user->name = $name;
        $user->email = $email;
        if ($password) {
            $user->password = User::getPasswordHash($password);
        }

        $user->save();
        return $this->response(['result' => 'пользователь сохранен']);
    }


    public function response(array $data)
    {
        header('Content-type: application/json');
        return json_encode($data);
    }

}
