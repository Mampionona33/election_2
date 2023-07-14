<?php

namespace views;

use lib\Table;
use model\AuthorisationModel;

class AuthorizationTableView extends Table
{
    private $authorisationModel;
    /**
     * getter and setter
     */
    public function setAuthorisationModel(AuthorisationModel $authorisationModel): void
    {
        $this->authorisationModel = $authorisationModel;
    }
    public function getGuthorisationModel(): AuthorisationModel
    {
        return $this->authorisationModel;
    }
    public function __construct()
    {
        $this->setAuthorisationModel(new AuthorisationModel());
        $this->setHeaders(["id_authorization", "role", "groupe"]);
        $this->setData($this->authorisationModel->getGroupeRolesReadable());
        $this->setHideFirstColumn(true);
        $this->setButtonAddVisible(true);
        $this->setDeleteButtonVisible(true);
    }
}
