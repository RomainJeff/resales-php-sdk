# Resales PHP SDK

### API
#### API V4
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