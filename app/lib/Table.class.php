<?php

namespace lib;

class Table
{

    protected $searchBarState;
    protected $addButtonState;
    protected $editButtonState;
    protected $deleteButtonState;
    protected $headers;
    protected $data;
    protected $hideFirstColumn;

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setButtonAddVisible(bool $addButtonState): void
    {
        $this->addButtonState = $addButtonState;
    }

    public function getAddButtonState(): bool
    {
        return $this->addButtonState;
    }

    public function setButtonEditVisible(bool $editButtonState): void
    {
        $this->editButtonState = $editButtonState;
    }

    public function getEditButtonState(): bool
    {
        return $this->editButtonState;
    }

    public function setDeleteButtonVisible(bool $deleteButtonState): void
    {
        $this->deleteButtonState = $deleteButtonState;
    }

    public function getDeleteButtonState(): bool
    {
        return $this->deleteButtonState;
    }

    public function setSearchBarState(bool $searchBarState): void
    {
        $this->searchBarState = $searchBarState;
    }

    public function getSearchBarState(): bool
    {
        return $this->searchBarState;
    }

    public function setHideFirstColumn(bool $hideFirstColumn): void
    {
        $this->hideFirstColumn = $hideFirstColumn;
    }

    public function getHideFirstColumn(): bool
    {
        return $this->hideFirstColumn;
    }

    protected function generateHeader(): string
    {
        $headers = $this->getHeaders();
        $headerHTML = '';

        // Vérifier si la première colonne doit être masquée
        if ($this->hideFirstColumn) {
            array_shift($headers);
        }

        foreach ($headers as $header) {
            $headerHTML .= "<th>$header</th>";
        }

        // Vérifier si la colonne "Actions" doit être affichée
        if ($this->editButtonState || $this->deleteButtonState) {
            $headerHTML .= "<th>Actions</th>";
        }

        return $headerHTML;
    }

    protected function generateBody(): string
    {
        $data = $this->getData();
        $bodyHTML = '';

        if (empty($data)) {
            $colspan = count($this->getHeaders()) + ($this->editButtonState || $this->deleteButtonState ? 1 : 0);
            $bodyHTML .= '<tr><td colspan="' . $colspan . '">No data found</td></tr>';
        } else {
            foreach ($data as $row) {
                $bodyHTML .= '<tr>';

                // Récupérer la clé de l'ID
                $rowId = reset($row);

                // Vérifier si la première colonne doit être masquée
                if ($this->hideFirstColumn) {
                    array_shift($row);
                }

                foreach ($row as $cell) {
                    $bodyHTML .= "<td>$cell</td>";
                }

                // Vérifier si la colonne "Actions" doit être affichée
                if ($this->editButtonState || $this->deleteButtonState) {
                    $actionsHTML = '';

                    if ($this->editButtonState) {
                        $actionsHTML .= '<button type="button" name="edit" class="btn btn-primary" data-id="' . $rowId . '">Modifier</button>';
                    }

                    if ($this->deleteButtonState) {
                        $actionsHTML .= '<button type="button" name="delete" class="btn btn-danger" data-id="' . $rowId . '">Supprimer</button>';
                    }

                    $bodyHTML .= '<td class="d-flex flex-wrap gap-1 justify-content-center">' . $actionsHTML . '</td>';
                }

                $bodyHTML .= '</tr>';
            }
        }

        return $bodyHTML;
    }

    protected function generateAddButton(): mixed
    {
        if ($this->addButtonState) {
            return '
                <button type="button" id="table-btn-add" class="btn btn-primary d-flex align-items-center gap-1">
                    <span class="material-icons-outlined">
                        add_circle_outline
                    </span>
                    Ajouter
                </button>
            ';
        }
        return null;
    }

    protected function generateSharBar()
    {
        if ($this->searchBarState) {
            return '
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            ';
        }
        return null;
    }

    public function render(): string
    {
        $searchBar = $this->generateSharBar();
        $addBtn = $this->generateAddButton();
        $headers = $this->generateHeader();
        $tableBody = $this->generateBody();

        return <<<HTML
            <div class="d-flex flex-column align-items-center justify-content-center vh-100">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    $searchBar
                    $addBtn
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="overflow-auto" style="max-height: 400px;">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped shadow-sm">
                                        <thead class="text-uppercase table-dark sticky-top" style="position: sticky!important; top: 0;">
                                            <tr>$headers</tr>
                                        </thead>
                                        <tbody>
                                            $tableBody
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        HTML;
    }
}
