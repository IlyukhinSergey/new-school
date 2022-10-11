<?php

$name = 'Сергей';
$age = '30';

$format1 = 'Меня зовут %s <br>';
$format2 = 'Мне %d лет <br>';

echo sprintf($format1, $name);
echo sprintf($format2, $age);
echo "“!|/’”\\" . '<br>';
