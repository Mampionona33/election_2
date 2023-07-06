<?php

namespace controller;

use views\HomePage;

class PageController
{
    private $homePage;

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
    }

    public function renderHomePage(): void
    {
        echo $this->homePage->render();
    }

    public function renderLoginPage(): void
    {
    }
}
