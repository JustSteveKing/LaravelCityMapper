<?php

declare(strict_types=1);

namespace JustSteveKing\LaravelCityMapper;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        try {
            $env = parse_ini_file(__DIR__ . '/../.env');
            if (isset($env['CITY_MAPPER_KEY'])) {
                $this->app['config']->set('services.citymapper.key', $env['CITY_MAPPER_KEY']);
            }
        } catch (\Exception $e) {
            //
        }

        if (!defined('LARAVEL_START')) {
            define('LARAVEL_START', microtime(true));
        }
    }

    protected function getPackageProviders($app)
    {
        return [
            \JustSteveKing\LaravelCityMapper\CityMapperServiceProvider::class
        ];
    }
}
