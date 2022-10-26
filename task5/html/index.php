<?php

use Base\Route;
use Base\RouteException;

include '../vendor/autoload.php';

$parts = parse_url($_SERVER['REQUEST_URI']); // '/new-school/task5/html/'

$rout = new Route();

/** @uses \App\Controller\User::loginAction() */
$rout->addRoute('/new-school/task5/html/user/go', \App\Controller\User::class, 'login');
///** @uses \App\Controller\User::registerAction() */
//$rout->addRoute('/new-school/task5/html/user/register', \App\Controller\User::class, 'register');
///** @uses \App\Controller\Blog::indexAction() */
//$rout->addRoute('/new-school/task5/html/blog/index', \App\Controller\Blog::class, 'index');

$controllerName = $rout->getControllerName();
$controller = new $controllerName;

$actionName = $rout->getActionName();
if (!method_exists($controller, $actionName)) { //проверяем есть ли такой метод в контроллере
    throw new RouteException('Action: ' . $this->actionName . 'not found in Controller: ' . $this->controllerName);
}

$controller->$actionName();


