<?php

namespace views;

use lib\Table;
use model\CandidatModel;

class CandidatTableView extends Table
{
    private $candidatModel;


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
        $this->setCandidatModel(new CandidatModel());
        $this->setData($this->candidatModel->getAll());
        $this->setHeaders(["id_candidat", "Noms", "Nombres de voix", "Pourcentage"]);
        $this->setHideFirstColumn(true);
        $this->setButtonAddVisible(true);
        $this->setButtonEditVisible(true);
        $this->setDeleteButtonVisible(true);
    }

    public function render(): string
    {
        return parent::render();
    }
}
