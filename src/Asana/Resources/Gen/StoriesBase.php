<?php

namespace Asana\Resources\Gen;

class StoriesBase
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function findByTask($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/stories", $task);
        return $this->client->getCollection($path, $params, $options);
    }

    public function findById($story, $params = array(), $options = array())
    {
        $path = sprintf("/stories/%s", $story);
        return $this->client->get($path, $params, $options);
    }

    public function createOnTask($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/stories", $task);
        return $this->client->post($path, $params, $options);
    }
}