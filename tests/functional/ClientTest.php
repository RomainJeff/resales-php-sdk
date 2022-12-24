<?php
namespace Romainjeff\Tests\Resales\functional;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Romainjeff\Resales\Client;
use Romainjeff\Resales\Filters;
use Romainjeff\Resales\VO\ListPagination;
use Romainjeff\Resales\VO\ListProperty;
use Romainjeff\Resales\VO\Property;

class ClientTest extends TestCase
{
    const API_KEY = 'apiKey';
    const AGENT_ID = 1234;
    const API_ID = 5678;

    const FIXTURE_PAGINATION_SUCCESS = '/fixtures/SearchProperties.success.json';
    const FIXTURE_PROPERTY_SUCCESS = '/fixtures/Property.success.json';
    const FIXTURE_PROPERTY_UNKNOWN = '/fixtures/Property.empty.json';
    const FIXTURE_SEARCH_SUCCESS = '/fixtures/SearchProperties.success.json';
    const FIXTURE_SEARCH_FLAT_SUCCESS = '/fixtures/SearchProperties.success.flat.json';
    const FIXTURE_SEARCH_EMPTY = '/fixtures/SearchProperties.empty.json';
    const FIXTURE_SEARCH_NO_RESULT = '/fixtures/SearchProperties.no-result.json';

    /** @var \GuzzleHttp\Client|\PHPUnit\Framework\MockObject\MockObject */
    private $guzzleClient;

    /** @var Client */
    private $SUT;

    public function setUp(): void
    {
        $this->guzzleClient = $this->createMock(\GuzzleHttp\Client::class);

        $this->SUT = new Client(
            $this->guzzleClient,
            self::API_KEY,
            self::AGENT_ID,
            self::API_ID
        );
    }

    /**
     * @test
     */
    public function it_gets_pagination()
    {
        // arrange
        $filters = new Filters();
        $this->guzzleClient
            ->method('get')
            ->with(
                Client::SEARCH_PROPERTIES_ENDPOINT,
                [
                    'query' => [
                        'p_apiid'   => self::API_ID,
                        'p1'        => self::AGENT_ID,
                        'p2'        => self::API_KEY,
                    ]
                ]
            )
            ->willReturn(
                new Response(
                    200,
                    [],
                    file_get_contents(dirname(__DIR__) . self::FIXTURE_PAGINATION_SUCCESS)
                )
            );

        // act
        $pagination = $this->SUT->getPaginationFromFilters($filters);

        // assert
        $this->assertInstanceOf(ListPagination::class, $pagination);
        $this->assertEquals(1, $pagination->getTotalPages());
        $this->assertEquals(10, $pagination->getPropertiesPerPage());
        $this->assertEquals(2, $pagination->getTotalProperties());
    }

    /**
     * @test
     */
    public function it_gets_a_property()
    {
        // arrange
        $reference = 'R3479767';
        $this->guzzleClient
            ->method('get')
            ->with(
                Client::PROPERTY_DETAILS_ENDPOINT,
                [
                    'query' => [
                        'p_apiid'   => self::API_ID,
                        'p1'        => self::AGENT_ID,
                        'p2'        => self::API_KEY,
                        'P_RefId'   => $reference,
                    ]
                ]
            )
            ->willReturn(
                new Response(
                    200,
                    [],
                    file_get_contents(dirname(__DIR__) . self::FIXTURE_PROPERTY_SUCCESS)
                )
            );

        // act
        $property = $this->SUT->getProperty($reference);

        // assert
        $this->assertInstanceOf(Property::class, $property);
        $this->assertEquals($reference, $property->getReference());
    }

    /**
     * @test
     */
    public function it_returns_an_empty_property_when_property_is_unknown()
    {
        // arrange
        $reference = 'unknown';
        $this->guzzleClient
            ->method('get')
            ->with(
                Client::PROPERTY_DETAILS_ENDPOINT,
                [
                    'query' => [
                        'p_apiid'   => self::API_ID,
                        'p1'        => self::AGENT_ID,
                        'p2'        => self::API_KEY,
                        'P_RefId'   => $reference,
                    ]
                ]
            )
            ->willReturn(
                new Response(
                    200,
                    [],
                    file_get_contents(dirname(__DIR__) . self::FIXTURE_PROPERTY_UNKNOWN)
                )
            );

        // act
        $property = $this->SUT->getProperty($reference);

        // assert
        $this->assertInstanceOf(Property::class, $property);
        $this->assertNull($property->getReference());
    }

    /**
     * @test
     */
    public function it_searches_properties()
    {
        // arrange
        $filters = new Filters();
        $this->guzzleClient
            ->method('get')
            ->with(
                Client::SEARCH_PROPERTIES_ENDPOINT,
                [
                    'query' => [
                        'p_apiid'   => self::API_ID,
                        'p1'        => self::AGENT_ID,
                        'p2'        => self::API_KEY,
                    ]
                ]
            )
            ->willReturn(
                new Response(
                    200,
                    [],
                    file_get_contents(dirname(__DIR__) . self::FIXTURE_SEARCH_SUCCESS)
                )
            );

        // act
        $properties = $this->SUT->getProperties($filters);

        // assert
        $this->assertInstanceOf(ListProperty::class, $properties[0]);
        $this->assertCount(2, $properties);
    }

    /**
     * @test
     */
    public function it_searches_properties_with_flat_result()
    {
        // arrange
        $filters = new Filters();
        $this->guzzleClient
            ->method('get')
            ->with(
                Client::SEARCH_PROPERTIES_ENDPOINT,
                [
                    'query' => [
                        'p_apiid'   => self::API_ID,
                        'p1'        => self::AGENT_ID,
                        'p2'        => self::API_KEY,
                    ]
                ]
            )
            ->willReturn(
                new Response(
                    200,
                    [],
                    file_get_contents(dirname(__DIR__) . self::FIXTURE_SEARCH_FLAT_SUCCESS)
                )
            );

        // act
        $properties = $this->SUT->getProperties($filters);

        // assert
        $this->assertInstanceOf(ListProperty::class, $properties[0]);
        $this->assertCount(1, $properties);
    }

    /**
     * @test
     */
    public function it_returns_empty_list_when_no_result()
    {
        // arrange
        $filters = new Filters();
        $this->guzzleClient
            ->method('get')
            ->with(
                Client::SEARCH_PROPERTIES_ENDPOINT,
                [
                    'query' => [
                        'p_apiid'   => self::API_ID,
                        'p1'        => self::AGENT_ID,
                        'p2'        => self::API_KEY,
                    ]
                ]
            )
            ->willReturn(
                new Response(
                    200,
                    [],
                    file_get_contents(dirname(__DIR__) . self::FIXTURE_SEARCH_NO_RESULT)
                )
            );

        // act
        $properties = $this->SUT->getProperties($filters);

        // assert
        $this->assertEmpty($properties);
    }


    /**
     * @test
     */
    public function it_returns_empty_list_when_error()
    {
        // arrange
        $filters = new Filters();
        $this->guzzleClient
            ->method('get')
            ->with(
                Client::SEARCH_PROPERTIES_ENDPOINT,
                [
                    'query' => [
                        'p_apiid'   => self::API_ID,
                        'p1'        => self::AGENT_ID,
                        'p2'        => self::API_KEY,
                    ]
                ]
            )
            ->willReturn(
                new Response(
                    200,
                    [],
                    file_get_contents(dirname(__DIR__) . self::FIXTURE_SEARCH_EMPTY)
                )
            );

        // act
        $properties = $this->SUT->getProperties($filters);

        // assert
        $this->assertEmpty($properties);
    }
}
