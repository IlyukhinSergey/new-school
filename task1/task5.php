<?php

$bmw = ['model' => 'X5', 'speed' => 120, 'doors' => 5, 'year' => '2015'];
$toyota = ['model' => 'camry', 'speed' => 150, 'doors' => 4, 'year' => '2019'];
$opel = ['model' => 'astra', 'speed' => 90, 'doors' => 3, 'year' => '2017'];


$cars = ['bmw' => $bmw, 'toyota' => $toyota, 'opel' => $opel];

echo 'CAR bmw' . '<br>' . ' ' . $cars['bmw']['model'] . ' ' . $cars['bmw']['speed'] .
  ' ' . $cars['bmw']['doors'] . ' ' . $cars['bmw']['year'] . '<br>';

echo 'CAR toyota' . '<br>' . ' ' . $cars['toyota']['model'] . ' ' . $cars['toyota']['speed'] .
  ' ' . $cars['toyota']['doors'] . ' ' . $cars['toyota']['year'] . '<br>';

echo 'CAR opel' . '<br>' . ' ' . $cars['opel']['model'] . ' ' . $cars['opel']['speed'] . ' ' .
  $cars['opel']['doors'] . ' ' . $cars['opel']['year'] . '<br>';
