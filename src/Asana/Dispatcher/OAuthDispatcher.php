<?php

namespace Asana\Dispatcher;

use OAuth2;

class OAuthDispatcher extends Dispatcher
{
    const NATIVE_REDIRECT_URI = 'urn:ietf:wg:oauth:2.0:oob';

    public static $AUTHORIZATION_ENDPOINT = 'https://app.asana.com/-/oauth_authorize';
    public static $TOKEN_ENDPOINT = 'https://app.asana.com/-/oauth_token';

    private $expirationTimeMillis = null;

    public function __construct($options)
    {
        $this->clientId = $options['client_id'];
        $this->clientSecret = isset($options['client_secret']) ? $options['client_secret'] : null;
        $this->accessToken = isset($options['token']) ? $options['token'] : null;
        $this->authorized = !!$this->accessToken;
        $this->redirectUri = isset($options['redirect_uri']) ? $options['redirect_uri'] : null;
        $this->refreshToken = isset($options['refresh_token']) ? $options['refresh_token'] : null;

        $this->oauthClient = new OAuth2\Client($this->clientId, $this->clientSecret);
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
        $result = $this->oauthClient->getAccessToken(OAuthDispatcher::$TOKEN_ENDPOINT, 'authorization_code', $params)['result'];
        $this->accessToken = $result['access_token'];
        $this->refreshToken = $result['refresh_token'];
        $this->expiresIn = $result['expires_in'];
        $this->authorized = !!$this->accessToken;
        return $this->accessToken;
    }

    public function refreshAccessToken()
    {
        if ($this->refreshToken == null) {
            throw new \Exception("OAuthDispatcher: cannot refresh access token without a refresh token.");
        } else {
            $params = array('refresh_token' => $this->refreshToken, 'redirect_uri' => $this->redirectUri);
            $result = $this->oauthClient->getAccessToken(OAuthDispatcher::$TOKEN_ENDPOINT, 'refresh_token', $params)['result'];
            $this->accessToken = $result['access_token'];
            $this->expiresIn = $result['expires_in'];
            return $this->accessToken;
        }
    }

    public function setExpiresInSeconds($expiresIn)
    {
        $this->expirationTimeMillis = $this->currentTimeMillis() + ($expiresIn * 1000);
    }

    public function getExpiresInSeconds()
    {
        if ($this->expirationTimeMillis == null) {
            return null;
        } else {
            return ($this->expirationTimeMillis - $this->currentTimeMillis()) / 1000;
        }
    }

    protected function authenticate($request)
    {
        $expiresIn = $this->getExpiresInSeconds();
        if ($expiresIn != null && $expiresIn < 60) {
            $this->refreshAccessToken();
        }

        if ($this->accessToken == null) {
            throw new \Exception("OAuthDispatcher: access token not set");
        }
        return $request->addHeader("Authorization", "Bearer " . $this->accessToken);
    }

    private function currentTimeMillis()
    {
        return round(microtime(true) * 1000);
    }
}
