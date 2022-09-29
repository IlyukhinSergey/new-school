<?php

use Base\Db;

class Burger
{

    public function getUserByEmail(string $email)
    {
        $db = Db::getInstance();
        $query = "SELECT * FROM users WHERE email = :email";
        return $db->fetchOne($query, __METHOD__, ['email' => $email]);
    }

    public function createUser(string $email,string $name)
    {
        $db = Db::getInstance();
        $query = "INSERT INTO users(email, orders_count, `name`) VALUES (:email, :orders_count, :name)";
        $result = $db->exec($query, __METHOD__,
          ['email' => $email, 'orders_count' => 1, 'name' => $name]);

        if (!$result) {
            return false;
        }

        return $db->lastInsertId();
    }

    public function addOrder(int $userId, array $data)
    {
        $db = Db::getInstance();
        $query = "INSERT INTO orders(user_id, address, create_date) VALUES (:user_id, :address, :create_date)";
        $result = $db->exec(
          $query,
          __METHOD__,
          [
            'user_id' => $userId,
            'address' => $data['address'],
            'create_date' => date('Y-m-d H:i:s'),
          ]
        );
        if (!$result) {
            return false;
        }

        return $db->lastInsertId();
    }

    public function incOrders(int $userId)
    {
        $db = Db::getInstance();
        $query = "UPDATE users SET orders_count = orders_count + 1 WHERE id = $userId";
        return $db->exec($query, __METHOD__);

    }

}