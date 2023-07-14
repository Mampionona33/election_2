<?php

namespace model;

use SQL\DataManipulator;

class BaseModel
{
    protected $tableName;
    protected $columns;
    protected $dataManipulator;
    protected $query;

    /**
     * getter and setter
     */
    public function setQuery(string $query): void
    {
        $this->query = $query;
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * Getters and setters
     */
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

    // Constructor
    public function __construct(string $tableName, string $columns)
    {
        $this->setTableName($tableName);
        $this->setColumns($columns);
        $this->setDataManipulator(new DataManipulator());
        $this->dataManipulator->createTable($this->tableName, $this->columns);
    }

    // Create a new record
    public function create(array $data): bool
    {
        $columns = [];
        $values = [];

        foreach ($data as $key => $value) {
            $columns[] = $key;
            $values[] = is_string($value) ? "'$value'" : $value;
        }

        $columnsString = implode(', ', $columns);
        $valuesString = implode(', ', $values);

        $query = "INSERT INTO $this->tableName ($columnsString) VALUES ($valuesString)";
        $result = $this->dataManipulator->executeQuery($query);

        return !empty($result);
    }

    // Retrieve all records
    public function getAll(): array
    {
        $query = "SELECT * FROM $this->tableName";
        return $this->dataManipulator->executeQuery($query);
    }

    // Retrieve a specific record by ID
    public function getById(int $id): array
    {
        $query = "SELECT * FROM $this->tableName WHERE id = $id";
        return $this->dataManipulator->executeQuery($query);
    }

    // Update a specific record by ID
    public function update(int $id, array $data): bool
    {
        $updates = [];

        foreach ($data as $key => $value) {
            $updates[] = is_string($value) ? "$key = '$value'" : "$key = $value";
        }

        $updatesString = implode(', ', $updates);

        $query = "UPDATE $this->tableName SET $updatesString WHERE id = $id";
        $result = $this->dataManipulator->executeQuery($query);

        return !empty($result);
    }

    // Delete a specific record by ID
    public function delete(int $id): bool
    {
        $query = "DELETE FROM $this->tableName WHERE id = $id";
        $result = $this->dataManipulator->executeQuery($query);

        return !empty($result);
    }
}