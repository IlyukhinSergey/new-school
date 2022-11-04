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
            $this->redirect('/new-school/mvc/html/user/login');
        }

        $messages = Message::getList();
        $users = [];
        if ($messages) {
            $userIds = array_map(function (Message $message) {
                return $message->getUserId();
            },
              $messages);

            $users = Usermodel::getByIds($userIds);
            array_walk($messages, function (Message $message) use ($users) {
                if (isset($users[$message->getUserId()])) {
                    $message->setUser($users[$message->getUserId()]);
                }
            }
            );
        }

        //var_dump($this->user);
//        var_dump($messages);
//        die;

        return $this->view->renderTwig('Blog/blog.twig', [
          'user' => $this->user,
          'messages' => $messages,
        ]);
    }

    public function addMessageAction()
    {
        if (!$this->user) {
            $this->redirect('/new-school/mvc/html/user/login');
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

        if (isset($_FILES['images']['tmp_name'])) {
            $message->loadFile($_FILES['images']['tmp_name']);
        }

        $message->saveText();
        $this->redirect('/new-school/mvc/html/blog/index');
    }

    public function twigAction()
    {
        return$this->view->renderTwig('Blog/test.twig', ['var' => 'ololo']);
    }

    public function error()
    {
    }

}