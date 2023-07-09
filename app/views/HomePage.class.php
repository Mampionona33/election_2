<?php

namespace views;

use controller\AuthController;
use template\Template;
use lib\Navbar;

class HomePage extends Template
{

    private $navBarObj;
    private $authController;


    public function setNavBarObj(Navbar $navBarObj): void
    {
        $this->navBarObj = $navBarObj;
    }

    public function getNavBarObj(): Navbar
    {
        return $this->navBarObj;
    }

    public function setauthController(AuthController $authController): void
    {
        $this->authController = $authController;
    }

    public function getauthController(): AuthController
    {
        return $this->authController;
    }

    public function __construct()
    {
        $this->setTilte('Home');
        $this->setNavBarObj(new Navbar());
        $this->setNavbar($this->navBarObj->render());
        $this->setBody($this->generateBody());
    }

    protected function generateBody(): string
    {
        return <<<HTML
        <div>
            test 123
        </div>
        HTML;
    }
}
