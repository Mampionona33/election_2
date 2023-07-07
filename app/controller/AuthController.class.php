<?php

namespace controller;

use Error;
use model\UserModel;

class AuthController
{
    private $userLogged;
    private $userModel;

    public function  setUserModel(UserModel $userModel): void
    {
        $this->userModel = $userModel;
    }

    public function getUserModel(): UserModel
    {
        return $this->userModel;
    }

    public function setUserLogged(array $userLogged): void
    {
        $this->userLogged = $userLogged;
    }

    public function getUserLogged(): array
    {
        return $this->userLogged;
    }

    function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function handleLogin(): void
    {
        if (isset($_POST)) {
            if (isset($_POST["email"]) && isset($_POST["password"])) {
                $this->setUserLogged($this->userModel->getByEmail($_POST));
                if (!empty($this->userLogged)) {
                    session_start();
                    $_SESSION["user"] = $this->userLogged;
                    header("Location: /dashboard");
                    exit();
                }
            } else {
                throw new Error("Obligatory value required", 1);
            }
        }
    }

    public function isUserLogged(): bool
    {
        if (isset($_SESSION["user"])) {
            return true;
        }
        return false;
    }

    public function handleLogout(): void
    {
        header("Location: /");
        session_start();
        session_destroy();
        exit();
    }
}
