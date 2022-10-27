<?php

namespace App\Controller;

use App\Model\User as UserModel;
use Base\AbstractController;

class User extends AbstractController
{

    public function loginAction()
    {
        echo __METHOD__;
    }

    public function registerAction()
    {
        $names = ['aaa', 'bbb', 'sss', 'fff', 'ttt',];
        $name = $names[array_rand($names)];
        $gender = UserModel::GENDER_MALE;
        $password = '12345';

        $user = (new UserModel())->setName($name)
          ->setGender($gender)
          ->setPassword(UserModel::getPasswordHash($password));

        $user->save();

        return $this->view->render('User/register.phtml', []);
    }

    public function profileAction()
    {
        return $this->view->render('User/profile.phtml', [
          'user' => UserModel::getById((int)$_GET['id']),
        ]);
    }

}