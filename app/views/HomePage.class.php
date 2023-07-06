<?php

namespace views;

use controller\AuthentificationController;
use template\Template;
use views\Navbar;

class HomePage
{
    private $title;
    private $body;
    private $template;
    private $navBar;
    private $authentificationController;

    public function setauthentificationController(AuthentificationController $authentificationController): void
    {
        $this->authentificationController = $authentificationController;
    }

    public function getAuthentificationController(): AuthentificationController
    {
        return $this->authentificationController;
    }

    public function setNavbar(Navbar $navBar): void
    {
        $this->navBar = $navBar;
    }

    public function getNavbar(): Navbar
    {
        return $this->navBar;
    }

    public function setTemplate(Template $template): void
    {
        $this->template = $template;
    }

    public function getTemplate(): Template
    {
        return $this->template;
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

    public function __construct()
    {
        $this->setTemplate(new Template());

        $this->setTitle("Home");
        $this->setBody($this->generateBody());

        $this->setNavbar(new Navbar());

        $this->template->setNavbar($this->navBar->render());
        $this->template->setTilte($this->title);
        $this->template->setBody($this->body);
    }

    private function generateBody(): string
    {
        return <<<HTML
        <div>
            test 123
        </div>
        HTML;
    }

    public function render()
    {
        $this->template->render();
    }
}
