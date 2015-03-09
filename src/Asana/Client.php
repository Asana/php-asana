<?php

namespace Asana;

use Asana\Dispatcher\BaiscAuth;
use Asana\Resources\Users;

class Client
{
    public function __construct($dispatcher)
    {
        $this->dispatcher = $dispatcher;
        $this->users = new Resources\Users($dispatcher);
    }

    public static function basicAuth($apiKey)
    {
        return new Client(new Dispatcher\BasicAuth($apiKey));
    }
}
