<?php

namespace Asana\Test;

use Asana\Test\MockRequest;
use Httpful\Response;

class MockDispatcher extends \Asana\Dispatcher\Dispatcher
{
    public function __construct()
    {
        $this->responses = array();
        $this->calls = array();
    }
    protected function createRequest()
    {
        return new MockRequest($this);
    }
    public function registerResponse($path, $code, $body)
    {
        $this->responses[$path] = array($code, $body);
    }
    public function responseForRequest($request)
    {
        $res = $this->responses[$request->uri];
        $headers = "HTTP/1.1 " . $res[0] . " OK\r\nContent-Type: application/json\r\n\r\n";
        $body = $res[1];

        $response = new \Httpful\Response($body, $headers, $request);
        $this->calls[] = array('request' => $request, 'response' => $response);
        return $response;
    }
}
