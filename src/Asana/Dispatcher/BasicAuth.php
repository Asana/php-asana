<?php

namespace Asana\Dispatcher;

class BasicAuth extends Dispatcher
{
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }
    protected function authenticate($request)
    {
        return $request->authenticateWith($this->apiKey, '');
    }
}
