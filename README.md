# 🌳 Digital Humani - PHP SDK

[![Test status](https://github.com/rickkuilman/digital-humani-php-sdk/actions/workflows/main.yml/badge.svg)](https://github.com/rickkuilman/digital-humani-php-sdk/actions) [![Latest Stable Version](http://poser.pugx.org/rickkuilman/digital-humani-php-sdk/v)](https://packagist.org/packages/rickkuilman/digital-humani-php-sdk) [![Total Downloads](http://poser.pugx.org/rickkuilman/digital-humani-php-sdk/downloads)](https://packagist.org/packages/rickkuilman/digital-humani-php-sdk) [![Latest Unstable Version](http://poser.pugx.org/rickkuilman/digital-humani-php-sdk/v/unstable)](https://packagist.org/packages/rickkuilman/digital-humani-php-sdk) [![License](http://poser.pugx.org/rickkuilman/digital-humani-php-sdk/license)](https://packagist.org/packages/rickkuilman/digital-humani-php-sdk) [![PHP Version Require](http://poser.pugx.org/rickkuilman/digital-humani-php-sdk/require/php)](https://packagist.org/packages/rickkuilman/digital-humani-php-sdk)

Unofficial PHP SDK for DigitalHumani's RaaS (Reforestation-as-a-Service)

## Installation

You can install the package via composer:

```bash
composer require rickkuilman/digital-humani-php-sdk
```

## Preparation

- Create a [sandbox](https://my.sandbox.digitalhumani.com/register)
  or [production](https://my.digitalhumani.com/register) account on DigitalHumani.com.
- Grab your Enterprise ID and API Key from the "Developer" tab.

## Basic Usage

```php
// Create new sandbox instance
$digitalHumani = new DigitalHumani($apiKey, $enterpriseId);

// Plant a tree
$digitalHumani->plantTree('rick@example.com');

// Count trees planted
$digitalHumani->treeCount();
```

Using the `DigitalHumani` instance you may perform multiple actions as well as retrieve the different
resources [DigitalHumani's API](https://digitalhumani.com/docs/) provides:

### Managing Enterprises

```php
// Get current Enterprise
$enterprise = $digitalHumani->enterprise();

// .. or get Enterprise by ID
$enterprise = $digitalHumani->enterprise('4c6e672d'); 

// 🌳 Count planted trees 
$enterprise->treeCount(); 

// 🌳 Count planted trees since 2021-01-01
$enterprise->treeCount(Carbon::make('2021-01-01'));

// 🌳 Count planted trees between 2021-01-01 and 2021-08-01
$enterprise->treeCount(Carbon::make('2021-01-01'), Carbon::make('2022-08-01'));

// 🌳 Count planted trees for specific month
$enterprise->treeCountForMonth(Carbon::make('2021-08'));

// 🌳 Plant tree
$enterprise->plantTree('rick@example.com')
```

#### Notice for lines with 🌳 icon:

> Since the Enterprise ID is available in the DigitalHumani instance, you may replace `$enterprise`
> with `$digitalHumani` and expect the same results.

### Managing Projects

```php
// Get list of all Projects
$projects = $digitalHumani->projects();

// Get second project
$project = $projects[1];

// .. or get Project by ID
$project = $digitalHumani->project('81818182');

// Plant a tree for this project
$project->plantTree('rick@example.com', 3);
```

### Managing Trees

```php
// Plant one tree
$tree = $digitalHumani->plantTree('rick@example.com');

// Plant ten trees
$trees = $digitalHumani->plantTree('rick@example.com', 10);

// Get UUID of tree(s)
$uuid = $tree->uuid;

// Get details of a planted tree (or trees) by ID
$digitalHumani->tree('9f05511e-56c6-40f7-b5ca-e25567991dc1');

// Count trees for a user
$digitalHumani->countTreesPlantedByUser('rick@example.com');
```

### Switch to production environment

```php
// Set the third parameter to "true"
$digitalHumani = new DigitalHumani($apiKey, $enterpriseId, true);

// ..or use a method
$digitalHumani->useProductionEnvironment();
```

### Overrule (default) project or enterprise

Many methods allow additional parameters to overrule the (default) project or enterprise:

```php
// Create new sandbox instance, leaving out the enterpriseId
$digitalHumani = new DigitalHumani($apiKey);

// Plant a tree for a specific project and enterprise
$digitalHumani->plantTree('rick@example.com', 1, $projectId, $enterpriseId);

// Set a default enterprise afterwards, which will be used for all requests from now on
$digitalHumani->setEnterprise('11111111');

// Plant a tree for a specific project using the default enterprise from above
$digitalHumani->plantTree('rick@example.com', 1, $projectId);

// Count trees of a specific month for a specific enterprise, overruling the default
$digitalHumani->treeCountForMonth(Carbon::make('2021-10'), '99999999');
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

This package was generated using the [PHP Package Boilerplate](https://laravelpackageboilerplate.com)
by [Beyond Code](http://beyondco.de/).
