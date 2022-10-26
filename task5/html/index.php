<?php

use Base\Route;

include '../vendor/autoload.php';

$parts = parse_url($_SERVER['REQUEST_URI']); // '/new-school/task5/html/'

/** @uses \App\Controller\User::loginAction() */
$rout = new Route();
$rout->addRoute('/new-school/task5/html/user/login', \App\Controller\User::class, 'login');

/** @uses \App\Controller\User::registerAction() */
$rout->addRoute('/new-school/task5/html/user/register', \App\Controller\User::class, 'register');

/** @uses \App\Controller\Blog::indexAction() */
$rout->addRoute('/new-school/task5/html/blog/index', \App\Controller\Blog::class, 'index');

$controllerName = $rout->getControllerName();
$controller = new $controllerName;

$actionName = $rout->getActionName();
$controller->$actionName();


