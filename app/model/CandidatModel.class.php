<?php

namespace model;

use SQL\DataManipulator;

class CandidatModel
{
    private $tableName;
    private $columns;
    private $dataManipulator;

    public function setTableName(string $tableName): void
    {
        $this->tableName = $tableName;
    }
    public function getTableName(): string
    {
        return $this->tableName;
    }

    public function setColumns(string $columns): void
    {
        $this->columns = $columns;
    }

    public function getColumns(): string
    {
        return $this->columns;
    }

    public function setDataManipulator(DataManipulator $dataManipulator): void
    {
        $this->dataManipulator = $dataManipulator;
    }

    public function getDataManipulator(): DataManipulator
    {
        return $this->dataManipulator;
    }

    public function __construct()
    {
        $this->setTableName("Candidat");
        $this->setColumns("id_candidat INT PRIMARY KEY AUTO_INCREMENT,name VARCHAR(255), nb_voix BIGINT");
        $this->setDataManipulator(new DataManipulator());
        $this->dataManipulator->createTable($this->tableName, $this->columns);
    }
}
