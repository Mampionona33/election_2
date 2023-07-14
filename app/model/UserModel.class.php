<?php

namespace model;

use SQL\DataManipulator;

class UserModel extends BaseModel
{

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
