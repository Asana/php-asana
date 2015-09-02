<?php

namespace Asana\Resources\Gen;

class TeamsBase
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function findById($team, $params = array(), $options = array())
    {
        $path = sprintf("/teams/%d", $team);
        return $this->client->get($path, $params, $options);
    }

    public function findByOrganization($organization, $params = array(), $options = array())
    {
        $path = sprintf("/organizations/%d/teams", $organization);
        return $this->client->getCollection($path, $params, $options);
    }

    public function users($team, $params = array(), $options = array())
    {
        $path = sprintf("/teams/%d/users", $team);
        return $this->client->getCollection($path, $params, $options);
    }

    public function addUser($team, $params = array(), $options = array())
    {
        $path = sprintf("/teams/%s/addUser", $team);
        return $this->client->post($path, $params, $options);
    }

    public function removeUser($team, $params = array(), $options = array())
    {
        $path = sprintf("/teams/%s/removeUser", $team);
        return $this->client->post($path, $params, $options);
    }
}