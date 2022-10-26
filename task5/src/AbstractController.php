<?php

namespace Base;

abstract class AbstractController
{

    /** @var \Base\View */
    protected $view;

    protected function redirect(string $url)
    {
        throw new RedirectException($url);
    }

    /**
     * @param  \Base\View  $view
     */
    public function setView(View $view): void
    {
        $this->view = $view;
    }


}