<?php

namespace Asana\Errors;

use Asana\Error;

class NotFoundError extends Error
{
    const MESSAGE = 'Not Found';
    const STATUS = 404;
}
