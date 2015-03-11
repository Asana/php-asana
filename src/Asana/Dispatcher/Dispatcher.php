<?php

namespace Asana\Dispatcher;

use \Httpful;

class Dispatcher
{
    public $base = 'https://app.asana.com/api/1.0';

    public function request($method, $path, $requestOptions)
    {
        $uri = $this->base . $path;
        if (isset($requestOptions['params'])) {
            $qs = http_build_query($requestOptions['params']);
            if (strlen($qs) > 0) {
                $uri .= "?" . $qs;
            }
        }

        $request = $this->createRequest()
            ->method($method)
            ->uri($uri)
            ->expectsJson();

        if (isset($requestOptions['headers'])) {
            $request->addHeaders($requestOptions['headers']);
        }

        if (isset($requestOptions['data'])) {
            $request->sendsJson()->body($requestOptions['data']);
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
