<?php

namespace views;

class Dashboard extends HomePage
{
    private $template;

    public function __construct()
    {
        parent::__construct();
        $this->template = parent::getTemplate();
        $this->template->setTilte("Dashboard");
        $this->setBody($this->generateBody());
    }

    protected function generateBody(): string
    {
        return <<<HTML
        <div>Dashboard</div>
        HTML;
    }
}
