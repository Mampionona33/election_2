<?php

namespace views;

use controller\AuthController;
use lib\Navbar;
use lib\Sidebar;
use template\Template;

class Dashboard extends Template
{
    private $title;
    private $body;
    private $navBar;
    private $userIdGroupe;
    private $authController;
    private $navBarObj;

    public function setNavBarObj(Navbar $navBarObj): void
    {
        $this->navBarObj = $navBarObj;
    }

    public function getNavBarObj(): Navbar
    {
        return $this->navBarObj;
    }

    public function setUserIdGroupe(int $userIdGroupe): void
    {
        $this->userIdGroupe = $userIdGroupe;
    }

    public function getUserIdGroupe(): int
    {
        return $this->userIdGroupe;
    }

    public function setauthController(AuthController $authController): void
    {
        $this->authController = $authController;
    }

    public function getauthController(): AuthController
    {
        return $this->authController;
    }


    public function __construct(AuthController $authController)
    {
        $this->setauthController($authController);
        $this->setNavBarObj(new Navbar());
        $this->setNavbar($this->navBarObj->render());
        $this->setTilte("Dashboard");
        $this->setBody($this->generateBody());
    }

    protected function generateBody(): string
    {
        $userIdGroupe = $this->userIdGroupe;
        return <<<HTML
        <div>Dashboard test, $userIdGroupe</div>
        HTML;
    }
}
