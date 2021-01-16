<?php
namespace Romainjeff\Resales;

class Filters
{
    /** @var string[] */
    private $filters;

    public function __construct()
    {
        $this->filters = [];
    }

    /**
     * @param int $lang
     * @return Filters
     */
    public function withLanguage($lang)
    {
        $this->filters['Lang'] = $lang;
        return $this;
    }

    /**
     * @param string $country
     * @return Filters
     */
    public function inCountry($country)
    {
        $this->filters['P_Country'] = $country;
        return $this;
    }

    /**
     * @param array $area
     * @return Filters
     */
    public function inAreas(array $area)
    {
        $this->filters['P_Area'] = implode(',', $area);
        return $this;
    }

    /**
     * @param array $cities
     * @return $this
     */
    public function inCities(array $cities)
    {
        $this->filters['P_Location'] = implode(',', $cities);
        return $this;
    }

    /**
     * @param int $price
     * @return Filters
     */
    public function withPriceAtLeast($price)
    {
        $this->filters['P_Min'] = $price;
        return $this;
    }

    /**
     * @param int $price
     * @return Filters
     */
    public function withPriceLessThan($price)
    {
        $this->filters['P_Max'] = $price;
        return $this;
    }

    /**
     * @param int $beds
     * @return Filters
     */
    public function withAtLeastBeds($beds)
    {
        $this->filters['P_Beds'] = $beds .'x';
        return $this;
    }

    /**
     * @param int $baths
     * @return Filters
     */
    public function withAtLeastBaths($baths)
    {
        $this->filters['P_Baths'] = $baths .'x';
        return $this;
    }

    /**
     * @param array $propertyTypes
     * @return Filters
     */
    public function withPropertyTypes(array $propertyTypes)
    {
        $this->filters['P_PropertyTypes'] = implode(',', $propertyTypes);
        return $this;
    }

    /**
     * @param string $feature
     * @return Filters
     */
    public function withFeature($feature)
    {
        $this->filters[$feature] = 1;
        return $this;
    }

    /**
     * @param int $number
     * @return Filters
     */
    public function displayedProperties($number)
    {
        $this->filters['p_PageSize'] = $number;
        return $this;
    }

    /**
     * @param int $page
     * @return Filters
     */
    public function pageNumber($page)
    {
        $this->filters['P_PageNo'] = $page;
        return $this;
    }

    /**
     * @param array $references
     * @return Filters
     */
    public function withReferences(array $references)
    {
        $this->filters['P_RefId'] = implode(',', $references);
        return $this;
    }

    public function onlyNewDevelopment()
    {
        $this->filters['P_New_Devs'] = 2;
        return $this;
    }

    public function excludeNewDevelopment()
    {
        $this->filters['P_New_Devs'] = 0;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getFilters()
    {
        return $this->filters;
    }

}
