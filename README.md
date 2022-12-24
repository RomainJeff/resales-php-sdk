# Resales PHP SDK

### API
#### API V6
```php
$apiClient = \Romainjeff\Resales\ClientFactory::v6($APIKey, $agentID, $apiID);

// Get Properties
$filters = new Filters();
$filters->withLanguage(Language::ENGLISH);
$apiClient->getProperties($filters);

// Get Property
$apiClient->getProperty($referenceID);
```
