<?php

namespace SQL;

use Error;
use PDO;
use src\DataBase;

class DataManipulator
{
    private $sql;
    private $stmt;
    private $db;
    private $conn;
    private $sqlFile;

    public function setSqlFile(string $sqlFile): void
    {
        $this->sqlFile = $sqlFile;
    }

    public function getSqlFile(): string
    {
        return $this->sqlFile;
    }

    public function setConn($conn): void
    {
        $this->conn = $conn;
    }

    public function getConn()
    {
        return $this->conn;
    }

    public function setDb(DataBase $db): void
    {
        $this->db = $db;
    }

    public function getDb(): DataBase
    {
        return $this->db;
    }

    public function setStmt($stmt)
    {
        $this->stmt = $stmt;
    }

    public function getStmt()
    {
        return $this->stmt;
    }

    public function setSql(string $sql): void
    {
        $this->sql = $sql;
    }

    public function getSql(): string
    {
        return $this->sql;
    }

    public function __construct()
    {
        $this->db = new DataBase();
        $this->conn = $this->db->connect();
    }

    public function createTable(string $tableName, string $columnsDef): void
    {
        $this->setSqlFile(__DIR__ . "/create_table.sql");

        if ($this->sqlFile) {
            $this->setSql(file_get_contents($this->sqlFile));

            $columnsArray = explode(',', $columnsDef);
            $columnsArray = array_map('trim', $columnsArray);
            $columnsArray = array_map('strtolower', $columnsArray);
            $columnsArray = array_unique($columnsArray);

            $tableColumns = implode(',', array_unique($columnsArray));

            $sql = str_replace(':tableName', $tableName, $this->sql);
            $sql = str_replace(':columnsDef', $tableColumns, $sql);

            $this->setStmt($this->conn->prepare($sql));
            $this->stmt->execute();
        }
    }

    public function getData($tableName, $query): array
    {
        $this->setSqlFile(__DIR__ . "/get_data.sql");

        if (is_file($this->sqlFile)) {
            $this->setSql(file_get_contents($this->sqlFile));

            // Préparer la requête SELECT avec les paramètres
            $selectSql = "SELECT * FROM $tableName WHERE $query";

            // Préparer et exécuter la requête préparée
            $stmt = $this->conn->prepare($selectSql);

            $stmt->execute();

            // Récupérer les résultats
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }
    }

    public function executeQuery(string $query): array
    {
        $this->setSqlFile(__DIR__ . "/executeQuery.sql");
        if (is_file($this->sqlFile)) {
            $this->setSql(file_get_contents($this->sqlFile));
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }
    }
}
