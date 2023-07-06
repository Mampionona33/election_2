<?php

namespace controller;

class AuthentificationController
{
    public function isUserLogged(): bool
    {
        if (isset($_SESSION["user"])) {
            return true;
        }
        return false;
    }
}
