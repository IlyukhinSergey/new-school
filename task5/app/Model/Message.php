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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param  mixed  $id
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param  mixed  $text
     */
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param  mixed  $createdAt
     */
    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param  mixed  $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    public function saveText()
    {
        $db = Db::getInstance();
        $insert = "INSERT INTO `messege`(`text`, `user_id`) VALUES (:name, :userId)";
        $param = [
          'text' => $this->text,
          'userId' => $this->userId,
        ];
        $db->exec($insert, __METHOD__, $param);

        $id = $db->lastInsertId();
        $this->id = $id;

        return $id;
    }

    public static function getByUserId(int $userId): ?self
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM `messege` WHERE id = $userId";
        $data = $db->fetchAll($select, __METHOD__);

        if (!$data) {
            return null;
        }

        return $data;
    }


}