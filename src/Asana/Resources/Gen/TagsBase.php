<?php

namespace Asana\Resources\Gen;

class TagsBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Create a tag
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function createTag($params = array(), $options = array()) {
        $path = "/tags";
        return $this->client->post($path, $params, $options);
    }

    /** Create a tag in a workspace
     *
     * @param string $workspace_gid  (required) Globally unique identifier for the workspace or organization.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function createTagForWorkspace($workspace_gid, $params = array(), $options = array()) {
        $path = "/workspaces/{workspace_gid}/tags";
        $path = str_replace("{workspace_gid}", $workspace_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Get a tag
     *
     * @param string $tag_gid  (required) Globally unique identifier for the tag.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getTag($tag_gid, $params = array(), $options = array()) {
        $path = "/tags/{tag_gid}";
        $path = str_replace("{tag_gid}", $tag_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Get multiple tags
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getTags($params = array(), $options = array()) {
        $path = "/tags";
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get a task's tags
     *
     * @param string $task_gid  (required) The task to operate on.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getTagsForTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/tags";
        $path = str_replace("{task_gid}", $task_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get tags in a workspace
     *
     * @param string $workspace_gid  (required) Globally unique identifier for the workspace or organization.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getTagsForWorkspace($workspace_gid, $params = array(), $options = array()) {
        $path = "/workspaces/{workspace_gid}/tags";
        $path = str_replace("{workspace_gid}", $workspace_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Update a tag
     *
     * @param string $tag_gid  (required) Globally unique identifier for the tag.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function updateTag($tag_gid, $params = array(), $options = array()) {
        $path = "/tags/{tag_gid}";
        $path = str_replace("{tag_gid}", $tag_gid, $path);
        return $this->client->put($path, $params, $options);
    }
}
