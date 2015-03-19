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

    public function findByOrganization($team, $params = array(), $options = array())
    {
        $path = sprintf("/organizations/%d/teams", $team);
        return $this->client->getCollection($path, $params, $options);
    }

    public function users($team, $params = array(), $options = array())
    {
        $path = sprintf("/team/%d/users", $team);
        return $this->client->getCollection($path, $params, $options);
    }
}
