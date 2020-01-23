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

    public function createTag($params = array(), $options = array()) {
        /** Create a tag
         *
         * @param $params : 
         * @return response
         */
        $path = "/tags";
        return $this->client->post($path, $params, $options);
    }

    public function createTagInWorkspace($workspace_gid, $params = array(), $options = array()) {
        /** Create a tag in a workspace
         *
         * @param $workspace_gid string:  (required) Globally unique identifier for the workspace or organization.
         * @param $params : 
         * @return response
         */
        $path = "/workspaces/{workspace_gid}/tags";
        $path = str_replace($path,"{workspace_gid}", $workspace_gid);
        return $this->client->post($path, $params, $options);
    }

    public function getTag($tag_gid, $params = array(), $options = array()) {
        /** Get a tag
         *
         * @param $tag_gid string:  (required) Globally unique identifier for the tag.
         * @param $params : 
         * @return response
         */
        $path = "/tags/{tag_gid}";
        $path = str_replace($path,"{tag_gid}", $tag_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getTaskTags($task_gid, $params = array(), $options = array()) {
        /** Get a task's tags
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/tags";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->get($path, $params, $options);
    }

    public function queryAllTagsInWorkspace($workspace_gid, $params = array(), $options = array()) {
        /** Get tags in a workspace
         *
         * @param $workspace_gid string:  (required) Globally unique identifier for the workspace or organization.
         * @param $params : 
         * @return response
         */
        $path = "/workspaces/{workspace_gid}/tags";
        $path = str_replace($path,"{workspace_gid}", $workspace_gid);
        return $this->client->get($path, $params, $options);
    }

    public function queryTags($params = array(), $options = array()) {
        /** Get multiple tags
         *
         * @param $params : 
         * @return response
         */
        $path = "/tags";
        return $this->client->get($path, $params, $options);
    }

    public function updateTag($tag_gid, $params = array(), $options = array()) {
        /** Update a tag
         *
         * @param $tag_gid string:  (required) Globally unique identifier for the tag.
         * @param $params : 
         * @return response
         */
        $path = "/tags/{tag_gid}";
        $path = str_replace($path,"{tag_gid}", $tag_gid);
        return $this->client->put($path, $params, $options);
    }
}
