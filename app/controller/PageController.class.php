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

    public function __construct(AuthController $authController)
    {
        $this->authController = $authController;
        $this->setLoginPage(new LoginPage());
        $this->setHomePage(new HomePage());
        $this->dashboard = new Dashboard($this->authController);
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
        if ($this->authController->isUserLogged()) {
            echo "PageController";
            var_dump($this->authController->getUserLogged());
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
