<?php

namespace controller;

use Error;

class AuthController
{
    function __construct()
    {
    }

    public function handleLogin(): void
    {
        if (isset($_POST)) {
            if (isset($_POST["email"]) && isset($_POST["password"])) {
                var_dump($_POST);
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
