<?php

$age = 44;

switch ($age) {
    case $age >= 1 && $age <= 17:
        echo 'Вам ещё рано работать';
        break;
    case $age >= 18 && $age <= 65:
        echo 'Вам еще работать и работать';
        break;
    case $age > 65:
        echo 'Вам пора на пенсию';
        break;
    default:
        echo 'Неизвестный возраст';
}
