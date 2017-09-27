<?php

namespace Asana;

use Asana\Dispatcher\BasicAuthDispatcher;
use Asana\Dispatcher\OAuthDispatcher;

use Asana\Errors\AsanaError;
use Asana\Errors\RetryableAsanaError;
use Asana\Errors\RateLimitEnforcedError;

use Asana\Iterator\CollectionPageIterator;

class Client
{
    const RETRY_DELAY = 1.0;
    const RETRY_BACKOFF = 2.0;

    public static $DEFAULTS = array(
        'base_url' => 'https://app.asana.com/api/1.0',
        'item_limit' => null,
        'page_size' => 50,
        'poll_interval' => 5,
        'max_retries' => 5,
        'full_payload' => null,
        'iterator_type' => 'items'
    );

    private static $QUERY_OPTIONS   = array('limit', 'offset' , 'sync');
    private static $REQUEST_OPTIONS = array('params', 'data', 'headers', 'files','curl');
    private static $API_OPTIONS     = array('pretty', 'fields', 'expand');
    private static $CLIENT_OPTIONS  = null;
    private static $ALL_OPTIONS     = null;

    public function __construct($dispatcher, $options = array())
    {
        Client::bootstrap();

        $this->dispatcher = $dispatcher;

        $this->options = array_merge(Client::$DEFAULTS, $options);

        $this->attachments = new Resources\Attachments($this);
        $this->events = new Resources\Events($this);
        $this->projects = new Resources\Projects($this);
        $this->stories = new Resources\Stories($this);
        $this->tags = new Resources\Tags($this);
        $this->tasks = new Resources\Tasks($this);
        $this->teams = new Resources\Teams($this);
        $this->users = new Resources\Users($this);
        $this->workspaces = new Resources\Workspaces($this);
        $this->webhooks = new Resources\Webhooks($this);
        $this->custom_fields = new Resources\CustomFields($this);
        $this->custom_field_settings = new Resources\CustomFieldSettings($this);
    }

    public static function accessToken($accessToken, $options = array())
    {
        return new Client(new Dispatcher\AccessTokenDispatcher($accessToken), $options);
    }

    public static function oauth($credentials = array(), $options = array())
    {
        return new Client(new Dispatcher\OAuthDispatcher($credentials), $options);
    }

    public function request($method, $path, $options)
    {
        $options = array_merge($this->options, $options);
        $requestOptions = $this->parseRequestOptions($options);
        $uri = $options['base_url'] . $path;
        $retryCount = 0;
        while (true) {
            try {
                $response = $this->dispatcher->request($method, $uri, $requestOptions);

                Errors\AsanaError::handleErrorResponse($response);

                if ($options['full_payload']) {
                    return $response->body;
                } else {
                    return $response->body->data;
                }
            } catch (RetryableAsanaError $e) {
                if ($retryCount < $options['max_retries']) {
                    $this->handleRetryableError($e, $retryCount);
                    $retryCount++;
                } else {
                    throw $e;
                }
            }
        }
    }

    private function handleRetryableError($e, $retryCount)
    {
        if ($e instanceof Errors\RateLimitEnforcedError) {
            sleep($e->retryAfter);
        } else {
            sleep($time = self::RETRY_DELAY * pow(self::RETRY_BACKOFF, $retryCount));
        }
    }

    public function get($path, $query, $options = array())
    {
        if ($query == null) {
            $query = array();
        }
        $apiOptions = $this->parseApiOptions($options, true);
        $queryOptions = $this->parseQueryOptions($options);
        $parameterOptions = $this->parseParameterOptions($options);
        $options['params'] = array_merge($queryOptions, $apiOptions, $parameterOptions, $query);
        return $this->request("GET", $path, $options);
    }

