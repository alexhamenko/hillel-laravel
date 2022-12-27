<?php

namespace App\Services\Geo;

use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use GeoIp2\Model\Country;
use Illuminate\Support\Facades\Log;

class MaxmindService implements GeoServiceInterface
{
    /** @var Reader */
    private $_reader;
    /** @var Country */
    private $_data;

    public function __construct()
    {
        $this->_reader = new Reader(
            base_path() . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'geoip' . DIRECTORY_SEPARATOR . 'GeoLite2-Country.mmdb'
        );
    }

    /**
     * @param string $ip
     * @return void
     * @throws \MaxMind\Db\Reader\InvalidDatabaseException
     */
    public function parse(string $ip): void
    {
        try {
            $this->_data = $this->_reader->country($ip);
        } catch (AddressNotFoundException $exception) {
            Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/custom.log'),
            ])->info($exception->getMessage());
        }
    }

    /**
     * @return string|null
     */
    public function getIsoCode(): ?string
    {
        return $this->_data->continent->code ?? null;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->_data->country->isoCode ?? null;
    }

}
