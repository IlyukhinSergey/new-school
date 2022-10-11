<?php

$pictures = 80;
$drawFeltPen = 23;
$drawPencil = 40;

$drawPaints = $pictures - ($drawFeltPen + $drawPencil);

$format = 'Было выполнено красками %d рисунков';
echo sprintf($format, $drawPaints);
