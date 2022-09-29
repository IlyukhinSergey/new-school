<?php

require 'src/Burger.php';
require 'src/Db.php';
require 'src/config.php';
require 'src/functions.php';

$burger = new Burger();

$email = $_POST['email'];
$name = $_POST['name'];
$addressField = ['phone', 'street', 'home', 'part', 'appt', 'floor'];
$address = '';

foreach ($_POST as $field => $value) {
    if ($value && in_array($field, $addressField)) {
        $address .= $value . ',';
    }
}
$data = ['address' => $address];

$user = $burger->getUserByEmail($email);

if ($user) {
    $userId = $user['id'];
    $burger->incOrders($user['id']);
    $orderNumber = $user['orders_count'] + 1;
} else {
    $orderNumber = 1;
    $userId = $burger->createUser($email, $name);
}

$orderId = $burger->addOrder($userId, $data);

echo "Спасибо, ваш заказ будет доставлен по адресу: $address <br>
Номер вашего заказа: $orderId <br>
Это ваш $orderNumber-й заказ!";
