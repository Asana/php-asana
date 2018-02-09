<?php

namespace Asana\Errors;

use Asana\Errors\AsanaError;

class PremiumOnlyError extends AsanaError
{
    const MESSAGE = 'Payment Required';
    const STATUS = 402;

    public function __construct($response)
    {
        parent::__construct(self::MESSAGE, self::STATUS, $response);
    }
}
