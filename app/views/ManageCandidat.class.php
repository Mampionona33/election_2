<?php

namespace views;

use controller\AuthController;
use lib\Table;

class ManageCandidat extends BaseView
{
    private $table;

    private function setTable(Table $table)
    {
        $this->table = $table;
    }

    private function getTable(): Table
    {
        return $this->table;
    }

    public function __construct(AuthController $authController)
    {
        parent::__construct($authController);
        $this->setTable(new Table());
        $this->setTilte("Manage candidat");
        $this->setBody($this->generateBody());
    }

    protected function generateBody(): string
    {
        $userIdGroupe = $this->userIdGroupe;
        $table = $this->table->render();
        return <<<HTML
        <div>
            Manage Candidat , id_groupe = $userIdGroupe
            <div>$table</div>
        </div>
        HTML;
    }
}
