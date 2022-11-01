<?php

namespace App\Controller;

use App\Model\Message;
use App\Model\User as UserModel;
use Base\AbstractController;

class Blog extends AbstractController
{

    public function indexAction()
    {
        if (!$this->user) {
            $this->redirect('/new-school/task5/html/user/login');
        }

        $messages = Message::getList();
        if ($messages) {
            $userIds = array_map(function (Message $message) {
                return $message->getUserId();
            },
              $messages);

           $users =  Usermodel::getByIds($userIds);
           array_walk($messages, function (Message $message) use ($users) {
               if (isset($users[$message->getUserId()])){
                   $message->setUser($users[$message->getUserId()]);
               }
           }
           );
        }

        return $this->view->render('Blog/blog.phtml', [
          'users' => $users,
          'messages' => $messages,
        ]);
    }

    public function addMessageAction()
    {
        if (!$this->user) {
            $this->redirect('/new-school/task5/html/user/login');
        }

        $text = (string)$_POST['text'];
        if (!$text) {
            $this->error('Сообщение не может быть пустым');
        }

        $message = new Message([
          'text' => $text,
          'user_id' => $this->user->getId(),
          'created_at' => date("Y-m-d H:i:s"),
        ]);
        $message->saveText();
        $this->redirect('/new-school/task5/html/blog/index');
    }

    public function error()
    {
    }

}