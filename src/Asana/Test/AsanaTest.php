<?php

namespace Asana\Test;

use Asana\Client;
use Asana\Test\MockDispatcher;

class AsanaTest extends \PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp()
    {
        $this->dispatcher = new MockDispatcher();
        $this->dispatcher->base = '';
        $this->client = new Client($this->dispatcher);
    }
}
