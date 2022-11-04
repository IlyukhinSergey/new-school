<?php

require 'vendor/autoload.php';

use Intervention\Image\ImageManagerStatic;


$image = ImageManagerStatic::make('images/lego.jpg');

$image->resize(200, null,
  function (\Intervention\Image\Constraint $constraint) {
      $constraint->aspectRatio();
  });

$image->text('Hello world', 40, 40,
  function (\Intervention\Image\AbstractFont $font) {
      $font->size(100);
      $font->color('#000000');
  });
$image->save('images/new_lego.jpg');

echo $image->response('jpg');
