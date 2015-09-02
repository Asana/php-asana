<?php

namespace Asana\Resources\Gen;

class TagsBase
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function create($params = array(), $options = array())
    {
        return $this->client->post("/tags", $params, $options);
    }

    public function createInWorkspace($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s/tags", $workspace);
        return $this->client->post($path, $params, $options);
    }

    public function findById($tag, $params = array(), $options = array())
    {
        $path = sprintf("/tags/%s", $tag);
        return $this->client->get($path, $params, $options);
    }

    public function update($tag, $params = array(), $options = array())
    {
        $path = sprintf("/tags/%s", $tag);
        return $this->client->put($path, $params, $options);
    }

    public function delete($tag, $params = array(), $options = array())
    {
        $path = sprintf("/tags/%s", $tag);
        return $this->client->delete($path, $params, $options);
    }

    public function findAll($params = array(), $options = array())
    {
        return $this->client->getCollection("/tags", $params, $options);
    }

    public function findByWorkspace($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s/tags", $workspace);
        return $this->client->getCollection($path, $params, $options);
    }

    public function getTasksWithTag($tag, $params = array(), $options = array())
    {
        $path = sprintf("/tags/%s/tasks", $tag);
        return $this->client->getCollection($path, $params, $options);
    }
}