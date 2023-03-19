<?php

namespace Asana\Errors;

use Asana\Errors\RetryableAsanaError;

class RateLimitEnforcedError extends RetryableAsanaError
{
    const MESSAGE = 'Rate Limit Enforced';
    const STATUS = 429;

    public $retryAfter;

    public function __construct($response)
    {
        parent::__construct(self::MESSAGE, self::STATUS, $response);
        $this->retryAfter = isset($response->headers['Retry-After']) ? (float)$response->headers['Retry-After'] : null;
    }
}
