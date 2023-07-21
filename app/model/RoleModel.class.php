<?php

namespace model;

use SQL\DataManipulator;

class RoleModel extends BaseModel
{
    public function __construct()
    {
        $this->setTableName("Role");
        $this->setColumns("id_role INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(100) NOT NULL, label VARCHAR(100) NOT NULL");
        $this->dataManipulator = new DataManipulator();
        $this->dataManipulator->createTable($this->tableName, $this->columns);
    }
}
