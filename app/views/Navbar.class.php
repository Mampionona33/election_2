<?php

namespace views;

use controller\AuthController;

class Navbar
{
    private $authController;

    public function setAuthController(AuthController $AuthController): void
    {
        $this->authController = $AuthController;
    }

    public function getAuthController(): AuthController
    {
        return $this->authController;
    }

    public function __construct()
    {
        $this->setAuthController(new AuthController());
    }

    private function logButton(): string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!$this->authController->isUserLogged()) {
            return '<a class="navbar-brand" href="/login">login</a>';
        }
        return '<a class="navbar-brand" href="/logout">log out</a>';
    }

    private function renderMenuButton(): mixed
    {
        if ($this->authController->isUserLogged()) {
            return <<<HTML
                <button class="navbar-brand btn btn-primary d-flex align-items-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
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
                $menuButton
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            $logButton
                        </li>
                    </ul>
                </div>
            </nav>
        HTML;
    }
}
