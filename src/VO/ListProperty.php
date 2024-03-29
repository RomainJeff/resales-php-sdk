<?php
namespace Romainjeff\Resales\VO;

class ListProperty
{
    const RESALES_LINK = 'https://www-3.resales-online.com/live/ReSales/Search/PropertyDetail.asp?P1=';

    /** @var string */
    private $reference;

    /** @var string */
    private $agencyReference;

    /** @var string */
    private $country;

    /** @var string */
    private $area;

    /** @var string */
    private $location;

    /** @var string */
    private $type;

    /** @var string */
    private $subType;

    /** @var int */
    private $bedrooms;

    /** @var int */
    private $bathrooms;

    /** @var string */
    private $currency;

    /** @var int */
    private $originalPrice;

    /** @var int */
    private $price;

    /** @var int */
    private $surface;

    /** @var int */
    private $terraceSurface;

    /** @var int */
    private $plotSurface;

    /** @var bool */
    private $hasPool;

    /** @var bool */
    private $hasParking;

    /** @var bool */
    private $hasGarden;

    /** @var array */
    private $features;

    /** @var string */
    private $mainPicture;

    /** @var array */
    private $pictures;

    /** @var string */
    private $description;

    /** @var string */
    private $resalesLink;

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getAgencyReference()
    {
        return $this->agencyReference;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getSubType()
    {
        return $this->subType;
    }

    /**
     * @return int
     */
    public function getBedrooms()
    {
        return $this->bedrooms;
    }

    /**
     * @return int
     */
    public function getBathrooms()
    {
        return $this->bathrooms;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return int
     */
    public function getOriginalPrice()
    {
        return $this->originalPrice;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return bool
     */
    public function isOnSale()
    {
        return $this->price < $this->originalPrice;
    }

    /**
     * @return int
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * @return int
     */
    public function getTerraceSurface()
    {
        return $this->terraceSurface;
    }

    /**
     * @return int
     */
    public function getPlotSurface()
    {
        return $this->plotSurface;
    }

    /**
     * @return bool
     */
    public function hasPool()
    {
        return $this->hasPool;
    }

    /**
     * @return bool
     */
    public function hasParking()
    {
        return $this->hasParking;
    }

    /**
     * @return bool
     */
    public function hasGarden()
    {
        return $this->hasGarden;
    }

    /**
     * @return array
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * @return string
     */
    public function getMainPicture()
    {
        return $this->mainPicture;
    }

    /**
     * @return array
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getResalesLink()
    {
        return $this->resalesLink;
    }

    /**
     * @param array $json
     * @return ListProperty
     */
    public static function createFromJSON(array $json)
    {
        $property = new self();
        $property->reference = $json['Reference'];
        $property->agencyReference = $json['AgencyRef'];
        $property->country = $json['Country'];
        $property->area = $json['Area'];
        $property->location = $json['Location'];
        $property->type = $json['PropertyType']['Type'];
        $property->subType = $json['PropertyType']['Subtype1'];
        $property->bedrooms = (int) $json['Bedrooms'];
        $property->bathrooms = (int) $json['Bathrooms'];
        $property->currency = $json['Currency'];
        $property->originalPrice = (int) $json['OriginalPrice'];
        $property->price = (int) $json['Price'];
        $property->surface = (int) $json['Built'];
        $property->terraceSurface = (int) $json['Terrace'];
        $property->plotSurface = (int) $json['GardenPlot'];
        $property->hasPool = (int) $json['Pool'] === 1;
        $property->hasParking = (int) $json['Parking'] === 1;
        $property->hasGarden = (int) $json['Garden'] === 1;
        $property->description = $json['Description'];
        $property->resalesLink = self::RESALES_LINK . str_replace('R', '', $property->reference);

        // extract pictures
        if (!isset($json['Pictures'])) {
            $property->mainPicture = $json['MainImage'];
            $property->pictures[] = $property->getMainPicture();
        } else {
            foreach ($json['Pictures']['Picture'] as $picture) {
                $property->pictures[] = $picture['PictureURL'];
            }
            $property->mainPicture = $property->getPictures()[0];
        }

        if (empty($json['PropertyFeatures'])) {
            return $property;
        }

        // extract features
        foreach ($json['PropertyFeatures']['Category'] as $category) {
            $name = $category['Type'];
            $property->features[$name] = $category['Value'];
        }

        return $property;
    }
}
