<?php

namespace model;

use SQL\DataManipulator;

class UserModel
{
    private $dataManipulator;
    private $tableName;
    private $columns;

    public function setColumns(string $columns): void
    {
        $this->columns = $columns;
    }

    public function getColumns(): string
    {
        return $this->columns;
    }

    public function setTableName(string $tableName): void
    {
        $this->tableName = $tableName;
    }

    public function getTableName(): string
    {
        return $this->tableName;
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
        $this->setTableName("User");
        $this->setColumns("id_user INT PRIMARY KEY AUTO_INCREMENT,email VARCHAR(255), password VARCHAR(255), id_groupe INT");
        $this->dataManipulator = new DataManipulator();
        $this->dataManipulator->createTable($this->tableName, $this->columns);
    }

    public function getByEmail($user): array
    {
        $query = "email = '{$user["email"]}' AND password= '{$user["password"]}'";
        return $this->dataManipulator->getData($this->tableName, $query);
    }
}
