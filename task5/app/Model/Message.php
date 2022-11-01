<?php

namespace App\Model;

use Base\AbstractModel;
use Base\Db;

class Message extends AbstractModel
{

    private $id;

    private $text;

    private $createdAt;

    private $userId;

    /** @var $user \App\Model\User */
    private $user;

    private $image;

    /**
     * @return mixed
     */
    public function getUserId(): mixed
    {
        return $this->userId;
    }

    public function __construct($data = [])
    {
        if ($data) {
            //$this->id = $data['id'];
            $this->text = $data['text'];
            $this->userId = $data['user_id'];
            $this->createdAt = $data['created_at'];
            $this->image = $data['image'] ?? '';
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function saveText()
    {
        $db = Db::getInstance();
        $insert = "INSERT INTO `message`(`text`, `user_id`, `created_at`, `image`) VALUES (:text, :userId, :created_at, :image)";
        $param = [
          'text' => $this->text,
          'userId' => $this->userId,
          'created_at' => $this->createdAt,
          'image' => $this->image,
        ];
        $db->exec($insert, __METHOD__, $param);

        $id = $db->lastInsertId();
        $this->id = $id;

        return $id;
    }

    static function getList(int $limit = 10, int $offset = 0): array
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM `message` LIMIT $limit OFFSET $offset";
        $data = $db->fetchAll($select, __METHOD__);

        if (!$data) {
            return [];
        }

        $messages = [];
        foreach ($data as $elem) {
            $message = new self($elem);
            $message->id = $elem['id'];
            $messages[] = $message;
        }

        return $messages;
    }

    /**
     * @return \App\Model\User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param  \App\Model\User  $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function loadFile(string $file)
    {
        if (file_exists($file)) {
            $this->image = $this->getFileName();
            move_uploaded_file($file, getcwd() . '/images/' . $this->image);
        }
    }

    private function getFileName()
    {
        return sha1(microtime() . mt_rand(1, 9999999)) . '.jpg';
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }


}