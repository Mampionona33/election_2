<?php

namespace views;

use controller\AuthController;

class ManageAuthorization extends BaseView
{
    private $authorizationTableView;
    /**
     * getter and setter 
     */
    public function setAuthorizationTableView(AuthorizationTableView $authorizationTableView): void
    {
        $this->authorizationTableView = $authorizationTableView;
    }
    public function getAuthorizationTableView(): AuthorizationTableView
    {
        return $this->authorizationTableView;
    }
    public function __construct(AuthController $authController)
    {
        parent::__construct($authController);
        $this->setTilte("Manage Authorization");
        $this->setAuthorizationTableView(new AuthorizationTableView());
        $this->setBody($this->generateBody());
    }

    protected function generateBody(): string
    {
        $authorizationTableView = $this->authorizationTableView->render();
        return <<<HTML
        <div>
            $authorizationTableView
        </div>
        HTML;
    }
}
