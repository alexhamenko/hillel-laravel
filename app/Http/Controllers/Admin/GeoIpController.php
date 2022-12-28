<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\ParseVisitorInfo;
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
        ParseVisitorInfo::dispatch($ip, $reader, $parser)->onQueue('parsing');
    }
}
