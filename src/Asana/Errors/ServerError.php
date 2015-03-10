<?php

namespace Asana\Errors;

use Asana\Error;

class ServerError extends Error
{
    const MESSAGE = 'Server Error';
    const STATUS = 500;
}
