<?php

namespace views;

use controller\AuthController;

class ManageCandidat extends BaseView
{

    private $candidaTableView;

    public function setCandidatTableView(CandidatTableView $candidaTableView): void
    {
        $this->candidaTableView = $candidaTableView;
    }

    public function __construct(AuthController $authController)
    {
        parent::__construct($authController);
        $this->setTilte("Manage candidat");
        $this->setCandidatTableView(new CandidatTableView());
        $this->setBody($this->generateBody());
    }

    protected function generateBody(): string
    {
        $candidaTableView = $this->candidaTableView->render();
        return <<<HTML
        <div>
            $candidaTableView
        </div>
        HTML;
    }
}
