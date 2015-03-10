<?php

namespace Asana\Errors;

use Asana\Error;

class ForbiddenError extends Error
{
    const MESSAGE = 'Forbidden';
    const STATUS = 403;
}
