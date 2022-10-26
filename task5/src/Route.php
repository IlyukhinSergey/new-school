<?php

namespace Base;

use App\Controller\Blog;
use App\Controller\User;

class Route
{

    private $controllerName;

    private $actionName;

    private $processed = false;

    private $routes;

    private function process()
    {
        $parts = parse_url($_SERVER['REQUEST_URI']); // '/new-school/task5/html/'
        $path = $parts['path'];

        if (($rout = $this->routes[$path] ?? null) !== null) {
            $this->controllerName = $rout[0];
            $this->actionName = $rout[1];
        } else {
            $parts = explode('/', $path);
            $this->controllerName = '\\App\\Controller\\' . ucfirst(strtolower($parts[4]));
            $this->actionName = strtolower($parts[5] ?? 'Index');

            if (!class_exists($this->controllerName)) { //проверка есть ли такой контроллер
                throw new RouteException('Can\'t find Controller: ' . $this->controllerName);
            }
        }

//        switch ($parts['path']) {
//            case '/new-school/task5/html/user/login':
//                $user = new User();
//                $user->loginAction();
//                break;
//            case '/new-school/task5/html/user/register':
//                $user = new User();
//                $user->registerAction();
//                break;
//            case '/new-school/task5/html/blog/index':
//            case '/new-school/task5/html/blog':
//                $user = new Blog();
//                $user->indexAction();
//                break;
//            default:
//                header("HTTP/1.0 404 Nit Found");
//        }
    }

    public function addRoute($path, $controllerName, $actionName)
    {
        $this->routes[$path] = [
          $controllerName,
          $actionName,
        ];
    }

    public function getControllerName(): string
    {
        if (!$this->processed) {
            $this->process();
        }
        return $this->controllerName;
    }

    public function getActionName(): string
    {
        if (!$this->processed) {
            $this->process();
        }
        return $this->actionName . 'Action';
    }

}
