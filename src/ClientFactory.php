<?php
namespace Romainjeff\Resales;

class ClientFactory
{
    const BASE_URI_v6 = 'https://webapi.resales-online.com/V6/';

    /**
     * @param string $apiKey
     * @param int    $agentId
     * @param int    $apiId
     */
    public static function v6($apiKey, $agentId, $apiId): \Romainjeff\Resales\Client
    {
        return new \Romainjeff\Resales\Client(
            new \GuzzleHttp\Client([
                'base_uri' => self::BASE_URI_v6
            ]),
            $apiKey,
            $agentId,
            $apiId
        );
    }
}