    public function getCollection($path, $query, $options = array())
    {
        $options = array_merge($this->options, $options);
        if ($options['iterator_type'] == 'items') {
            $pageIterator = new CollectionPageIterator($this, $path, $query, $options);
            return $pageIterator->items();
        } elseif ($options['iterator_type'] == 'pages') {
            $pageIterator = new CollectionPageIterator($this, $path, $query, $options);
            return $pageIterator;
        } elseif ($options['iterator_type'] == false) {
            if (!isset($options['limit'])) {
                $options['limit'] = $options['page_size'];
            }
            if ($options['full_payload'] === null) {
                $options['full_payload'] = true;
            }
            return $this->get($path, $query, $options);
        }
        throw Exception('Unknown value for "iterator_type" option: ' . (string)$options['iterator_type']);
    }

    public function post($path, $data, $options = array())
    {
        $parameterOptions = $this->parseParameterOptions($options);
        $options = array_merge(
            $options,
            array(
                'headers' => array('content-type' => 'application/json'),
                'data' => array(
                    'data' => array_merge($parameterOptions, $data), # values in the data body takes precendence
                    'options' => $this->parseApiOptions($options)
                )
            )
        );
        return $this->request('POST', $path, $options);
    }

    public function put($path, $data, $options = array())
    {
        $parameterOptions = $this->parseParameterOptions($options);
        $options = array_merge(
            $options,
            array(
                'headers' => array('content-type' => 'application/json'),
                'data' => array(
                    'data' => array_merge($parameterOptions, $data), # values in the data body takes precendence
                    'options' => $this->parseApiOptions($options)
                )
            )
        );
        return $this->request('PUT', $path, $options);
    }

    public function delete($path, $data, $options = array())
    {
        return $this->request('DELETE', $path, $options);
    }

    private function parseQueryOptions($options)
    {
        return $this->selectOptions($options, Client::$QUERY_OPTIONS);
    }

    private function parseParameterOptions($options)
    {
        return $this->selectOptions($options, Client::$ALL_OPTIONS, true);
    }

    private function parseApiOptions($options, $queryString = false)
    {
        $apiOptions = $this->selectOptions($options, Client::$API_OPTIONS);
        if ($queryString) {
            // Prefix all options with "opt_"
            $queryApiOptions = array();
            foreach ($apiOptions as $key => $value) {
                // Transform list/tuples into comma separated list
                if (is_array($value)) {
                    $queryApiOptions["opt_{$key}"] = implode(',', $value);
                } else {
                    $queryApiOptions["opt_{$key}"] = $value;
                }
            }
            return $queryApiOptions;
        } else {
            return $apiOptions;
        }
    }

    private function parseRequestOptions($options)
    {
        $requestOptions = $this->selectOptions($options, Client::$REQUEST_OPTIONS);
        if (isset($requestOptions['params'])) {
            foreach ($requestOptions['params'] as $key => $value) {
                if (is_bool($value)) {
                    $requestOptions['params'][$key] = json_encode($value);
                }
            }
        }
        if (isset($requestOptions['data'])) {
            // remove empty 'options':
            if (isset($requestOptions['data']['options']) && count($requestOptions['data']['options']) == 0) {
                unset($requestOptions['data']['options']);
            }
            // serialize to JSON
            $requestOptions['data'] = json_encode($requestOptions['data']);
        }
        return $requestOptions;
    }

    public function selectOptions($options, $keys, $invert = false)
    {
        $options = array_merge($this->options, $options);
        $result = array();
        foreach ($options as $key => $value) {
            // TODO: optimize?
            $inKeys = !is_bool(array_search($key, $keys));
            if (($invert && !$inKeys) or (!$invert && $inKeys)) {
                $result[$key] = $options[$key];
            }
        }
        return $result;
    }

    private static function bootstrap()
    {
        if (Client::$ALL_OPTIONS == null) {
            Client::$CLIENT_OPTIONS = array_keys(Client::$DEFAULTS);
            Client::$ALL_OPTIONS = array_merge(
                Client::$CLIENT_OPTIONS,
                Client::$QUERY_OPTIONS,
                Client::$REQUEST_OPTIONS,
                Client::$API_OPTIONS
            );
        }
    }
}
