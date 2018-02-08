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
    const PREMIUM_ONLY_STR = "not available for free";
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
                // Handle 403's with a premium response
                try {
                    foreach ($response->body->errors as $error) {
                        if (strpos($error->message, self::PREMIUM_ONLY_STR) !== false) {
                            throw new PremiumOnlyError($response);
                        }
                    }
                } catch (Exception $e) {
                    throw new ForbiddenError($response);
                }
                throw new ForbiddenError($response);
            case InvalidRequestError::STATUS:
                throw new InvalidRequestError($response);
            case InvalidTokenError::STATUS:
                throw new InvalidTokenError($response);
            case NoAuthorizationError::STATUS:
                throw new NoAuthorizationError($response);
            case NotFoundError::STATUS:
                throw new NotFoundError($response);
            case PremiumOnlyError::STATUS:
                throw new PremiumOnlyError($response);
            case RateLimitEnforcedError::STATUS:
                throw new RateLimitEnforcedError($response);
            case ServerError::STATUS:
                throw new ServerError($response);
        }
    }
}
