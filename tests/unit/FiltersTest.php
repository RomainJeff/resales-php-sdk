<?php
namespace Romainjeff\Tests\Resales\unit;

use PHPUnit\Framework\TestCase;
use Romainjeff\Resales\Filters;

class FiltersTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_filter_with_lang()
    {
        // arrange
        $filtersBuilder = (new Filters())
            ->withLanguage(1);

        // act
        $filters = $filtersBuilder->getFilters();

        // assert
        $this->assertTrue(isset($filters['Lang']));
        $this->assertEquals(1, $filters['Lang']);
    }

    /**
     * @test
     */
    public function it_creates_filter_in_country()
    {
        // arrange
        $filtersBuilder = (new Filters())
            ->inCountry('Spain');

        // act
        $filters = $filtersBuilder->getFilters();

        // assert
        $this->assertTrue(isset($filters['p_Country']));
        $this->assertEquals('Spain', $filters['p_Country']);
    }

    /**
     * @test
     */
    public function it_creates_filter_in_area()
    {
        // arrange
        $filtersBuilder = (new Filters())
            ->inAreas(['Costa Del Sol', 'Area 2']);

        // act
        $filters = $filtersBuilder->getFilters();

        // assert
        $this->assertTrue(isset($filters['p_Area']));
        $this->assertEquals('Costa Del Sol,Area 2', $filters['p_Area']);
    }

    /**
     * @test
     */
    public function it_creates_filter_in_city()
    {
        // arrange
        $filtersBuilder = (new Filters())
            ->inCities(['Madrid', 'Fuengirola']);

        // act
        $filters = $filtersBuilder->getFilters();

        // assert
        $this->assertTrue(isset($filters['p_Location']));
        $this->assertEquals('Madrid,Fuengirola', $filters['p_Location']);
    }

    /**
     * @test
     */
    public function it_creates_filter_with_price_at_least()
    {
        // arrange
        $filtersBuilder = (new Filters())
            ->withPriceAtLeast(100000);

        // act
        $filters = $filtersBuilder->getFilters();

        // assert
        $this->assertTrue(isset($filters['p_Min']));
        $this->assertEquals(100000, $filters['p_Min']);
    }

    /**
     * @test
     */
    public function it_creates_filter_with_price_less_than()
    {
        // arrange
        $filtersBuilder = (new Filters())
            ->withPriceLessThan(100000);

        // act
        $filters = $filtersBuilder->getFilters();

        // assert
        $this->assertTrue(isset($filters['p_Max']));
        $this->assertEquals(100000, $filters['p_Max']);
    }

    /**
     * @test
     */
    public function it_creates_filter_with_bedrooms_at_least()
    {
        // arrange
        $filtersBuilder = (new Filters())
            ->withAtLeastBeds(2);

        // act
        $filters = $filtersBuilder->getFilters();

        // assert
        $this->assertTrue(isset($filters['p_Beds']));
        $this->assertEquals('2x', $filters['p_Beds']);
    }

    /**
     * @test
     */
    public function it_creates_filter_with_bathrooms_at_least()
    {
        // arrange
        $filtersBuilder = (new Filters())
            ->withAtLeastBaths(2);

        // act
        $filters = $filtersBuilder->getFilters();

        // assert
        $this->assertTrue(isset($filters['p_Baths']));
        $this->assertEquals('2x', $filters['p_Baths']);
    }

    /**
     * @test
     */
    public function it_creates_filter_with_property_type()
    {
        // arrange
        $filtersBuilder = (new Filters())
            ->withPropertyTypes([ '1-1', '1-2' ]);

        // act
        $filters = $filtersBuilder->getFilters();

        // assert
        $this->assertTrue(isset($filters['p_PropertyTypes']));
        $this->assertEquals('1-1,1-2', $filters['p_PropertyTypes']);
    }

    /**
     * @test
     */
    public function it_creates_filter_with_feature()
    {
        // arrange
        $filtersBuilder = (new Filters())
            ->withFeature('1Setting1');

        // act
        $filters = $filtersBuilder->getFilters();

        // assert
        $this->assertTrue(isset($filters['p_MustHaveFeatures']));
        $this->assertTrue(isset($filters['1Setting1']));
        $this->assertEquals(2, $filters['p_MustHaveFeatures']);
        $this->assertEquals(1, $filters['1Setting1']);
    }

    /**
     * @test
     */
    public function it_creates_filter_with_displayed_properties()
    {
        // arrange
        $filtersBuilder = (new Filters())
            ->displayedProperties(100);

        // act
        $filters = $filtersBuilder->getFilters();

        // assert
        $this->assertTrue(isset($filters['p_PageSize']));
        $this->assertEquals(100, $filters['p_PageSize']);
    }

    /**
     * @test
     */
    public function it_creates_filter_with_page_number()
    {
        // arrange
        $filtersBuilder = (new Filters())
            ->pageNumber(2);

        // act
        $filters = $filtersBuilder->getFilters();

        // assert
        $this->assertTrue(isset($filters['p_PageNo']));
        $this->assertEquals(2, $filters['p_PageNo']);
    }

    /**
     * @test
     */
    public function it_creates_filter_with_reference()
    {
        // arrange
        $filtersBuilder = (new Filters())
            ->withReferences([ 1234, 5678 ]);

        // act
        $filters = $filtersBuilder->getFilters();

        // assert
        $this->assertTrue(isset($filters['p_RefId']));
        $this->assertEquals('1234,5678', $filters['p_RefId']);
    }

    /**
     * @test
     */
    public function it_creates_filter_with_only_new_development()
    {
        // arrange
        $filtersBuilder = (new Filters())
            ->onlyNewDevelopment();

        // act
        $filters = $filtersBuilder->getFilters();

        // assert
        $this->assertTrue(isset($filters['p_New_Devs']));
        $this->assertEquals('only', $filters['p_New_Devs']);
    }

    /**
     * @test
     */
    public function it_creates_filter_without_new_development()
    {
        // arrange
        $filtersBuilder = (new Filters())
            ->excludeNewDevelopment();

        // act
        $filters = $filtersBuilder->getFilters();

        // assert
        $this->assertTrue(isset($filters['p_New_Devs']));
        $this->assertEquals('exclude', $filters['p_New_Devs']);
    }

    /**
     * @test
     */
    public function it_creates_filter_with_images_count()
    {
        // arrange
        $filtersBuilder = (new Filters())
            ->imagesCount(10);

        // act
        $filters = $filtersBuilder->getFilters();

        // assert
        $this->assertTrue(isset($filters['p_images']));
        $this->assertEquals(10, $filters['p_images']);
    }

    /**
     * @test
     */
    public function it_creates_filter_sort_newest()
    {
        // arrange
        $filtersBuilder = (new Filters())
            ->sortByNewest();

        // act
        $filters = $filtersBuilder->getFilters();

        // assert
        $this->assertTrue(isset($filters['p_SortType']));
        $this->assertEquals(5, $filters['p_SortType']);
    }

    /**
     * @test
     */
    public function it_creates_filter_sort_oldest()
    {
        // arrange
        $filtersBuilder = (new Filters())
            ->sortByOldest();

        // act
        $filters = $filtersBuilder->getFilters();

        // assert
        $this->assertTrue(isset($filters['p_SortType']));
        $this->assertEquals(6, $filters['p_SortType']);
    }
}
