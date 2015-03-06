<?php

namespace Asana;

use Asana\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testPushAndPop()
    {
        $client = new Client();

        $this->assertEquals(0, 0);
    }
}
