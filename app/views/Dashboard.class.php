<?php

namespace views;

use controller\AuthController;

class Dashboard extends BaseView
{

    public function __construct(AuthController $authController)
    {
        parent::__construct($authController);

        $this->setTilte("Dashboard");
        $this->setBody($this->generateBody());
    }

    protected function generateBody(): string
    {
        $userIdGroupe = $this->userIdGroupe;
        return <<<HTML
        <div>Dashboard test, $userIdGroupe</div>
        HTML;
    }
}
