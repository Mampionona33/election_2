<?php

namespace controller;

use model\AuthorisationModel;

class AuthorisationController
{
    private $userRoles;
    private $authorisationModel;


    public function  setAuthorisationModel(AuthorisationModel $authorisationModel): void
    {
        $this->authorisationModel = $authorisationModel;
    }

    public function getAuthorisationModel(): AuthorisationModel
    {
        return $this->authorisationModel;
    }

    public function setUserRoles($userRoles): void
    {
        $this->userRoles;
    }

    public function getUserRoles()
    {
        return $this->userRoles;
    }

    public function __construct()
    {
        $this->setAuthorisationModel(new AuthorisationModel());
    }

    public function getGroupeRoles($id_groupe): array
    {
        return $this->authorisationModel->getGroupeRoles($id_groupe);
    }

    public function isUserAuthorizedTo(int $id_groupe, string $role): bool
    {
        $userRoles = $this->getGroupeRoles($id_groupe);
        return in_array($role, $userRoles);
    }
}
