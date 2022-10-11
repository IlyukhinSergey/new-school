<?php

$bmw = ['model' => 'X5', 'speed' => 120, 'doors' => 5, 'year' => '2015'];
$toyota = ['model' => 'camry', 'speed' => 150, 'doors' => 4, 'year' => '2019'];
$opel = ['model' => 'astra', 'speed' => 90, 'doors' => 3, 'year' => '2017'];

$cars = ['bmw' => $bmw, 'toyota' => $toyota, 'opel' => $opel];

foreach ($cars as $key => $value) {
    $format = 'CAR %s <br> %s %d %d %s <br>';

    echo sprintf($format, $key,
      $value['model'], $value['speed'], $value['doors'], $value['year']);
}
