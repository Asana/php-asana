<?php

namespace Asana;

use Asana\Test\AsanaTest;
use Asana\Test\MockRequest;

use Asana\Dispatcher\OauthDispatcher;

// Extend dispatcher to expose protected methods for testing.
class FakeOauthDispatcher extends \Asana\Dispatcher\OauthDispatcher {
  public function authenticate($request) {
    return parent::authenticate($request);
  }
};

class OauthDispatcherTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->dispatcher = new FakeOauthDispatcher(array());
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
