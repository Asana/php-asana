<?php

namespace Asana\Resources\Gen;

class UsersBase
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function me($params = array(), $options = array())
    {
        return $this->client->get("/users/me", $params, $options);
    }

    public function findById($user, $params = array(), $options = array())
    {
        $path = sprintf("/users/%d", $user);
        return $this->client->get($path, $params, $options);
    }

    public function findByWorkspace($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%d/users", $workspace);
        return $this->client->getCollection($path, $params, $options);
    }

    public function findAll($params = array(), $options = array())
    {
        return $this->client->getCollection("/users", $params, $options);
    }
}
