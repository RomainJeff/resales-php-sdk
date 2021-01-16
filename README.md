# Resales PHP SDK

### API
#### API V4
Base URL: `http://webkit.resales-online.com/weblink/xml/V4-2/`
```php
$guzzleClient = new \GuzzleHttp\Client();
$apiClient = new Client($guzzleClient, $APIKey, $agentID);

// Get Properties
$filters = new Filters();
$filters->withLanguage(Language::ENGLISH);
$apiClient->getProperties($filters);

// Get Property
$apiClient->getProperty($referenceID);
```

#### API V5
Base URL: `https://webapi.resales-online.com/V5/`
```php
$guzzleClient = new \GuzzleHttp\Client();
$apiClient = new ClientV5($guzzleClient, $APIKey, $agentID, $apiID);

// Get Properties
$filters = new Filters();
$filters->withLanguage(Language::ENGLISH);
$apiClient->getProperties($filters);

// Get Property
$apiClient->getProperty($referenceID);
```