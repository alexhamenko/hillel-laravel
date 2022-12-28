<?php

namespace App\Services\UserAgent;

use donatj\UserAgent\UserAgent;
use donatj\UserAgent\UserAgentParser;

class DonatjService implements UserAgentParserInterface
{
    /** @var UserAgent */
    protected $_data;

    public function __construct()
    {
        $this->setData();
    }

    /**
     * @return void
     */
    public function setData(): void
    {
        $parser = new UserAgentParser();
        $this->_data = $parser->parse();
    }

    /**
     * @return string
     */
    public function getBrowser(): string
    {
        return $this->_data->browser();
    }

    /**
     * @return string
     */
    public function getOS(): string
    {
        return $this->_data->platform();
    }

}
