<?php

namespace App\Jobs;

use App\Models\Visit;
use App\Services\Geo\GeoServiceInterface;
use Hillel\UserAgent\ParserInterface\UserAgentParserInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ParseVisitorInfo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $ip;
    public $reader;
    public $parser;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $ip, GeoServiceInterface $reader, UserAgentParserInterface $parser)
    {
        $this->ip = $ip;
        $this->reader = $reader;
        $this->parser = $parser;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $isoCode          = $this->reader->getIsoCode();
        $country          = $this->reader->getCountry();
        $browser          = $this->parser->getBrowser();
        $operating_system = $this->parser->getOS();

        Visit::create([
            'ip' => $this->ip,
            'country_code' => $country,
            'continent_code' => $isoCode,
            'browser' => $browser,
            'operating_system' => $operating_system,
        ]);
    }
}
