<?php

namespace App\Services\Geo;

use GeoIp2\Database\Reader;
use GeoIp2\Model\Country;
use Illuminate\Support\Facades\Http;

class IpApiGeoService implements GeoServiceInterface
{
    /** @var array */
    protected $_data;

    /**
     * @param string $ip
     * @return void
     */
    public function parse(string $ip): void
    {
        $response = Http::get($this->getUrl($ip));
        $this->_data = $response->json();
    }

    /**
     * @return string|null
     */
    public function getIsoCode(): ?string
    {
        return $this->_data['continentCode'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->_data['countryCode'] ?? null;
    }

    /**
     * @param string $ip
     * @return string
     */
    protected function getUrl(string $ip): string
    {
        $url = 'http://ip-api.com/json/' . $ip;
        $parameters = http_build_query([
            'fields' => 'continentCode,countryCode,query'
        ]);

        return $url . '?' . $parameters;
    }
}
