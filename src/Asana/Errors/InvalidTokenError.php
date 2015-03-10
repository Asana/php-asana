<?php

namespace Asana\Errors;

use Asana\Error;

class InvalidTokenError extends Error
{
    const MESSAGE = 'Sync token invalid or too old';
    const STATUS = 412;
}
