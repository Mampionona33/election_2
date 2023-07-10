<?php

namespace views;

use controller\AuthController;
use controller\AuthorisationController;
use lib\Navbar;
use lib\Sidebar;
use template\Template;

class BaseView extends Template
{
    protected $userIdGroupe;
    protected $authController;
    protected $navBarObj;
    protected $userAuthorizedRoles;
    protected $authorizationController;
    protected $sidebarObj;

    protected $sidebarContents;

    public function setSidebarContents($sidebarContents): void
    {
        $this->sidebarContents = $sidebarContents;
    }

    public function getSidebarContents()
    {
        return $this->sidebarContents;
    }

    public function setAuthorizationController(AuthorisationController $authorizationController): void
    {
        $this->authorizationController = $authorizationController;
    }

    public function getAuthorizationController(): AuthorisationController
    {
        return $this->authorizationController;
    }

    public function setUserAuthorizedRoles($userAuthorizedRoles): void
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

    public function setAuthController(AuthController $authController): void
    {
        $this->authController = $authController;
    }

    public function getAuthController(): AuthController
    {
        return $this->authController;
    }
}
