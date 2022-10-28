<?php

namespace Base;

use App\Controller\User;
use App\Model\User as UserModel;

class Application
{

    private $route;

    /** @var \Base\AbstractController */
    private $controller;

    private $actionName;

    public function __construct()
    {
        $this->route = new Route();
    }

    /**
     * @throws \Base\RouteException
     */
    public function run()
    {
        try {
            session_start();
            $this->addRoute();
            $this->initController();
            $this->initAction();

            $view = new View();
            $this->controller->setView($view);
            $this->initUser();

            $content = $this->controller->{$this->actionName}();

            echo $content;
        } catch (RedirectException $e) {
            header('Location: ' . $e->getUrl());
            die;
        } catch (RouteException $e) {
            header("HTTP/1.0 404 Not Found");
            echo $e->getMessage();
        }
    }

    private function initUser()
    {
        $id = $_SESSION['id'] ?? null;

        if ($id) {
            $user = UserModel::getById($id);
            if ($user) {
                $this->controller->setUser($user);
            }
        }
    }

    private function addRoute()
    {
        /** @uses \App\Controller\User::loginAction() */
        $this->route->addRoute('/new-school/task5/html/', User::class,
          'login');
        ///** @uses \App\Controller\User::registerAction() */
        //$this->route->addRoute('/new-school/task5/html/user/register', \App\Controller\User::class, 'register');
        /** @uses \App\Controller\Blog::indexAction() */
        $this->route->addRoute('/new-school/task5/html/blog',
          \App\Controller\Blog::class, 'index');
        //$this->route->addRoute('/new-school/task5/html/blog/index', \App\Controller\Blog::class, 'index');
    }

    private function initController()
    {
        $controllerName = $this->route->getControllerName();
        if (!class_exists($controllerName)) { //проверка есть ли такой контроллер
            throw new RouteException('Can\'t find Controller: ' . $controllerName);
        }

        $this->controller = new $controllerName();
    }

    private function initAction()
    {
        $actionName = $this->route->getActionName();
        if (!method_exists($this->controller, $actionName)) {
            throw new RouteException('Action ' . $actionName . ' not found in ' . get_class($this->controller));
        }

        $this->actionName = $actionName;
    }

}