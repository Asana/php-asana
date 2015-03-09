<?php

namespace Asana\Dispatcher;

use \Httpful;

class Dispatcher
{
    public $base = 'https://app.asana.com/api/1.0';

    public function get($path)
    {
        $uri = $this->base . $path;

        $request = $this->createRequest()
            ->method("GET")
            ->uri($uri)
            ->expectsJson();

        $this->authenticate($request);

        $response = $request->send();

        $body = $response->body;

        return $body->data;
    }

    protected function createRequest()
    {
        return \Httpful\Request::init();
    }

    protected function authenticate($request)
    {
        return $request;
    }
}
