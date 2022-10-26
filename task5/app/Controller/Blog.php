<?php

namespace App\Controller;

use Base\AbstractController;

class Blog extends AbstractController
{

    public function indexAction()
    {
        if(isset ($_GET['redirect'])){
            $this->redirect('/new-school/task5/html/user/register');
        }
        echo __METHOD__;
    }
}