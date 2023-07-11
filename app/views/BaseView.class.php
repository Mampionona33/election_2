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


    public function setSidebarObj(Sidebar $sidebarObj): void
    {
        $this->sidebarObj = $sidebarObj;
    }

    public function getSidebarObj(): Sidebar
    {
        return $this->sidebarObj;
    }

    private function hasRole(array $requiredRoles): bool
    {
        $userRoles = array_column($this->getUserAuthorizedRoles(), 'name');

        // Vérifier si au moins l'un des rôles requis est présent dans les rôles de l'utilisateur
        foreach ($requiredRoles as $requiredRole) {
            if (in_array($requiredRole, $userRoles)) {
                return true;
            }
        }

        return false;
    }

    public function __construct(AuthController $authController)
    {
        $this->setAuthController($authController);
        $this->setAuthorizationController(new AuthorisationController());
        $this->setNavBarObj(new Navbar());
        $this->setSidebarObj(new Sidebar());
        $this->setNavbar($this->navBarObj->render());

        if ($this->authController->isUserLogged()) {
            $this->setUserIdGroupe($this->authController->getUserLogged()[0]["id_groupe"]);
            $this->setUserAuthorizedRoles($this->authorizationController->getGroupeRoles($this->userIdGroupe));
            $this->hasRole($this->userAuthorizedRoles);

            $this->sidebarObj = new Sidebar();
            $this->sidebarObj->setSidebarContents($this->generateSidebarItems());
            $this->setSidebar($this->sidebarObj->render());
        }
    }

    private function generateSidebarItems(): array
    {
        $buttons = [];
        $buttons[] = ['path' => '/', 'label' => 'Accueil'];
        $requiredRolesCandidat = ['create_candidat', 'update_candidat', 'delete_candidat'];
        $requiredRolesUser = ['create_user', 'update_user', 'delete_user'];
        $requiredRolesRole = ['create_role', 'update_role', 'delete_role'];
        $requiredRolesGroupe = ['create_groupe', 'update_groupe', 'delete_groupe'];

        if ($this->hasRole($requiredRolesCandidat)) {
            $buttons[] = ['path' => 'candidat', 'label' => 'Gérer candidat'];
        }
        if ($this->hasRole($requiredRolesUser)) {
            $buttons[] = ['path' => "user", "label" => "Gérer utilisateur"];
        }
        if ($this->hasRole($requiredRolesRole)) {
            $buttons[] = ['path' => "role", "label" => "Gérer rôle"];
        }
        if ($this->hasRole($requiredRolesGroupe)) {
            $buttons[] = ['path' => "groupe", "label" => "Gérer groupe"];
        }

        return $buttons;
    }

    
}
