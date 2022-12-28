<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use App\Services\Geo\GeoServiceInterface;
use Hillel\UserAgent\ParserInterface\UserAgentParserInterface;

class GeoIpController extends Controller
{
    public function __invoke(GeoServiceInterface $reader, UserAgentParserInterface $parser)
    {
        $ip = request()->ip();
        if ($ip === '127.0.0.1') {
            $ip = request()->server->get('HTTP_X_FORWARDED_FOR');
        };

        $reader->parse($ip);

        $isoCode          = $reader->getIsoCode();
        $country          = $reader->getCountry();
        $browser          = $parser->getBrowser();
        $operating_system = $parser->getOS();

        if (!empty($isoCode) || !empty($country)) {
            Visit::create([
                'ip' => $ip,
                'country_code' => $country,
                'continent_code' => $isoCode,
                'browser' => $browser,
                'operating_system' => $operating_system,
            ]);
        }
    }
}
