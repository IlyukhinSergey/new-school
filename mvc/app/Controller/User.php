<?php

namespace App\Controller;

use App\Model\Eloquent\User as UserModel;
use Base\AbstractController;

class User extends AbstractController
{

    public function loginAction()
    {
        if ($this->user) {
            $this->redirect('/new-school/mvc/html/blog/index');
        }

        if (isset($_POST['email'])) {
            $email = trim($_POST['email']);

            if ($email) {
                $password = $_POST['password'];
                $user = UserModel::getByEmail($email);

                if (!$user) {
                    $error = $this->view->assign('error',
                      'Неверный email или пароль');
                }

                if ($user) {
                    if ($user->getPassword() != UserModel::getPasswordHash($password)) {
                        $error = $this->view->assign('error',
                          'Неверный email или пароль');
                    } else {
                        $_SESSION['id'] = $user->getId();
                        $this->redirect('/new-school/mvc/html/blog/index');
                    }
                }
            }
        }

        $id = $_GET['id'] ?? 0;

        return $this->view->renderTwig('User/login.twig', [
          'user' => UserModel::getById((int)$id),
          'error' => $error ?? '',
        ]);
    }

    /**
     * @throws \Base\RedirectException
     */
    public function registerAction()
    {
        if (isset($_POST['email'])) {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $success = true;
            $password1 = trim($_POST['password1']);
            $password2 = trim($_POST['password2']);
            if (mb_strlen($password1) < 4) {
                $error = $this->view->assign('error',
                  'Длинна пароля должна не менее 4 символов');
                $success = false;
            }
            if ($password1 !== $password2) {
                $error = $this->view->assign('error', 'Пароли не совпадают');
                $success = false;
            }
            $password = $password1;
            if (isset($_POST['name'])) {
                if (!$name) {
                    $error = $this->view->assign('error',
                      'Имя не может быть пустым');
                    $success = false;
                }

                if (!$email) {
                    $error = $this->view->assign('error',
                      'email не может быть пустым');
                    $success = false;
                }

                if (!$password) {
                    $error = $this->view->assign('error',
                      'Пароль не может быть пустым');
                    $success = false;
                }

                $user = UserModel::getByEmail($email);

                if ($user) {
                    $error = $this->view->assign('error',
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

                    $this->redirect('/new-school/mvc/html/blog/index');
                }
            }
        }

        $id = $_GET['id'] ?? 0;
        return $this->view->render('User/login.phtml', [
          'user' => UserModel::getById((int)$id),
          'error' => $error,
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

        $this->redirect('/new-school/mvc/html/user/login');
    }

}