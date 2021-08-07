# 🌲 Digital Humani - PHP SDK 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rickkuilman/digital-humani-sdk.svg?style=flat-square)](https://packagist.org/packages/rickkuilman/digital-humani-sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/rickkuilman/digital-humani-sdk.svg?style=flat-square)](https://packagist.org/packages/rickkuilman/digital-humani-sdk)
![GitHub Actions](https://github.com/rickkuilman/digital-humani-sdk/actions/workflows/main.yml/badge.svg)

Unofficial PHP SDK for DigitalHumani's RaaS (Reforestation-as-a-Service)

## Installation

You can install the package via composer:

```bash
composer require rickkuilman/digital-humani-sdk
```

## Preparation

- Create an account on [DigitalHumani,com](https://my.digitalhumani.com/register) and grab your API key from the "
  Developer" menu item. You use the sandbox mode by default.

- Publish the config file and update `.env` file if needed.

```bash
php artisan vendor:publish --provider="Rickkuilman\DigitalHumaniSdk\DigitalHumaniServiceProvider" --tag=config
```

## Basic Usage

```php
$digitalHumani = new DigitalHumani(API_TOKEN);
```

Using the `DigitalHumani` instance you may perform multiple actions as well as retrieve the different
resources [DigitalHumani's API](https://digitalhumani.com/docs/) provides:

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

Happy planting! 🌳🌳🌳

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

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com). ❤️
