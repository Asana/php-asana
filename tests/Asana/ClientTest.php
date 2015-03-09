<?php

namespace Asana;

use Asana\Test\AsanaTest;

class ClientTest extends Test\AsanaTest
{
    public function testClientGet()
    {
        $this->dispatcher->registerResponse('/users/me', 200, '{ "data": { "name": "test" }}');
        $result = $this->client->users->me();
        $this->assertEquals($result->name, "test");
    }
}
