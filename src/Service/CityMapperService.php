<?php

declare(strict_types=1);

namespace JustSteveKing\LaravelCityMapper\Service;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use function GuzzleHttp\Psr7\build_query;

class CityMapperService
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var Client
     */
    protected $http;

    /**
     * Postcode Service constructor.
     *
     * @param Client $client
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->url = config('services.citymapper.url');

        $this->key = config('services.citymapper.key');

        $this->http = $client;
    }

    /**
     * Get the transit time between two locations
     *
     * @param string $postcode
     *
     * @return object
     */
    public function getTransitTime(array $startCoordinates, array $endCoordinates): object
    {
        $queryString = http_build_query([
            'startcoord' => implode(',', $startCoordinates),
            'endcoord' => implode(',', $endCoordinates)
        ]);

        return $this->getResponse("traveltime/?$queryString");
    }

    /**
     * Get the response and return the result object
     *
     * @param string|null $uri
     * @param string $method
     * @param array $data - data to be sent in post/patch/put request
     * @param array $options - array of options to be passed to curl, if $data is passed 'json' will be overwritten
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function getResponse(
        string $uri = null,
        string $method = 'GET',
        array $data = [],
        array $options = []
    ) {
        $url = $this->url . $uri;

        if (!empty($data)) {
            $options['json'] = $data;
        }

        $request = $this->http->request(
            $method,
            $url . "&key=$this->key",
            $options
        );

        return json_decode($request->getBody()->getContents());
    }
}
