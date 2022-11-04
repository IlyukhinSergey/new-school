<?php

namespace Base;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{

    private $templatePath = '';

    private $data = [];

    private $twig;

    public function __construct()
    {
        //тут будут лежать все шаблоны
        $this->templatePath = PROJECT_ROOT_DIR . DIRECTORY_SEPARATOR . 'app/View';
    }

    public function assign(string $name, $value)
    {
        $this->data[$name] = $value;
    }

    public function render(string $tpl, $data = []): string
    {
        $this->data += $data;
        ob_start(); //буферезация потока вывода
        include $this->templatePath . DIRECTORY_SEPARATOR . $tpl;
        return ob_get_clean(); //возвращает данные из буфера
    }

    public function __get($varName)
    {
        return $this->data[$varName] ?? null;
    }

    public function renderTwig(string $tpl, $data = [])
    {
        if(!$this->twig) {
            $loader = new FilesystemLoader($this->templatePath);
            $this->twig = new Environment($loader);
//            $this->twig = new Environment($loader, [
//              'cache' => '/path/to/compilation_cache',
//            ]); это с кеширование
        }

        return $this->twig->render($tpl, $data);
    }

}