<?php
namespace views;

use controller\AuthController;

class RolePage extends BaseView
{
    private $roleTableView;

    public function __construct(AuthController $authController)
    {
        parent::__construct($authController);
        $this->setTitle("Manage roles");
    }

     protected function generateBody(): string
    {
        $candidaTableView = $this->candidaTableView->render();
        return <<<HTML
        <div>
            tests
        </div>
        HTML;
    }

}