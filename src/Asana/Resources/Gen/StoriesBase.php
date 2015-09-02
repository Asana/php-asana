<?php

namespace Asana\Resources\Gen;

class StoriesBase
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function findById($story, $params = array(), $options = array())
    {
        $path = sprintf("/stories/%d", $story);
        return $this->client->get($path, $params, $options);
    }

    public function findByTask($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%d/stories", $task);
        return $this->client->getCollection($path, $params, $options);
    }

    public function createOnTask($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%d/stories", $task);
        return $this->client->post($path, $params, $options);
    }
}