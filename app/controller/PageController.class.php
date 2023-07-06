<?php

namespace controller;

use views\HomePage;
use views\LoginPage;

class PageController
{
    private $homePage;
    private $loginPage;

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
        $this->setHomePage(new HomePage());
        $this->setLoginPage(new LoginPage());
    }

    public function renderHomePage(): void
    {
        echo $this->homePage->render();
    }

    public function renderLoginPage(): void
    {
        echo $this->loginPage->render();
    }
}
