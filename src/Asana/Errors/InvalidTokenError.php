<?php

namespace Asana\Errors;

use Asana\Errors\AsanaError;

class InvalidTokenError extends AsanaError
{
    const MESSAGE = 'Sync token invalid or too old';
    const STATUS = 412;

    public function __construct($response)
    {
        parent::__construct(self::MESSAGE, self::STATUS, $response);
        $this->sync = $response != null ? $response->body->sync : null;
    }
}
