<?php

namespace App\Controller;

use Base\AbstractController;

class User extends AbstractController
{

    public function loginAction()
    {
        echo __METHOD__;
    }

    public function registerAction()
    {
        $user = new \App\Model\User();
        return $this->view->render('User/register.phtml', [
          'userName' => 'Sidr',
          'age' => 18,
          'user' => $user,
        ]);
    }

}