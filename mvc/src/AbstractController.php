<?php

namespace Base;

use App\Model\Eloquent\User;

abstract class AbstractController
{

    /** @var \Base\View */
    protected $view;

    /** @var User */
    protected $user;

    protected function redirect(string $url)
    {
        throw new RedirectException($url);
    }

    public function setView(View $view): void
    {
        $this->view = $view;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function preDispatch()
    {
        //var_dump($this->user->getName()); die;
        if($this->user){
            $this->view->assing2([
              'user' => $this->user,
            ]);
        }
    }

}