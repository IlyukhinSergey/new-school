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
        if (!$this->processed) {
            $parts = parse_url($_SERVER['REQUEST_URI']);
            $path = $parts['path'];

            if (($rout = $this->routes[$path] ?? null) !== null) {
                $this->controllerName = $rout[0];
                $this->actionName = $rout[1];
            } else {
                $parts = explode('/', $path);
                $this->controllerName = '\\App\\Controller\\' . ucfirst(strtolower($parts[4]));
                $this->actionName = strtolower($parts[5] ?? 'Index');
            }
        }
        $this->processed = true;
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
