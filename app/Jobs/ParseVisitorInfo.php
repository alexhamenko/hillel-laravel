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
    public $user_agent;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $ip, string $user_agent)
    {
        $this->ip = $ip;
        $this->user_agent = $user_agent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(GeoServiceInterface $reader, UserAgentParserInterface $parser)
    {
        $reader->parse($this->ip);
        $parser->parse($this->user_agent);

        $isoCode          = $reader->getIsoCode();
        $country          = $reader->getCountry();
        $browser          = $parser->getBrowser();
        $operating_system = $parser->getOS();

        Visit::create([
            'ip' => $this->ip,
            'country_code' => $country,
            'continent_code' => $isoCode,
            'browser' => $browser,
            'operating_system' => $operating_system,
        ]);
    }
}
