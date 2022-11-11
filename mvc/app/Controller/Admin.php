<?php

namespace App\Controller;

use App\Model\Eloquent\Message;
use Base\AbstractController;

class Admin extends AbstractController
{

    public function preDispatch()
    {
        parent::preDispatch();
        if (!$this->user || !$this->user->isAdmin()) {
            $this->redirect('/new-school/mvc/html/user/login');
        }
    }

    public function deleteMessageAction()
    {
        $idMessage = (int)$_GET['id'];
        Message::deleteMessage($idMessage);
        $this->redirect('/new-school/mvc/html/blog/index');
    }

}