<?php

namespace Asana\Errors;

use Asana\Error;

class NoAuthorizationError extends Error
{
    const MESSAGE = 'No Authorization';
    const STATUS = 401;
}
