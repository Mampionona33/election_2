<?php

namespace views;

use lib\Table;
use model\RoleModel;

class RoleTableView extends Table
{
    private $roleModel;

    /**
     * getters and setters
     */
    public function setRoleModel(RoleModel $roleModel): void
    {
        $this->roleModel = $roleModel;
    }
    public function getRoleModel(): RoleModel
    {
        return $this->roleModel;
    }

    public function __construct()
    {
        $this->setRoleModel(new RoleModel());
        $this->setData($this->roleModel->getAll());
        $this->setHeaders(["id_role", "name", "label"]);
        $this->setHideFirstColumn(true);
        $this->setButtonAddVisible(true);
        $this->setButtonEditVisible(true);
        $this->setDeleteButtonVisible(true);
    }
    public function render(): string
    {
        return parent::render();
    }
}
