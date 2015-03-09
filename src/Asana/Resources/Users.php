<?php

namespace Asana\Resources;

use Asana\Resources\Resource;

class Users extends Resource
{
    public function me()
    {
        return $this->dispatcher->get('/users/me');
    }
}
