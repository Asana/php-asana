<?php

namespace Asana\Dispatcher;

class AccessTokenDispatcher extends Dispatcher
{
    public function __construct($accessToken)
    {
        parent::__construct();

        $this->accessToken = $accessToken;
    }

    protected function authenticate($request)
    {
        if ($this->accessToken == null) {
            throw new \Exception("AccessTokenDispatcher: access token not set");
        }
        return $request->addHeader("Authorization", "Bearer " . $this->accessToken);
    }
}
