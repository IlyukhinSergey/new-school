<?php

use App\Controller\Blog;
use App\Controller\User;

require '../vendor/autoload.php';

$parts = parse_url($_SERVER['REQUEST_URI']); // '/new-school/task5/html/'

switch ($parts['path']) {
    case '/new-school/task5/html/user/login':
        $user = new User();
        $user->loginAction();
        break;
    case '/new-school/task5/html/user/register':
        $user = new User();
        $user->registerAction();
        break;
    case '/new-school/task5/html/blog/index':
    case '/new-school/task5/html/blog':
        $user = new Blog();
        $user->indexAction();
        break;
    default:
        header("HTTP/1.0 404 Nit Found");
}