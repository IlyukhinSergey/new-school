<?php

use Base\Application;

require '../src/config.php';
require '../vendor/autoload.php';
require '../src/eloquent.php';

$app = new Application();
$app->run();

//http://localhost/new-school/mvc/html/user/login
