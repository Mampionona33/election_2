<?php

namespace views;

use controller\AuthController;
use controller\AuthorisationController;
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
    private $userAuthorizedRoles;
    private $authorizationController;

    public function setAuthorizationController(AuthorisationController $authorizationController): void
    {
        $this->authorizationController = $authorizationController;
    }

    public function getAuhtorizationController(): AuthorisationController
    {
        return $this->authorizationController;
    }

    public function  setUserAuthorizedRoles($userAuthorizedRoles): void
    {
        $this->userAuthorizedRoles = $userAuthorizedRoles;
    }

    public function getUserAuthorizedRoles()
    {
        return $this->userAuthorizedRoles;
    }

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
        $this->setUserIdGroupe($this->authController->getUserLogged()[0]["id_groupe"]);
        $this->setAuthorizationController(new AuthorisationController());
        $this->setUserAuthorizedRoles($this->authorizationController->getGroupeRoles($this->userIdGroupe));
        $this->setNavBarObj(new Navbar());
        $this->setNavbar($this->navBarObj->render());
        $this->setTilte("Dashboard");
        $this->setBody($this->generateBody());
    }

    protected function generateBody(): string
    {
        var_dump($this->userAuthorizedRoles);
        $userIdGroupe = $this->userIdGroupe;
        return <<<HTML
        <div>Dashboard test, $userIdGroupe</div>
        HTML;
    }

    private function generateSidebarItems(): string
    {
        return <<<HTML
        <div>test</div>
        HTML;
    }
}
