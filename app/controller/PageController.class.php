<?php

namespace controller;

use views\Dashboard;
use views\HomePage;
use views\LoginPage;

class PageController
{
    private $homePage;
    private $loginPage;
    private $dashboard;
    private $authController;

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

    public function __construct()
    {
        $this->authController = new AuthController();
        $this->setHomePage(new HomePage());
        $this->setLoginPage(new LoginPage());
        $this->setDashboard(new Dashboard());
    }

    public function renderHomePage(): void
    {
        if ($this->authController->isUserLogged()) {
            $this->redirectToDashboard();
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

    public function renderDashboard(): void
    {
        echo $this->dashboard->render();
    }

    private function  redirectToDashboard(): void
    {
        header("Location: /dashboard");
        exit();
    }
}
