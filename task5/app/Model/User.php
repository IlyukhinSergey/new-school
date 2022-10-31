<?php

namespace App\Model;

use Base\AbstractModel;
use Base\Db;

class User extends AbstractModel
{

    private $id;

    private $name;

    private $email;

    private $password;

    private $createdAt;

    public function __construct($data = [])
    {
        if ($data) {
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->email = $data['email'];
            $this->password = $data['password'];
            $this->createdAt = $data['created_at'];
        }
    }

    /**
     * @return mixed
     */
    public function getId(): int
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param  mixed  $password
     */
    public function setPassword($password): self
    {
        $this->password = $password;
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

    public function save()
    {
        $db = Db::getInstance();
        $insert = "INSERT INTO `users`(`name`, `email`, `password`) VALUES (:name, :email, :password)";
        $param = [
          'name' => $this->name,
          'email' => $this->email,
          'password' => $this->password,
        ];
        $db->exec($insert, __METHOD__, $param);

        $id = $db->lastInsertId();
        $this->id = $id;

        return $id;
    }

    public function getList(int $limit = 10, int $offset = 0): array
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM `users` LIMIT $limit OFFSET = $offset";
        $data = $db->fetchAll($select, __METHOD__);

        if (!$data) {
            return [];
        }

        $users = [];
        foreach ($data as $elem) {
            $user = new self($elem);
            $user->id = $elem['id'];
            $users[] = $user;
        }

        return $users;
    }

    public static function getById(int $id): ?self
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM `users` WHERE id = $id";
        $data = $db->fetchOne($select, __METHOD__);

        if (!$data) {
            return null;
        }

        return new self($data);
    }


    public static function getByIds(array $userIds)
    {
        $db = Db::getInstance();
        $idsString = implode(',', $userIds);
        $select = "SELECT * FROM `users` WHERE id IN ($idsString)";
        $data = $db->fetchAll($select, __METHOD__);

        if (!$data) {
            return [];
        }

        $users = [];
        foreach ($data as $elem) {
            $user = new self($elem);
            $user->id = $elem['id'];
            $users[$user->id] = $user;
        }

        return $users;
    }

    public static function getByName(string $name): ?self
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM `users` WHERE `name` = :name";
        $param = ['name' => $name];
        $data = $db->fetchOne($select, __METHOD__, $param);

        if (!$data) {
            return null;
        }

        return new self($data);
    }

    public static function getByEmail(string $email): ?self
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM `users` WHERE email = :email";
        $param = ['email' => $email];
        $data = $db->fetchOne($select, __METHOD__, $param);

        if (!$data) {
            return null;
        }

        return new self($data);
    }

    public static function getPasswordHash(string $password)
    {
        return sha1('ghghhgg' . $password);
    }

}