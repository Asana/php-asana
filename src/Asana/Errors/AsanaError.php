<?php

namespace Asana\Errors;

use Asana\Errors\ForbiddenError;
use Asana\Errors\InvalidRequestError;
use Asana\Errors\InvalidTokenError;
use Asana\Errors\NoAuthorizationError;
use Asana\Errors\NotFoundError;
use Asana\Errors\RateLimitEnforcedError;
use Asana\Errors\ServerError;

class AsanaError extends \Exception
{
    public function __construct($message, $status, $response)
    {
        $this->message = $message;
        $this->status = $status;
        $this->response = $response;
    }

    public static function handleErrorResponse($response)
    {
        switch ($response->code) {
            case ForbiddenError::STATUS:
                throw new ForbiddenError($response);
            case InvalidRequestError::STATUS:
                throw new InvalidRequestError($response);
            case InvalidTokenError::STATUS:
                throw new InvalidTokenError($response);
            case NoAuthorizationError::STATUS:
                throw new NoAuthorizationError($response);
            case NotFoundError::STATUS:
                throw new NotFoundError($response);
            case RateLimitEnforcedError::STATUS:
                throw new RateLimitEnforcedError($response);
            case ServerError::STATUS:
                throw new ServerError($response);
        }
    }
}
