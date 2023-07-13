<?php

namespace model;

use SQL\DataManipulator;

class CandidatModel extends BaseModel
{
    public function __construct()
    {
        $this->setTableName("Candidat");
        $this->setColumns("id_candidat INT PRIMARY KEY AUTO_INCREMENT,name VARCHAR(255), nb_voix BIGINT");
        $this->setDataManipulator(new DataManipulator());
        $this->dataManipulator->createTable($this->tableName, $this->columns);
    }

    public function getAll(): array
    {
        $this->setQuery("SELECT id_candidat, name, nb_voix AS voix, CONCAT( ROUND((nb_voix * 100 / (SELECT SUM(nb_voix) FROM $this->tableName)), 2) ,' %') AS pourcentage FROM $this->tableName;");
        return $this->dataManipulator->executeQuery($this->query);
    }

    public function getFirstCandidat(): array
    {
        $this->setQuery("SELECT *, ROUND(nb_voix * 100 / (SELECT SUM(nb_voix) FROM $this->tableName)) AS percentage FROM $this->tableName WHERE id_candidat = (SELECT MIN(id_candidat) FROM $this->tableName);");
        return $this->dataManipulator->executeQuery($this->query);
    }

    public function getCandidatWithMaxPoint(): array
    {
        $this->setQuery("SELECT *, ROUND(nb_voix * 100 / (SELECT SUM(nb_voix) FROM $this->tableName)) AS percentage FROM $this->tableName WHERE nb_voix = (SELECT Max(nb_voix) FROM $this->tableName);");
        return $this->dataManipulator->executeQuery($this->query);
    }
}
