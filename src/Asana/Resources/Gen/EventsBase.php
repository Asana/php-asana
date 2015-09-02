<?php

namespace Asana\Resources\Gen;

class EventsBase
{
    public function __construct($client)
    {
        $this->client = $client;
    }
}