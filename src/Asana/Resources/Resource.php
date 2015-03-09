<?php

namespace Asana\Resources;

class Resource
{
    public function __construct($dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }
}
