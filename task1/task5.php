<?php

$bmw = ['model' => 'X5', 'speed' => 120, 'doors' => 5, 'year' => '2015'];
$toyota = ['model' => 'camry', 'speed' => 150, 'doors' => 4, 'year' => '2019'];
$opel = ['model' => 'astra', 'speed' => 90, 'doors' => 3, 'year' => '2017'];

$nameCars = ['bmw', 'toyota', 'opel'];
$cars = ['bmw' => $bmw, 'toyota' => $toyota, 'opel' => $opel];

$format = 'CAR %s <br> %s %s %s %s <br>';

echo sprintf($format, $nameCars[0],
  $cars['bmw']['model'], $cars['bmw']['speed'], $cars['bmw']['doors'],
  $cars['bmw']['year']);

echo sprintf($format, $nameCars[1],
  $cars['toyota']['model'], $cars['toyota']['speed'], $cars['toyota']['doors'],
  $cars['toyota']['year']);

echo sprintf($format, $nameCars[2],
  $cars['opel']['model'], $cars['opel']['speed'], $cars['opel']['doors'],
  $cars['opel']['year']);
