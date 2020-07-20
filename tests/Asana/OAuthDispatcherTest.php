<?php

namespace Asana;

use Asana\Test\AsanaTest;
use Asana\Test\MockRequest;

use Asana\Dispatcher\OAuthDispatcher;

// Extend dispatcher to expose protected methods for testing.
class FakeOauthDispatcher extends OAuthDispatcher
{
    public function authenticate($request)
    {
        return parent::authenticate($request);
    }
}

class OAuthDispatcherTest extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        $this->dispatcher = new FakeOAuthDispatcher(
            array(
                'client_id' => 'fake_client_id'
            )
        );
    }

    public function testAuthenticateNoToken()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('access token not set');

        $request = new MockRequest($this->dispatcher);
        $this->dispatcher->authenticate($request);
    }

    public function testAuthenticateUsesToken()
    {
        $this->dispatcher->accessToken = 'fake_token';
        $request = new MockRequest($this->dispatcher);
        $this->dispatcher->authenticate($request);
        $this->assertEquals(
            $request->headers,
            array('Authorization' => 'Bearer fake_token')
        );
    }
}
