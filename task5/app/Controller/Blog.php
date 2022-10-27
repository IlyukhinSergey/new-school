<?php

namespace App\Controller;

use App\Model\User as UserModel;
use Base\AbstractController;

class Blog extends AbstractController
{

    public function indexAction()
    {
        if(!$this->user){
            $this->redirect('/new-school/task5/html/user/register');
        }

        return $this->view->render('Blog/index.phtml', [
          'user' => $this->user,
        ]);
    }
}