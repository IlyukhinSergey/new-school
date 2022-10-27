<?php

namespace Base;

class View
{

    private $templatePath = '';

    private $data = [];

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

}