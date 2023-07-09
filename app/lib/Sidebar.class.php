<?php

namespace lib;

class Sidebar
{
    private $sidebarContents;
    private $sidebarItems;

    public function setSidebarItems(string $sidebarItems): void
    {
        $this->sidebarItems = $sidebarItems;
    }

    public function getSidebarItems(): string
    {
        return $this->sidebarItems;
    }

    public function setSidebarContents(array $sidebarContents): void
    {
        $this->sidebarContents = $sidebarContents;
    }

    public function getSidebarContents(): array
    {
        return $this->sidebarContents;
    }

    public function __construct()
    {
    }

    public function render(): string
    {
        if (!empty($this->sidebarContents)) {
            foreach ($this->sidebarContents as $key => $item) {
                $path = $item["path"];
                $label = $item["label"];
                $this->sidebarItems .= '<a class="text-decoration-none text-dark p-2" href="' . $path . '">' . $label . '</a>';
            }

            // Vérifier si nous ne sommes pas sur le dernier élément du tableau
            if ($key !== array_key_last($this->sidebarContents)) {
                $this->sidebarItems .= '<hr class="sidebar-divider m-0">';
            }
        }


        return <<<HTML
        <div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title d-flex align-items-center gap-1" id="staticBackdropLabel">
                    <span class="material-icons">menu</span>    
                    Menu
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0">
                <div class="d-flex flex-column " > $this->sidebarItems</div>
            </div>
        </div>
        HTML;
    }
}
