<?php

namespace controller;

use lib\Table;
use model\CandidatModel;

class CandidatController
{
    private $candidatModel;
    private $table;

    public function setTable(Table $table): void
    {
        $this->table = $table;
    }

    public function getTable(): Table
    {
        return $this->table;
    }

    public function setCandidatModel(CandidatModel $candidatModel): void
    {
        $this->candidatModel = $candidatModel;
    }

    public function getCandidatModel(): CandidatModel
    {
        return $this->candidatModel;
    }

    public function __construct()
    {
        $this->candidatModel = new CandidatModel();
        $this->setTable(new Table());
    }

    public function renderTable(): void
    {
        echo  $this->table->render();
    }
}
