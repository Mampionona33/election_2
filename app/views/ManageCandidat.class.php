<?php

namespace views;

use controller\AuthController;

class ManageCandidat extends BaseView
{
    public function __construct(AuthController $authController)
    {
        parent::__construct($authController);
        $this->setTilte("Manage candidat");
        $this->setBody($this->generateBody());
    }

    protected function generateBody(): string
    {
        $userIdGroupe = $this->userIdGroupe;
        return <<<HTML
        <div>Manage Candidat , $userIdGroupe</div>
        HTML;
    }
}
