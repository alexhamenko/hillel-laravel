<?php

namespace App\Services\UserAgent;

use WhichBrowser\Parser;

class WhichBrowserService implements UserAgentParserInterface
{
    /** @var Parser */
    protected $_data;

    public function __construct()
    {
        $this->_data = new Parser(request()->userAgent());
    }

    /**
     * @return string
     */
    public function getBrowser(): string
    {
        return $this->_data->browser->name;
    }

    /**
     * @return string
     */
    public function getOS(): string
    {
        return $this->_data->os->toString();
    }
}
