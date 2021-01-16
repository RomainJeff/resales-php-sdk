<?php
namespace Romainjeff\Resales;


use Romainjeff\Resales\VO\ListProperty;
use Romainjeff\Resales\VO\Property;

class ClientV5
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
            'p1'    => $this->agentId,
            'p2'    => $this->apiKey,
            'apiId' => $this->apiId,
        ];

        $response = $this->client->get(self::SEARCH_PROPERTIES_ENDPOINT, [
            'query' => array_merge($query, $filters->getFilters())
        ]);

        $xml = simplexml_load_string((string) $response->getBody());

        // No result
        if (!isset($xml->Property)) {
            return [];
        }

        $properties = [];
        foreach ($xml->Property as $property) {
            $properties[] = ListProperty::createFromXML($property);
        }

        return $properties;
    }

    /**
     * @param $referenceID
     * @return Property
     */
    public function getProperty($referenceID) {
        $query = [
            'p1'    => $this->agentId,
            'p2'    => $this->apiKey,
            'apiId' => $this->apiId,
        ];

        $response = $this->client->get(self::PROPERTY_DETAILS_ENDPOINT, [
            'query' => array_merge($query, [ 'P_RefId' => $referenceID ])
        ]);

        $xml = simplexml_load_string((string) $response->getBody());

        // No result
        if (!isset($xml->Property)) {
            return new Property();
        }

        return Property::createFromXML($xml->Property);
    }
}
