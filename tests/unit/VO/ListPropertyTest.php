<?php
namespace Romainjeff\Tests\Resales\unit\VO;

use PHPUnit\Framework\TestCase;
use Romainjeff\Resales\VO\ListProperty;

class ListPropertyTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_property_from_json()
    {
        // arrange
        $propertyJson = json_decode(
            file_get_contents(dirname(dirname(__DIR__)) .'/fixtures/SearchProperties.success.json'),
            true
        );

        // act
        $property = ListProperty::createFromJSON($propertyJson['Property'][1]);

        // assert
        $this->assertEquals('R3479779', $property->getReference());
        $this->assertEquals('1114/3232', $property->getAgencyReference());
        $this->assertEquals('Spain', $property->getCountry());
        $this->assertEquals('Costa del Sol', $property->getArea());
        $this->assertEquals('Torremolinos', $property->getLocation());
        $this->assertEquals('Apartment', $property->getType());
        $this->assertEquals('Middle Floor Apartment', $property->getSubType());
        $this->assertEquals(2, $property->getBedrooms());
        $this->assertEquals(1, $property->getBathrooms());
        $this->assertEquals('EUR', $property->getCurrency());
        $this->assertEquals(127000, $property->getOriginalPrice());
        $this->assertEquals(127000, $property->getPrice());
        $this->assertEquals(80, $property->getSurface());
        $this->assertEquals(0, $property->getTerraceSurface());
        $this->assertEquals(0, $property->getPlotSurface());
        $this->assertEquals(true, $property->hasPool());
        $this->assertEquals(true, $property->hasGarden());
        $this->assertEquals(false, $property->hasParking());
        $this->assertEquals('https://media-webapi.resales-online.com/live/ShowImageXML.asp?SecId=mgfynnlkzpvnbkt&Id=P1&ImgId=W1023133&z=1565604842', $property->getMainPicture());
        $this->assertEquals([
            'https://media-webapi.resales-online.com/live/ShowImageXML.asp?SecId=mgfynnlkzpvnbkt&Id=P1&ImgId=W1023133&z=1565604842'
        ], $property->getPictures());
        $this->assertEquals([
            "Pool"      => [ "Communal" ],
            "Garden"    => [ "Communal" ],
            "Utilities" => [ "Electricity", "Drinkable Water" ],
        ], $property->getFeatures());
        $this->assertEquals("This is a test property and not real.\nENGLISH DESCRIPTION IS HERE.\nThis is a test property and not real.\nENGLISH DESCRIPTION IS HERE.\nThis is a test property and not real.\nENGLISH DESCRIPTION IS HERE.\nThis is a test property and not real.\nENGLISH DESCRIPTION IS HERE.", $property->getDescription());
        $this->assertEquals('https://www-3.resales-online.com/live/ReSales/Search/PropertyDetail.asp?P1=3479779', $property->getResalesLink());
    }
}
