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
        $this->filters['p_Country'] = $country;
        return $this;
    }

    /**
     * @param array $area
     * @return Filters
     */
    public function inAreas(array $area)
    {
        $this->filters['p_Area'] = implode(',', $area);
        return $this;
    }

    /**
     * @param array $cities
     * @return $this
     */
    public function inCities(array $cities)
    {
        $this->filters['p_Location'] = implode(',', $cities);
        return $this;
    }

    /**
     * @param int $price
     * @return Filters
     */
    public function withPriceAtLeast($price)
    {
        $this->filters['p_Min'] = $price;
        return $this;
    }

    /**
     * @param int $price
     * @return Filters
     */
    public function withPriceLessThan($price)
    {
        $this->filters['p_Max'] = $price;
        return $this;
    }

    /**
     * @param int $beds
     * @return Filters
     */
    public function withAtLeastBeds($beds)
    {
        $this->filters['p_Beds'] = $beds .'x';
        return $this;
    }

    /**
     * @param int $baths
     * @return Filters
     */
    public function withAtLeastBaths($baths)
    {
        $this->filters['p_Baths'] = $baths .'x';
        return $this;
    }

    /**
     * @param array $propertyTypes
     * @return Filters
     */
    public function withPropertyTypes(array $propertyTypes)
    {
        $this->filters['p_PropertyTypes'] = implode(',', $propertyTypes);
        return $this;
    }

    /**
     * @param string $feature
     * @return Filters
     */
    public function withFeature($feature)
    {
        $this->filters['p_MustHaveFeatures'] = 2;
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
        $this->filters['p_PageNo'] = $page;
        return $this;
    }

    /**
     * @param array $references
     * @return Filters
     */
    public function withReferences(array $references)
    {
        $this->filters['p_RefId'] = implode(',', $references);
        return $this;
    }

    public function onlyNewDevelopment()
    {
        $this->filters['p_New_Devs'] = 'only';
        return $this;
    }

    public function excludeNewDevelopment()
    {
        $this->filters['p_New_Devs'] = 'exclude';
        return $this;
    }

    /**
     * @param int $count
     */
    public function imagesCount($count)
    {
        $this->filters['p_images'] = $count;
        return $this;
    }

    public function sortByNewest()
    {
        $this->filters['p_SortType'] = 5;
        return $this;
    }

    public function sortByOldest()
    {
        $this->filters['p_SortType'] = 6;
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
