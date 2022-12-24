<?php
namespace Romainjeff\Tests\Resales\unit\VO;

use PHPUnit\Framework\TestCase;
use Romainjeff\Resales\VO\Property;

class PropertyTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_property_from_json()
    {
        // arrange
        $propertyJson = json_decode(
            file_get_contents(dirname(dirname(__DIR__)) .'/fixtures/Property.success.json'),
        true
        );

        // act
        $property = Property::createFromJSON($propertyJson['Property']);

        // assert
        $this->assertEquals('R3479767', $property->getReference());
        $this->assertEquals('10031/3232', $property->getAgencyReference());
        $this->assertEquals('Spain', $property->getCountry());
        $this->assertEquals('Costa del Sol East', $property->getArea());
        $this->assertEquals('Moclinejo', $property->getLocation());
        $this->assertEquals('House', $property->getType());
        $this->assertEquals('Adosada', $property->getSubType());
        $this->assertEquals(4, $property->getBedrooms());
        $this->assertEquals(3, $property->getBathrooms());
        $this->assertEquals('EUR', $property->getCurrency());
        $this->assertEquals(179000, $property->getOriginalPrice());
        $this->assertEquals(179000, $property->getPrice());
        $this->assertEquals(147, $property->getSurface());
        $this->assertEquals(0, $property->getTerraceSurface());
        $this->assertEquals(205, $property->getPlotSurface());
        $this->assertEquals(true, $property->hasPool());
        $this->assertEquals(true, $property->hasGarden());
        $this->assertEquals(false, $property->hasParking());
        $this->assertEquals([
            "https://media-webapi.resales-online.com/live/ShowImageXML.asp?SecId=hxeisxpgsvainlo&Id=P1&ImgId=W1023133&z=1565604842",
            "https://media-webapi.resales-online.com/live/ShowImageXML.asp?SecId=hxeisxpgsvainlo&Id=P2&ImgId=W1023133&z=1565604842",
            "https://media-webapi.resales-online.com/live/ShowImageXML.asp?SecId=hxeisxpgsvainlo&Id=P3&ImgId=W1023133&z=1565604842",
            "https://media-webapi.resales-online.com/live/ShowImageXML.asp?SecId=hxeisxpgsvainlo&Id=P4&ImgId=W1023133&z=1565604842",
            "https://media-webapi.resales-online.com/live/ShowImageXML.asp?SecId=hxeisxpgsvainlo&Id=P5&ImgId=W1023133&z=1565604842",
            "https://media-webapi.resales-online.com/live/ShowImageXML.asp?SecId=hxeisxpgsvainlo&Id=P6&ImgId=W1023133&z=1565604842",
            "https://media-webapi.resales-online.com/live/ShowImageXML.asp?SecId=hxeisxpgsvainlo&Id=P7&ImgId=W1023133&z=1565604842",
            "https://media-webapi.resales-online.com/live/ShowImageXML.asp?SecId=hxeisxpgsvainlo&Id=P8&ImgId=W1023133&z=1565604842",
            "https://media-webapi.resales-online.com/live/ShowImageXML.asp?SecId=hxeisxpgsvainlo&Id=P9&ImgId=W1023133&z=1565604842",
            "https://media-webapi.resales-online.com/live/ShowImageXML.asp?SecId=hxeisxpgsvainlo&Id=P10&ImgId=W1023133&z=1565604842",
            "https://media-webapi.resales-online.com/live/ShowImageXML.asp?SecId=hxeisxpgsvainlo&Id=P11&ImgId=W1023133&z=1565604842",
            "https://media-webapi.resales-online.com/live/ShowImageXML.asp?SecId=hxeisxpgsvainlo&Id=P12&ImgId=W1023133&z=1565604842",
            "https://media-webapi.resales-online.com/live/ShowImageXML.asp?SecId=hxeisxpgsvainlo&Id=P13&ImgId=W1023133&z=1565604842",
        ], $property->getPictures());
        $this->assertEquals([
            "Piscina" => [
                "Privada"
            ],
            "Caracteristicas" => [
                "Terraza Privada"
            ],
            "Jardin" => [
                "Comunitario"
            ],
            "Servicios Públicos" => [
                "Electricidad",
                "Agua Potable",
            ],
        ], $property->getFeatures());
        $this->assertEquals("This is a test property and not real.\nSPANISH DESCRIPTION IS HERE.\nThis is a test property and not real.\nSPANISH DESCRIPTION IS HERE.\nThis is a test property and not real.\nSPANISH DESCRIPTION IS HERE.\nThis is a test property and not real.\nSPANISH DESCRIPTION IS HERE.", $property->getDescription());
        $this->assertEquals('https://www-3.resales-online.com/live/ReSales/Search/PropertyDetail.asp?P1=3479767', $property->getResalesLink());
    }
}
