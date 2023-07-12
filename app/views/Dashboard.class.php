<?php

namespace views;

use controller\AuthController;

class Dashboard extends HomePage
{

    public function __construct(AuthController $authController)
    {
        parent::__construct($authController);
        $this->setTilte("Dashboard");
        $this->setBody($this->generateBody());
    }
}
