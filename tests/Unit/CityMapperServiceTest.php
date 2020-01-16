<?php

declare(strict_types=1);

namespace JustSteveKing\LaravelCityMapper\Unit;

use GuzzleHttp\Client;
use JustSteveKing\LaravelCityMapper\TestCase;
use JustSteveKing\LaravelCityMapper\Service\CityMapperService;

class CityMapperServiceTest extends TestCase
{
    protected function setUp() : void
    {
        parent::setUp();

        $this->service = new CityMapperService(
            new Client()
        );
    }

    /**
     * @var CityMapperService
     */
    protected $service;

    /**
     * @var array
     */
    protected $startCoordinates = [
        51.525246,
        0.084672
    ];

    /**
     * @var array
     */
    protected $endCoordinates = [
        51.559098,
        0.074503
    ];

    public function testServiceIsCorrectType()
    {
        $this->assertInstanceOf(CityMapperService::class, $this->service);
    }

    public function testServiceCanReturnTransitTime()
    {
        $this->assertEquals(
            42,
            $this->service->getTransitTime(
                $this->startCoordinates,
                $this->endCoordinates
            )->travel_time_minutes);
    }

    private function baseURL(): string
    {
        return "https://developer.citymapper.com/api/1/";
    }
}
