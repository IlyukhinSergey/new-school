<?php

namespace App\Controller;

use App\Model\Message;
use Base\AbstractController;

class Api extends AbstractController
{

    public function getUserMessagesAction()
    {
        $userId = (int)$_GET['user_id'] ?? 0;
        if (!$userId) {
            return $this->response(['error' => 'no user id']);
        }
        $messages = Message::getUserMessages($userId, 20);

        if (!$messages) {
            return $this->response(['error' => 'no messages']);
        }

        //если массив есть, пробежимся по массиву сообщений
        $data = array_map(function (Message $message) {
            return $message->getData();
        }, $messages);

        return $this->response(['messages' => $data]);
    }

    public function response(array $data)
    {
        header('Content-type: application/json');
        return json_encode($data);
    }

}
