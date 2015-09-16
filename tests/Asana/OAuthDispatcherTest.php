<?php

namespace Asana;

use Asana\Test\AsanaTest;
use Asana\Test\MockRequest;

use Asana\Dispatcher\OAuthDispatcher;

// Extend dispatcher to expose protected methods for testing.
class FakeOauthDispatcher extends OAuthDispatcher {
  public function authenticate($request) {
    return parent::authenticate($request);
  }
};

class OAuthDispatcherTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->dispatcher = new FakeOAuthDispatcher(array(
            'client_id' => 'fake_client_id'));
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessageRegExp #access token not set#
     */
    public function testAuthenticateNoToken()
    {
        $request = new MockRequest($this->dispatcher);
        $this->dispatcher->authenticate($request);
    }

    public function testAuthenticateUsesToken()
    {
        $this->dispatcher->accessToken = 'fake_token';
        $request = new MockRequest($this->dispatcher);
        $this->dispatcher->authenticate($request);
        $this->assertEquals(
            $request->headers, array('Authorization' => 'Bearer fake_token'));
    }
}
