<?php

namespace Asana;

use Asana\Dispatcher\BaiscAuth;
use Asana\Resources\Users;

use Asana\Errors;

class Client
{
    public function __construct($dispatcher)
    {
        $this->dispatcher = $dispatcher;

        $this->attachments = new Resources\Attachments($this);
        $this->events = new Resources\Events($this);
        $this->projects = new Resources\Projects($this);
        $this->stories = new Resources\Stories($this);
        $this->tags = new Resources\Tags($this);
        $this->tasks = new Resources\Tasks($this);
        $this->teams = new Resources\Teams($this);
        $this->users = new Resources\Users($this);
        $this->workspaces = new Resources\Workspaces($this);
    }

    public function request($method, $path, $headers = null, $query = null, $body = null, $options = null)
    {
        $response = $this->dispatcher->request($method, $path);

        Error::handleErrorResponse($response);

        return $response->body->data;
    }

    public function get($path, $query = null, $options = null)
    {
        return $this->request("GET", $path, $options);
    }

    public function getCollection($path, $query = null, $options = null)
    {
        return $this->request("GET", $path, $options);
    }

    public static function basicAuth($apiKey)
    {
        return new Client(new Dispatcher\BasicAuth($apiKey));
    }
}
