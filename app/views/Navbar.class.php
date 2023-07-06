<?php

namespace views;

use controller\AuthentificationController;

class Navbar
{
    private $authentificationController;

    public function setauthentificationController(AuthentificationController $authentificationController): void
    {
        $this->authentificationController = $authentificationController;
    }

    public function getAuthentificationController(): AuthentificationController
    {
        return $this->authentificationController;
    }

    public function __construct()
    {
        $this->setauthentificationController(new AuthentificationController());
    }


    private function logButton(): string
    {
        if (!$this->authentificationController->isUserLogged()) {
            return '<a class="navbar-brand" href="/login">login</a>';
        }
        return '<a class="navbar-brand" href="/logout">log out</a>';
    }


    private function renderMenuButton(): mixed
    {
        if ($this->authentificationController->isUserLogged()) {
            return <<<HTML
                <button class="btn btn-primary d-flex align-items-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                    <span class="material-icons">menu</span>
                </button>
            HTML;
        }
        return null;
    }



    public function render(): string
    {
        $menuButton = $this->renderMenuButton();
        $logButton = $this->logButton();

        return <<<HTML
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            $menuButton
                        </li>
                        <li class="nav-item">
                            $logButton
                        </li>
                    </ul>
                </div>
            </nav>
        HTML;
    }
}
