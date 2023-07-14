<?php

namespace controller;

use views\Dashboard;
use views\HomePage;
use views\LoginPage;
use views\ManageAuthorization;
use views\ManageCandidat;

class PageController
{
    private $homePage;
    private $loginPage;
    private $dashboard;
    private $authController;
    private $manageCandidat;
    private $manageAuthorization;

    /**
     * getter and setter
     */
    public function setManageAuthorization(ManageAuthorization $manageAuthorization): void
    {
        $this->manageAuthorization = $manageAuthorization;
    }
    public function getManageAuthorization(): ManageAuthorization
    {
        return $this->manageAuthorization;
    }
    public function setManageCandidat(ManageCandidat $manageCandidat): void
    {
        $this->manageCandidat = $manageCandidat;
    }

    public function getManageCandidat(): ManageCandidat
    {
        return $this->manageCandidat;
    }

    public function setAuthController(AuthController $authController): void
    {
        $this->authController = $authController;
    }

    public function getAuthController(): AuthController
    {
        return $this->authController;
    }

    public function setDashboard(Dashboard $dashboard): void
    {
        $this->dashboard = $dashboard;
    }

    public function getDashboard(): Dashboard
    {
        return $this->dashboard;
    }

    public function setLoginPage(LoginPage $loginPage): void
    {
        $this->loginPage = $loginPage;
    }

    public function getLoginPage(): LoginPage
    {
        return $this->loginPage;
    }

    public function setHomePage(HomePage $homePage): void
    {
        $this->homePage = $homePage;
    }
    public function getHomePage(): HomePage
    {
        return $this->homePage;
    }

    public function __construct(AuthController $authController)
    {
        $this->authController = $authController;
        $this->setLoginPage(new LoginPage());
        $this->setHomePage(new HomePage($this->authController));
        $this->manageCandidat = new ManageCandidat($this->authController);
        $this->dashboard = new Dashboard($this->authController);
        $this->setManageAuthorization(new ManageAuthorization($this->authController));
    }

    public function renderHomePage(): void
    {
        if ($this->authController->isUserLogged()) {
            $this->redirectToDashboard();
            exit();
        }
        echo $this->homePage->render();
    }

    public function renderLoginPage(): void
    {
        if ($this->authController->isUserLogged()) {
            $this->redirectToDashboard();
        }
        echo $this->loginPage->render();
    }

    public function handleCandidat(): void
    {
        if ($this->authController->isUserLogged()) {
            echo $this->manageCandidat->render();
            exit();
        } else {
            $this->redirectToVisitorHome();
        }
    }

    public function renderManageAuthorization(): void
    {
        if ($this->authController->isUserLogged()) {
            echo $this->manageAuthorization->render();
            exit();
        } else {
            $this->redirectToVisitorHome();
        }
    }

    public function renderDashboard(): void
    {
        if ($this->authController->isUserLogged()) {

            echo $this->dashboard->render();
        } else {
            $this->redirectToVisitorHome();
        }
    }

    private function  redirectToDashboard(): void
    {
        header("Location: /dashboard");
        exit();
    }

    private function redirectToVisitorHome(): void
    {
        header("Location: /");
        exit();
    }
}
