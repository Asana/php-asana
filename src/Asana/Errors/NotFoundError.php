<?php

namespace Asana\Errors;

use Asana\Errors\AsanaError;

class NotFoundError extends AsanaError
{
    const MESSAGE = 'Not Found';
    const STATUS = 404;

    public function __construct($response)
    {
        parent::__construct(self::MESSAGE, self::STATUS, $response);
    }
}
