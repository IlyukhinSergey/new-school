<?php
require '../vendor/autoload.php';

$parts = parse_url($_SERVER['REQUEST_URI']); // '/new-school/task5/html/'

switch ($parts['path']){
    case '/new-school/task5/html/user/login':
        echo 'Login user';
        break;
    case '/new-school/task5/html/user/register':
        echo 'Register user';
        break;
    default:
        header("HTTP/1.0 404 Nit Found");
}