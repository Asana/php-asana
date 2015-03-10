<?php

namespace Asana\Errors;

use Asana\Error;

class RateLimitEnforcedError extends Error
{
    const MESSAGE = 'Rate Limit Enforced';
    const STATUS = 429;
}
