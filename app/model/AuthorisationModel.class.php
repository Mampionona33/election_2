<?php

namespace model;

use SQL\DataManipulator;

class AuthorisationModel extends BaseModel
{

    public function __construct()
    {
        $this->setTableName("Authorisation");
        $this->setColumns("id_authorisation INT PRIMARY KEY AUTO_INCREMENT, id_groupe INT (100), id_role INT (100)");
        $this->dataManipulator = new DataManipulator();
        $this->dataManipulator->createTable($this->tableName, $this->columns);
    }

    public function getGroupeRoles(int $groupeId): mixed
    {
        $query = "SELECT name FROM Role WHERE id_role IN (SELECT id_role FROM " . $this->tableName . " WHERE id_groupe = " . $groupeId . ")";
        $result = $this->dataManipulator->executeQuery($query);
        return $result;
    }

    public function getGroupeRolesReadable(): mixed
    {
        $this->setQuery("SELECT a.id_authorisation, r.label AS role_label, g.name AS groupe_label
        FROM Authorisation AS a
        JOIN Role AS r ON a.id_role = r.id_role
        JOIN Groupe AS g ON a.id_groupe = g.id_groupe
        ORDER BY g.name
        LIMIT 0, 25;
        ");
        $result = $this->dataManipulator->executeQuery($this->query);
        return $result;
    }
}
