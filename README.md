# 🌳 Digital Humani - PHP SDK

[![Latest Stable Version](http://poser.pugx.org/rickkuilman/digital-humani-php-sdk/v)](https://packagist.org/packages/rickkuilman/digital-humani-php-sdk) [![Total Downloads](http://poser.pugx.org/rickkuilman/digital-humani-php-sdk/downloads)](https://packagist.org/packages/rickkuilman/digital-humani-php-sdk) [![Latest Unstable Version](http://poser.pugx.org/rickkuilman/digital-humani-php-sdk/v/unstable)](https://packagist.org/packages/rickkuilman/digital-humani-php-sdk) [![License](http://poser.pugx.org/rickkuilman/digital-humani-php-sdk/license)](https://packagist.org/packages/rickkuilman/digital-humani-php-sdk) [![PHP Version Require](http://poser.pugx.org/rickkuilman/digital-humani-php-sdk/require/php)](https://packagist.org/packages/rickkuilman/digital-humani-php-sdk)

Unofficial PHP SDK for DigitalHumani's RaaS (Reforestation-as-a-Service)

## Installation

You can install the package via composer:

```bash
composer require rickkuilman/digital-humani-php-sdk
```

## Preparation

- Create a [sandbox](https://my.sandbox.digitalhumani.com/register) or [production](https://my.digitalhumani.com/register) account on DigitalHumani.com.
- Grab your Enterprise ID and API Key from the "Developer" tab.

## Basic Usage

```php
// Create new instance
$digitalHumani = new DigitalHumani($apiKey);

// Plant a tree
$digitalHumani->plantTree($organisationId, 'rick@example.com');
```

Using the `DigitalHumani` instance you may perform multiple actions as well as retrieve the different resources [DigitalHumani's API](https://digitalhumani.com/docs/) provides:

### Managing Enterprises

```php
// Get Enterprise by ID
$enterprise = $digitalHumani->enterprise('4c6e672d')
    ->treeCount(); // ..and count trees for this enterprise

// Count trees for an enterprise for any range of date
$digitalHumani->treeCount('4c6e672d', Carbon::make('2021-01-01'), Carbon::make('2022-01-01'));

// Count trees for an enterprise by month
$digitalHumani->treeCountForMonth('4c6e672d', Carbon::make('2021-08'));
```

### Managing Projects

```php
// Get list of all Projects
$digitalHumani->projects();

// Get Project by ID
$digitalHumani->project('81818182')
        ->plantTree('4c6e672d', 'rick@example.com', 3); // ..and plant tree
```

### Managing Trees

```php
// Plant one or many trees
$digitalHumani->plantTree('4c6e672d', 'rick@example.com', 2);

// Get details of a single request to plant one or many trees
$digitalHumani->tree('9f05511e-56c6-40f7-b5ca-e25567991dc1');

// Count trees for a user
$digitalHumani->countTreesPlantedByUser('4c6e672d', 'rick@example.com');
```

### Switch to production environment

```php
// Set the second parameter to "true"
$digitalHumani = new DigitalHumani($apiKey, true);

// ..or use a method
$digitalHumani->useProductionEnvironment();
```

Happy planting! 🌳

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email rickkuilman@gmail.com instead of using the issue tracker.

## Credits

- [Rick Kuilman](https://github.com/rickkuilman)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## PHP Package Boilerplate

This package was generated using the [PHP Package Boilerplate](https://laravelpackageboilerplate.com) by [Beyond Code](http://beyondco.de/).
