<?php

namespace SQL;

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
        $this->setConn($this->db->connect());
    }

    public function createTable(string $tableName, string $columnsDef): void
    {
        $this->setSqlFile(__DIR__ . "/create_table.sql");
        $sql = file_get_contents($this->sqlFile);

        $this->setStmt($this->conn->prepare($sql));

        $this->stmt->bindParam(':tableName', $tableName, PDO::PARAM_STR);
        $this->stmt->bindParam(':columnsDef', $columnsDef, PDO::PARAM_STR);

        $this->stmt->execute();
    }


    public function getData($tableName, $query): array
    {
        $this->setSqlFile(__DIR__ . "/get_data.sql");
        $sql = file_get_contents($this->sqlFile);

        $this->setStmt($this->conn->prepare($sql));

        $this->stmt->bindParam(':tableName', $tableName, PDO::PARAM_STR);
        $this->stmt->bindParam(':query', $query, PDO::PARAM_STR);

        $this->stmt->execute();

        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
