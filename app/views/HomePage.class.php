<?php

namespace views;

use controller\AuthController;
use controller\CandidatController;
use template\Template;
use lib\Navbar;

class HomePage extends Template
{

    private $navBarObj;
    private $authController;
    private $candidatController;

    public function setCandidatController(CandidatController $candidatController): void
    {
        $this->candidatController = $candidatController;
    }

    public function getCandidatController(): CandidatController
    {
        return $this->candidatController;
    }

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
        $this->candidatController = new CandidatController();
        $this->setBody($this->generateBody());
    }

    protected function generateBody(): string
    {
        return <<<HTML
        <div>
            Home page
        </div>
        HTML;
    }
}
