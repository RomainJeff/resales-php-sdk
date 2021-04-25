<?php
namespace Romainjeff\Resales\VO;

class ListPagination
{
    private $totalProperties;
    private $propertiesPerPage;
    private $totalPages;

    public function __construct(
        int $totalProperties,
        int $propertiesPerPage
    ) {
        $this->totalProperties = $totalProperties;
        $this->propertiesPerPage = $propertiesPerPage;
        $this->totalPages = ceil($totalProperties / $propertiesPerPage);
    }

    public function getTotalProperties(): int
    {
        return $this->totalProperties;
    }

    public function getPropertiesPerPage(): int
    {
        return $this->propertiesPerPage;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }
}