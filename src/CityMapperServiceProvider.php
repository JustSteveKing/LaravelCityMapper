<?php

declare(strict_types=1);

namespace JustSteveKing\LaravelCityMapper;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use JustSteveKing\LaravelCityMapper\Service\CityMapperService;

class CityMapperServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/services.php',
            'services'
        );

        $this->app->bind(CityMapperService::class, function () {
            return new CityMapperService(
                new Client()
            );
        });

//        \Illuminate\Validation\Rule::macro('postcode', function () {
//            return new \JustSteveKing\LaravelPostcodes\Rules\Postcode(resolve(CityMapperService::class));
//        });
    }

    public function boot()
    {
        //
    }
}
