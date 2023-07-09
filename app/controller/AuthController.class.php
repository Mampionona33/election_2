<?php

namespace controller;

use Error;
use model\UserModel;

class AuthController
{
    private $userLogged;
    private $userModel;
    private $userIdGroupe;

    public function setUserIdGroupe(mixed $userIdGroupe): void
    {
        $this->userIdGroupe = $userIdGroupe;
    }

    public function getUserIdGroupe(): mixed
    {
        return $this->userIdGroupe;
    }

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

    public function getUserLogged()
    {
        if (isset($_SESSION["user"])) {
            return $_SESSION["user"];
        }
        return null;
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
                // session_save_path(__DIR__ . "/tmp");
                if (!empty($this->userLogged)) {
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION["user"] = $this->userLogged;
                    // $this->setUserLogged($_SESSION["user"]);

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

    // public function getUserLoggedIdGroupe(): void
    // {
    //     if (
    //         isset($_SESSION["user"])
    //         &&  isset($_SESSION["user"][0]["id_groupe"])
    //     ) {
    //         var_dump($_SESSION["user"][0]["id_groupe"]);
    //         $this->setUserIdGroupe($_SESSION["user"][0]["id_groupe"]);
    //     }
    // }
}
