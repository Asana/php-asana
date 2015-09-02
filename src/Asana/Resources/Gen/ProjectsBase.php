<?php

namespace Asana\Resources\Gen;

class ProjectsBase
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function create($params = array(), $options = array())
    {
        return $this->client->post("/projects", $params, $options);
    }

    public function createInWorkspace($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s/projects", $workspace);
        return $this->client->post($path, $params, $options);
    }

    public function createInTeam($team, $params = array(), $options = array())
    {
        $path = sprintf("/teams/%s/projects", $team);
        return $this->client->post($path, $params, $options);
    }

    public function findById($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s", $project);
        return $this->client->get($path, $params, $options);
    }

    public function update($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s", $project);
        return $this->client->put($path, $params, $options);
    }

    public function delete($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s", $project);
        return $this->client->delete($path, $params, $options);
    }

    public function findAll($params = array(), $options = array())
    {
        return $this->client->getCollection("/projects", $params, $options);
    }

    public function findByWorkspace($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s/projects", $workspace);
        return $this->client->getCollection($path, $params, $options);
    }

    public function findByTeam($team, $params = array(), $options = array())
    {
        $path = sprintf("/teams/%s/projects", $team);
        return $this->client->getCollection($path, $params, $options);
    }

    public function sections($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s/sections", $project);
        return $this->client->getCollection($path, $params, $options);
    }

    public function tasks($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s/tasks", $project);
        return $this->client->getCollection($path, $params, $options);
    }
}