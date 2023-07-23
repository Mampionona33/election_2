<?php

namespace lib;

class Pagination
{
    private $totalItems;
    private $itemsPerPage;

    public function __construct(int $totalItems, int $itemsPerPage)
    {
        $this->totalItems = $totalItems;
        $this->itemsPerPage = $itemsPerPage;
    }

    public function getTotalPages(): int
    {
        return ceil($this->totalItems / $this->itemsPerPage);
    }

    public function generateLinks(int $currentPage): string
    {
        $totalPages = $this->getTotalPages();

        $paginationHTML = '<ul class="pagination">';

        for ($i = 1; $i <= $totalPages; $i++) {
            $activeClass = $i === $currentPage ? 'active' : '';
            $paginationHTML .= '<li class="page-item ' . $activeClass . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        }

        $paginationHTML .= '</ul>';
        return $paginationHTML;
    }
}
