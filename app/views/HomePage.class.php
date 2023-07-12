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
    private $cardResult;

    /**
     * Getter & setter
     */
    public function setCardResult(CardResult $cardResult): void
    {
        $this->cardResult = $cardResult;
    }
    public function  getCardResult(): CardResult
    {
        return $this->cardResult;
    }
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
    // -------------------------------------

    public function __construct()
    {
        $this->setTilte('Home');
        $this->setCardResult(new CardResult());
        $this->setNavBarObj(new Navbar());
        $this->setNavbar($this->navBarObj->render());
        $this->candidatController = new CandidatController();
        $this->setBody($this->generateBody());
    }

    protected function generateBody(): string
    {
        $result = $this->cardResult->render();
        return <<<HTML
        <div class="d-flex w-100 justify-content-center align-items-center" style="height: 100vh;" >
            $result
        </div>
        HTML;
    }
}
