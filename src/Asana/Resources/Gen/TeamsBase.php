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
        $path = sprintf("/teams/%s", $team);
        return $this->client->get($path, $params, $options);
    }

    public function findByOrganization($organization, $params = array(), $options = array())
    {
        $path = sprintf("/organizations/%s/teams", $organization);
        return $this->client->getCollection($path, $params, $options);
    }

    public function users($team, $params = array(), $options = array())
    {
        $path = sprintf("/teams/%s/users", $team);
        return $this->client->getCollection($path, $params, $options);
    }
}