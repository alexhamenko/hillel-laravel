<?php

namespace App\Services\UserAgent;

interface UserAgentParserInterface
{
    public function getBrowser(): string;
    public function getOS(): string;
}
