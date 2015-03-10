<?php

namespace Asana\Dispatcher;

use \Httpful;

class Dispatcher
{
    public $base = 'https://app.asana.com/api/1.0';

    public function request($method, $path, $headers = null, $query = null, $body = null)
    {
        $uri = $this->base . $path;
        if ($query != null) {
            $uri .= "?" . http_build_query($query);
        }

        $request = $this->createRequest()
            ->method($method)
            ->uri($uri)
            ->expectsJson();

        if ($headers != null) {
            $request->addHeaders($headers);
        }

        if ($body != null) {
            $request->sendsJson()->body(json_encode($body));
        }

        $this->authenticate($request);

        return $request->send();
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
