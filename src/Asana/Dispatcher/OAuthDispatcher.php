<?php

namespace Asana\Dispatcher;

use \OAuth2;

class OAuthDispatcher extends Dispatcher
{
    const NATIVE_REDIRECT_URI = 'urn:ietf:wg:oauth:2.0:oob';

    public static $AUTHORIZATION_ENDPOINT = 'https://app.asana.com/-/oauth_authorize';
    public static $TOKEN_ENDPOINT = 'https://app.asana.com/-/oauth_token';

    public function __construct($options)
    {
        $this->clientId = $options['client_id'];
        $this->clientSecret = isset($options['client_secret']) ? $options['client_secret'] : null;
        $this->accessToken = isset($options['token']) ? $options['token'] : null;
        $this->authorized = !!$this->accessToken;
        $this->redirectUri = isset($options['redirect_uri']) ? $options['redirect_uri'] : null;

        $this->oauthClient = new \OAuth2\Client($this->clientId, $this->clientSecret);
    }

    public function authorizationUrl(&$state = null)
    {
        if ($state === null) {
            $state = rand();
        }
        return $this->oauthClient->getAuthenticationUrl(
            OAuthDispatcher::$AUTHORIZATION_ENDPOINT,
            $this->redirectUri,
            array('state' => $state)
        );
    }

    public function fetchToken($code)
    {
        $params = array('code' => $code, 'redirect_uri' => $this->redirectUri);
        $result = $this->oauthClient->getAccessToken(OAuthDispatcher::$TOKEN_ENDPOINT, 'authorization_code', $params);
        $this->accessToken = $result['result']['access_token'];
        $this->authorized = !!$this->accessToken;
        return $this->accessToken;
    }

    protected function authenticate($request)
    {
        if ($this->accessToken == null) {
            throw new \Exception("OAuthDispatcher: access token not set");
        }
        return $request->addHeader("Authorization", "Bearer " . $this->accessToken);
    }
}
