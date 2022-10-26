<?php
require '../vendor/autoload.php';

use App\Controller\Auth\Login;
use App\Controller\User;
use Base\Application;

$app = new Application();

$user = new User();
$user->indexAction();

$login = new Login();
$login->indexAction();
