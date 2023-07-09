<?php

namespace model;

use SQL\DataManipulator;

class AuthorisationModel
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
        $this->setTableName("Authorisation");
        $this->setColumns("id_authorisation INT PRIMARY KEY AUTO_INCREMENT, id_groupe INT (100), id_role INT (100)");
        $this->dataManipulator = new DataManipulator();
        $this->dataManipulator->createTable($this->tableName, $this->columns);
    }

    public function getGroupeRoles($id_groupe): array
    {
        $query = "SELECT name FROM Role WHERE id_role IN (SELECT id_role FROM Authorisation WHERE id_groupe = $id_groupe);";
        return $this->dataManipulator->executeQuery($this->tableName, $query);
    }
}
