# Laravel City Mapper

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A service wrapper around [City Mapper](https://citymapper.com/)

## Install

Via Composer

```bash
$ composer require juststeveking/laravel-city-mapper
```

After installation, merge configuration for services uusing:

```bash
$ php artisan vendor:publish --provider="JustSteveKing\LaravelCityMapper\CityMapperServiceProvider"
```

If, for some reason, this doesn't work please use the following steps:

- Add the following into the `config/services.php` configuration file:

```php
<?php

'citymapper' => [
    'key' => env('CITY_MAPPER_KEY', '')
]
```

- Add `CITY_MAPPER_KEY` to your `.env` file and add your API key which you can get from [here](https://citymapper.3scale.net/).


## Basic Usage

If you want to interact with the service itself

```php
<?php 

class SomeController extends Controller
{
    protected $cityMapper;

    public function __construct(CityMapperService $service)
    {
        $this->cityMapper = $service;
    }

    public function index(Request $request)
    {
        // get the travel time between two points
        $startCoordinates = [
            51.525246, // latitude
            0.084672 // longitude
        ];
        
        $endCoordinates = [
            51.559098, // latitude
            0.074503 // longitude
        ];
    
        $travelTime = $this->cityMapper->getTransitTime(
            $startCoordinates,
            $endCoordinates
        );
    }
}
```

This will return the following `stdClass` object:

```bash
.{#330
  +"travel_time_minutes": 43
}
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email juststevemcd@gmail.com instead of using the issue tracker.

## Credits

- [Steve McDougall][link-author]
- [All Contributors][link-contributors]
- [Laravel News for the artiwork](https://www.laravel-news.com)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/juststeveking/laravel-city-mapper.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/JustSteveKing/LaravelCityMapper/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/JustSteveKing/LaravelCityMapper.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/JustSteveKing/LaravelCityMapper.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/juststeveking/laravel-city-mapper.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/juststeveking/laravel-city-mapper
[link-travis]: https://travis-ci.org/JustSteveKing/LaravelCityMapper
[link-scrutinizer]: https://scrutinizer-ci.com/g/JustSteveKing/LaravelCityMapper/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/JustSteveKing/LaravelCityMapper
[link-downloads]: https://packagist.org/packages/juststeveking/laravel-city-mapper
[link-author]: https://github.com/JustSteveKing
[link-contributors]: ../../contributors
