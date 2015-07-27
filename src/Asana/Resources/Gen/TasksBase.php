<?php

namespace Asana\Resources\Gen;

class TasksBase
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function create($params = array(), $options = array())
    {
        return $this->client->post("/tasks", $params, $options);
    }

    public function createInWorkspace($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%d/tasks", $workspace);
        return $this->client->post($path, $params, $options);
    }

    public function findById($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%d", $task);
        return $this->client->get($path, $params, $options);
    }

    public function update($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%d", $task);
        return $this->client->put($path, $params, $options);
    }

    public function delete($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%d", $task);
        return $this->client->delete($path, $params, $options);
    }

    public function findByProject($projectId, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%d/tasks", $projectId);
        return $this->client->getCollection($path, $params, $options);
    }

    public function findByTag($tag, $params = array(), $options = array())
    {
        $path = sprintf("/tags/%d/tasks", $tag);
        return $this->client->getCollection($path, $params, $options);
    }

    public function findAll($params = array(), $options = array())
    {
        return $this->client->getCollection("/tasks", $params, $options);
    }

    public function addFollowers($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%d/addFollowers", $task);
        return $this->client->post($path, $params, $options);
    }

    public function removeFollowers($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%d/removeFollowers", $task);
        return $this->client->post($path, $params, $options);
    }

    public function projects($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%d/projects", $task);
        return $this->client->getCollection($path, $params, $options);
    }

    public function addProject($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%d/addProject", $task);
        return $this->client->post($path, $params, $options);
    }

    public function removeProject($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%d/removeProject", $task);
        return $this->client->post($path, $params, $options);
    }

    public function tags($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%d/tags", $task);
        return $this->client->getCollection($path, $params, $options);
    }

    public function addTag($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%d/addTag", $task);
        return $this->client->post($path, $params, $options);
    }

    public function removeTag($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%d/removeTag", $task);
        return $this->client->post($path, $params, $options);
    }

    public function subtasks($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%d/subtasks", $task);
        return $this->client->getCollection($path, $params, $options);
    }

    public function addSubtask($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%d/subtasks", $task);
        return $this->client->post($path, $params, $options);
    }

    public function stories($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%d/stories", $task);
        return $this->client->getCollection($path, $params, $options);
    }

    public function addComment($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%d/stories", $task);
        return $this->client->post($path, $params, $options);
    }
}
