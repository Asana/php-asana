<?php

namespace Asana\Errors;

use Asana\Error;

class InvalidRequestError extends Error
{
    const MESSAGE = 'Invalid Request';
    const STATUS = 400;
}
