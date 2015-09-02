<?php

namespace Asana\Resources\Gen;

class WorkspacesBase
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function findById($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s", $workspace);
        return $this->client->get($path, $params, $options);
    }

    public function findAll($params = array(), $options = array())
    {
        return $this->client->getCollection("/workspaces", $params, $options);
    }

    public function update($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s", $workspace);
        return $this->client->put($path, $params, $options);
    }

    public function typeahead($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s/typeahead", $workspace);
        return $this->client->getCollection($path, $params, $options);
    }
}