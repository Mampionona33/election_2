<?php

namespace template;

class Template
{
    private $title;
    private $body;
    private $navbar;

    public function setNavbar(mixed $navbar): void
    {
        $this->navbar = $navbar;
    }

    public function getNavbar(): string
    {
        return $this->navbar;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setTilte(string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    private function documentPage(): string
    {
        $title = $this->title;
        $body = $this->body;
        $navbar = $this->navbar;

        return <<<HTML
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
                <div class="container">
                    $body
                </div>
                <script src="../dist/app-bundle.js"></script>
            </body>

            </html>
        HTML;
    }

    public function render(): void
    {
        echo $this->documentPage();
        exit();
    }
}
