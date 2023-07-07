<?php

namespace views;

use lib\Sidebar;

class Dashboard extends HomePage
{
    private $template;
    private $sidebar;

    public function setSidebar(Sidebar $sidebar): void
    {
        $this->sidebar = $sidebar;
    }

    public function getSidebar(): Sidebar
    {
        return $this->sidebar;
    }

    public function __construct()
    {
        parent::__construct();
        $this->template = parent::getTemplate();
        $this->template->setTilte("Dashboard");
        $this->setSidebar(new Sidebar());
        $this->template->setSidebar($this->sidebar->render());
        $this->setBody($this->generateBody());
    }

    protected function generateBody(): string
    {
        return <<<HTML
        <div>Dashboard</div>
        HTML;
    }
}
