<?php
namespace Romainjeff\Resales;

use Romainjeff\Resales\VO\ListPagination;
use Romainjeff\Resales\VO\ListProperty;
use Romainjeff\Resales\VO\Property;

class ClientV6 implements ResalesClient
{
    const SEARCH_PROPERTIES_ENDPOINT = 'SearchProperties';
    const PROPERTY_DETAILS_ENDPOINT = 'PropertyDetails';

    /** @var \GuzzleHttp\Client */
    private $client;

    /** @var string */
    private $apiKey;

    /** @var int */
    private $agentId;

    /** @var int */
    private $apiId;

    /**
     * @param \GuzzleHttp\Client $client
     * @param string             $apiKey
     * @param int                $agentId
     */
    public function __construct(\GuzzleHttp\Client $client, $apiKey, $agentId, $apiId)
    {
        $this->client  = $client;
        $this->apiKey  = $apiKey;
        $this->agentId = $agentId;
        $this->apiId   = $apiId;
    }

    /**
     * @param Filters $filters
     * @return ListProperty[]
     */
    public function getProperties(Filters $filters) {
        $query = [
            'p_agency_filterid' => $this->agentId,
            'p1'                => $this->apiKey,
            'p2'                => $this->apiId,
        ];

        $response = $this->client->get(self::SEARCH_PROPERTIES_ENDPOINT, [
            'query' => array_merge($query, $filters->getFilters())
        ]);
        $json = json_decode($response->getBody()->getContents(), true);

        // No result
        if (!isset($json['Property']) || empty($json['Property'])) {
            return [];
        }

        $responseProperties = $json['Property'];
        // if Property is not an array we make it so
        if (isset($json['Property']['Reference'])) {
            $responseProperties = [ $responseProperties ];
        }

        $properties = [];
        foreach ($responseProperties as $property) {
            $properties[] = ListProperty::createFromJSON($property);
        }

        return $properties;
    }

    public function getPaginationFromFilters(Filters $filters)
    {
        $query = [
            'p_agency_filterid' => $this->agentId,
            'p1'                => $this->apiKey,
            'p2'                => $this->apiId,
        ];

        $response = $this->client->get(self::SEARCH_PROPERTIES_ENDPOINT, [
            'query' => array_merge($query, $filters->getFilters())
        ]);
        $json = json_decode($response->getBody()->getContents(), true);

        // No result
        if (!isset($json['Property']) || empty($json['Property'])) {
            return null;
        }

        return new ListPagination(
            $json['QueryInfo']['PropertyCount'],
            $json['QueryInfo']['PropertiesPerPage']
        );
    }

    /**
     * @param $referenceID
     * @return Property
     */
    public function getProperty($referenceID) {
        $query = [
            'p_agency_filterid' => $this->agentId,
            'p1'                => $this->apiKey,
            'p2'                => $this->apiId,
        ];

        $response = $this->client->get(self::PROPERTY_DETAILS_ENDPOINT, [
            'query' => array_merge($query, [ 'P_RefId' => $referenceID ])
        ]);

        $json = json_decode($response->getBody()->getContents(), true);

        // No result
        if (!isset($json['Property']) || empty($json['Property'])) {
            return new Property();
        }

        return Property::createFromJSON($json['Property']);
    }
}
