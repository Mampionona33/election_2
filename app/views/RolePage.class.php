<?php

namespace views;

use controller\AuthController;

class RolePage extends BaseView
{
    private $roleTableView;

    /**
     * getter and setter
     */

    public function setRoleTableView(RoleTableView $roleTableView): void
    {
        $this->roleTableView = $roleTableView;
    }
    public function getRoleTableView(): RoleTableView
    {
        return $this->roleTableView;
    }

    public function __construct(AuthController $authController)
    {
        parent::__construct($authController);
        $this->setTilte("Manage roles");
        $this->setRoleTableView(new RoleTableView());
        $this->setBody($this->generateBody());
    }

    protected function generateBody(): string
    {
        $roleTableView = $this->roleTableView->render();
        return <<<HTML
        <div class="d-flex vh-100 align-items-center justify-content-center">
            $roleTableView
        </div>
        HTML;
    }
}
