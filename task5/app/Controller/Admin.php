<?php

namespace App\Controller;

use App\Model\Message;
use Base\AbstractController;

class Admin extends AbstractController
{

    public function preDispatch()
    {
        parent::preDispatch();
        if (!$this->user || !$this->user->isAdmin()) {
            $this->redirect('/new-school/task5/html/');
        }
    }

    public function deleteMessageAction()
    {
        $idMessage = (int)$_GET['id'];
        Message::deleteMessage($idMessage);
        $this->redirect('/new-school/task5/html/blog/index');
    }

}