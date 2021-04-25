<?php
namespace Romainjeff\Resales;

interface ResalesClient
{
    public function getProperties(Filters $filters);
    public function getProperty($referenceID);
    public function getPaginationFromFilters(Filters $filters);
}