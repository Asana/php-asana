<?php

namespace Asana;

use Asana\Dispatcher\BasicAuthDispatcher;
use Asana\Dispatcher\OAuthDispatcher;

use Asana\Errors\AsanaError;
use Asana\Errors\RetryableAsanaError;
use Asana\Errors\RateLimitEnforcedError;

use Asana\Iterator\CollectionPageIterator;
use Asana\Resources\Events;
use Asana\Resources\Portfolios;
use Asana\Resources\ProjectMemberships;
use Asana\Resources\Projects;
use Asana\Resources\Users;

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
        'iterator_type' => 'items',
        'log_asana_change_warnings' => true
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
        $this->custom_fields = new Resources\CustomFields($this);
        $this->custom_field_settings = new Resources\CustomFieldSettings($this);
        $this->events = new Resources\Events($this);
        $this->jobs = new Resources\Jobs($this);
        $this->organization_exports = new Resources\OrganizationExports($this);
        $this->portfolios = new Resources\Portfolios($this);
        $this->portfolio_memberships = new Resources\PortfolioMemberships($this);
        $this->projects = new Resources\Projects($this);
        $this->project_memberships = new Resources\ProjectMemberships($this);
        $this->project_statuses = new Resources\ProjectStatuses($this);
        $this->stories = new Resources\Stories($this);
        $this->sections = new Resources\Sections($this);
        $this->tags = new Resources\Tags($this);
        $this->tasks = new Resources\Tasks($this);
        $this->teams = new Resources\Teams($this);
        $this->users = new Resources\Users($this);
        $this->user_task_lists = new Resources\UserTaskLists($this);
        $this->workspaces = new Resources\Workspaces($this);
        $this->webhooks = new Resources\Webhooks($this);
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
        $options = Client::array_merge_recursive_distinct($this->options, $options);

        $requestOptions = $this->parseRequestOptions($options);
        $uri = $options['base_url'] . $path;
        $retryCount = 0;

        while (true) {
            try {
                $response = $this->dispatcher->request($method, $uri, $requestOptions);

                if (!array_key_exists('headers', $options)) {
                    $options['headers'] = array();
                }
                $this->logAsanaChangeHeaders($options['headers'], $response->headers->toArray());

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

    private function logAsanaChangeHeaders($reqHeaders, $resHeaders)
    {
        if (!$this->options['log_asana_change_warnings']) {
            return;
        }

        $changeHeaderKey = null;

        foreach ((array) $resHeaders as $key => $value) {
            if (strtolower($key) == 'asana-change') {
                $changeHeaderKey = $key;
            }
        }

        if ($changeHeaderKey != null) {
            $flagsAccountedFor = array();

            foreach ((array) $reqHeaders as $reqHeader => $reqHeaderValue) {
                $lowerReqHeader = strtolower($reqHeader);
                if ($lowerReqHeader == "asana-enable" || $lowerReqHeader == "asana-disable") {

                    $flagsAccountedFor = array_merge($flagsAccountedFor, preg_split("/,/", $reqHeaderValue));
                }
            }

            $changesArray = preg_split("/,/", $resHeaders[$changeHeaderKey]);
            if ($changesArray == null) {
                return;
            }

            foreach ($changesArray as $change) {
                $changeParams = preg_split("/;/", $change);

                $name = "";
                $info = "";
                $affected = "";

                foreach ((array) $changeParams as $changeParam) {
                    $paramKeyValue = preg_split("/=/", $changeParam);

                    $paramKeyValue[0] = trim($paramKeyValue[0]);
                    $paramKeyValue[1] = trim($paramKeyValue[1]);
                    switch ($paramKeyValue[0]) {
                        case "name":
                            $name = $paramKeyValue[1];
                            break;
                        case "info":
                            $info = $paramKeyValue[1];
                            break;
                        case "affected":
                            $affected = $paramKeyValue[1];
                            break;
                    }
                }

                if ($affected != "true") {
                    continue;
                }

                if (!in_array($name, $flagsAccountedFor)) {
                    $message = "This request is affected by the \"" . $name . "\" deprecation. " .
                        "Please visit this url for more info: " . $info . "\n" .
                        "Adding \"" . $name . "\" to your \"Asana-Enable\" or \"Asana-Disable\" header " .
                        "will opt in/out to this deprecation and suppress this warning.";

                    trigger_error($message, E_USER_WARNING);
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

        $post_headers = array('content-type' => 'application/json');
        if (array_key_exists("headers", $options)) {
            $post_headers = array_merge($post_headers, $options["headers"]);
        }
        $options = array_merge(
            $options,
            array(
                'headers' => $post_headers,
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

        $put_headers = array('content-type' => 'application/json');
        if (array_key_exists("headers", $options)) {
            $put_headers = array_merge($put_headers, $options["headers"]);
        }
        $options = array_merge(
            $options,
            array(
                'headers' => $put_headers,
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

    private static function array_merge_recursive_distinct(array &$array1, array &$array2)
    {
        $merged = $array1;
        foreach ($array2 as $key => &$value)
        {
            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key]))
            {
                $merged[$key] = Client::array_merge_recursive_distinct($merged[$key], $value);
            }
            else
            {
                $merged[$key] = $value;
            }
        }
        return $merged;
    }
}
