<?php

namespace views;

use controller\AuthController;
use template\Template;
use views\Navbar;

class HomePage
{
    private $title;
    private $body;
    private $template;
    private $navBar;
    private $authController;

    public function setauthController(AuthController $authController): void
    {
        $this->authController = $authController;
    }

    public function getauthController(): AuthController
    {
        return $this->authController;
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

    protected function generateBody(): string
    {
        return <<<HTML
        <div>
            test 123
        </div>
        HTML;
    }

    public function render(): void
    {
        $this->template->render();
    }
}
