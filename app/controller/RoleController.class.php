<?php

namespace controller;

use lib\Table;
use model\RoleModel;

class RoleController
{
    private $roleModel;
    private $table;

    /*
    * getters and setters
    **/
    public function setTable(Table $table): void
    {
        $this->table = $table;
    }

    public function getTable(): Table
    {
        return $this->table;
    }

    public function getRoldeModel(): RoleModel
    {
        return $this->roleModel;
    }
    public function setRoleModel(RoleModel $roleModel):void
    {
        $this->roleModel = $roleModel;
    }
    //-----------------------------
    public function __construct()
    {
        $this->setRoleModel(new RoleModel());
        $this->setTable(new Table());
    }
    //-----------------------------

    public function renderTable():void
    {
        echo $this->table->render();
    }
    
}