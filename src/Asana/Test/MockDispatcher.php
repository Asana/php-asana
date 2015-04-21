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
    public function registerResponse($path, $status, $headers = null, $body = null)
    {
        $this->responses[$path] = array($status, $headers, $body);
    }
    public function responseForRequest($request)
    {
        $res = $this->responses[$request->uri];
        if (is_array($res[0])) {
            $res = array_shift($res[0]);
        }
        if (is_callable($res[0])) {
            $res = $res[0]();
        }

        $status = $res[0];
        $headers = $res[1];
        $body = $res[2];

        $head = "HTTP/1.1 {$status} OK\r\n";
        if ($headers) {
            foreach ($headers as $key => $value) {
                $head .= "{$key}: {$value}\r\n";
            }
        }
        $head .= "Content-Type: application/json\r\n\r\n";

        $response = new \Httpful\Response($body, $head, $request);
        $this->calls[] = array('request' => $request, 'response' => $response);
        return $response;
    }
}
