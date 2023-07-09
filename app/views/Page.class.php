<?php

namespace template;

use lib\Navbar;

class Page
{
    private $title;
    private $body;
    private $navbar;
    private $sidebar;
    private $toast;

    public function __construct()
    {
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setNavbar(Navbar $navbar): void
    {
        $this->navbar = $navbar;
    }

    public function getNavbar(): Navbar
    {
        return $this->navbar;
    }

    public function setToast($toast): void
    {
        $this->toast = $toast;
    }

    public function getToast()
    {
        return $this->toast;
    }

    public function render(): void
    {
        $title = $this->title;
        $body = $this->body;
        $navbar = $this->navbar;
        $sidebar = $this->sidebar;
        $toast = $this->toast;

        echo <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../dist/style.css">
            <title>$title</title>
        </head>
        <body>
            $navbar
            $sidebar
            <div class="container">
                $toast
                $body
            </div>
            <script src="../dist/app-bundle.js"></script>
        </body>
        </html>
        HTML;

        exit();
    }
}
