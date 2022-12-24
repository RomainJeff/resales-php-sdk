<?php
namespace Romainjeff\Tests\Resales\unit;

use PHPUnit\Framework\TestCase;
use Romainjeff\Resales\ClientFactory;
use Romainjeff\Resales\ResalesClient;

class ClientFactoryTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_a_client_instance_for_v6()
    {
        // arrange
        $expectedURI = ClientFactory::BASE_URI_v6;
        $expectedAPIKey = 'apiKey';
        $expectedAgentId = 1234;
        $expectedAPIId = 5678;

        // act
        $client = ClientFactory::v6($expectedAPIKey, $expectedAgentId, $expectedAPIId);

        // assert
        $reflection = new \ReflectionClass($client);
        $propertyApiKey = $reflection->getProperty('apiKey');
        $propertyApiKey->setAccessible(true);
        $propertyAgentId = $reflection->getProperty('agentId');
        $propertyAgentId->setAccessible(true);
        $propertyApiId = $reflection->getProperty('apiId');
        $propertyApiId->setAccessible(true);
        $propertyClient = $reflection->getProperty('client');
        $propertyClient->setAccessible(true);
        $clientConfig = $propertyClient->getValue($client)->getConfig();

        $this->assertInstanceOf(ResalesClient::class, $client);
        $this->assertEquals($expectedAPIKey, $propertyApiKey->getValue($client));
        $this->assertEquals($expectedAgentId, $propertyAgentId->getValue($client));
        $this->assertEquals($expectedAPIId, $propertyApiId->getValue($client));
        $this->assertEquals($expectedURI, (string) $clientConfig['base_uri']);
    }
}
