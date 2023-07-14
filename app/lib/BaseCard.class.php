<?php

namespace lib;

class BaseCard
{
    protected $title;
    protected $message;
    protected $backgroundColor;
    protected $iconBackgroundColor;
    protected $icon;
    protected $textColor;
    protected $iconTextColor = "#000";

    /**
     * setter & getter
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    public function getTiltle(): string
    {
        return $this->title;
    }
    public function setmessage(mixed $message): void
    {
        $this->message = $message;
    }
    public function  getmessage(): mixed
    {
        return $this->message;
    }
    public function setBackroundColor(string $backgroundColor): void
    {
        $this->backgroundColor = $backgroundColor;
    }
    public function  getBackgroundColor(): string
    {
        return $this->backgroundColor;
    }
    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }
    public function getIcon(): string
    {
        return $this->icon;
    }
    public function setTextColor(string $textColor): void
    {
        $this->textColor = $textColor;
    }
    public function getTextColor(): string
    {
        return $this->textColor;
    }
    public function setIconTextColor(string $iconTextColor): void
    {
        $this->iconTextColor = $iconTextColor;
    }
    public function setIconBackground(string $iconBackgroundColor): void
    {
        $this->iconBackgroundColor = $iconBackgroundColor;
    }
    public function getIconBackground(): string
    {
        return $this->iconBackgroundColor;
    }
    // -------------------------------

    public function __construct()
    {
        $this->setBackroundColor("#fff");
        $this->setIconBackground("#ddd");
        $this->setTextColor("#000");
        $this->setIconTextColor("#000");
    }

    private function renderIcon(): mixed
    {
        $iconBackgroundColor = $this->iconBackgroundColor;
        $iconTextColor = $this->iconTextColor;
        if (isset($this->icon)) {
            return <<<HTML
            <span class="material-icons-outlined rounded-circle p-1 m-2" style="background-color:$iconBackgroundColor; color:$iconTextColor; font-size:2.5rem;">
                $this->icon
            </span>
            HTML;
        }
        return null;
    }

    protected function render(): string
    {
        $icon = $this->renderIcon();

        $iconHtml = '';
        if ($icon !== null) {
            $iconHtml = $icon;
        }

        return <<<HTML
        <div class="global-data-card m-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body" style="background-color: $this->backgroundColor; color: $this->textColor;">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title text-capitalize flex-grow-1">$this->title</h5>
                        $iconHtml
                    </div>
                    <hr class="hr" >
                    <h6 class="d-flex card-subtitle mb-2 mt-2" style="color: $this->textColor;">$this->message</h6>
                </div>
            </div>
        </div>
        HTML;
    }
}
