# Resales PHP SDK

### API
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