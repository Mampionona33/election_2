<?php

namespace views;

use controller\AuthController;
use controller\CandidatController;
use lib\Navbar;

class HomePage extends BaseView
{

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

    // -------------------------------------

    public function __construct(AuthController $authController)
    {
        parent::__construct($authController);
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
