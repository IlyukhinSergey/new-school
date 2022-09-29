<?php

$pictures = 80;
$drawFeltPen = 23;
$drawPencil = 40;

$drawPaints = $pictures - ($drawFeltPen + $drawPencil);

echo 'Было выполнено красками ' . $drawPaints . ' рисунков';
