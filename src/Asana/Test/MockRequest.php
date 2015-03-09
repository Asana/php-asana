<?php

namespace Asana\Test;

use Httpful;
use Httpful\Request;
use Httpful\Response;

class MockRequest extends \Httpful\Request
{
    public function __construct($dispatcher)
    {
        \Httpful\Bootstrap::init();
        $this->dispatcher = $dispatcher;
    }
    public function send()
    {
        return $this->dispatcher->responseForRequest($this);
    }
}
