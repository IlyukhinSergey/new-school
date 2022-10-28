<?php

namespace App\Controller;

use App\Model\User as UserModel;
use Base\AbstractController;

class User extends AbstractController
{

    public function loginAction()
    {
        if($this->user){
            $this->redirect('/new-school/task5/html/blog');
        }

        if (isset($_POST['email'])) {
            $email = trim($_POST['email']);

            if ($email) {
                $password = $_POST['password'];
                $user = UserModel::getByEmail($email);

                if (!$user) {
                    $this->view->assign('error', 'Неверный email');
                }

                if ($user) {
                    if ($user->getPassword() != UserModel::getPasswordHash($password)) {
                        $this->view->assign('error',
                          'Неверный пароль');
                    } else {
                        $_SESSION['id'] = $user->getId();
                        $this->redirect('/new-school/task5/html/blog/index');
                    }
                }
            }
        }

        $id = $_GET['id'] ?? 0;
        return $this->view->render('User/login.phtml', [
          'user' => UserModel::getById((int)$id),
        ]);
    }

    /**
     * @throws \Base\RedirectException
     */
    public function register()
    {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $success = true;

        $password1 = trim($_POST['password1']);
        $password2 = trim($_POST['password2']);
        if (mb_strlen($password1) < 4) {
            $this->view->assign('error',
              'Длинна пароля должна не менее 4 символов');
            $success = false;
        }
        if ($password1 !== $password2) {
            $this->view->assign('error', 'Пароли не совпадают');
            $success = false;
        }
        $password = $password1;

        if (isset($_POST['name'])) {
            if (!$name) {
                $this->view->assign('error', 'Имя не может быть пустым');
                $success = false;
            }

            if (!$email) {
                $this->view->assign('error', 'email не может быть пустым');
                $success = false;
            }

            if (!$password) {
                $this->view->assign('error', 'Пароль не может быть пустым');
                $success = false;
            }

            $user = UserModel::getByEmail($email);

            if ($user) {
                $this->view->assign('error',
                  'Пользователь с таким email уже существует');
                $success = false;
            }

            if ($success) {
                $user = (new UserModel())->setName($name)
                  ->setEmail($email)
                  ->setPassword(UserModel::getPasswordHash($password));

                $user->save();

                $_SESSION['id'] = $user->getId();
                $this->setUser($user);

                $this->redirect('/new-school/task5/html/blog/index');
            }
        }

        $id = $_GET['id'] ?? 0;
        return $this->view->render('User/login.phtml', [
          'user' => UserModel::getById((int)$id),
        ]);
    }

    public function profileAction()
    {
        return $this->view->render('User/profile.phtml', [
          'user' => UserModel::getById((int)$_GET['id']),
        ]);
    }

    public function logoutAction()
    {
        session_destroy();

        $this->redirect('/new-school/task5/html/user/login');
    }

}