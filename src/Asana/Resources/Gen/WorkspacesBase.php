<?php

namespace Asana\Resources\Gen;

class WorkspacesBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Add a user to a workspace or organization
     *
     * @param $workspace_gid string:  (required) Globally unique identifier for the workspace or organization.
     * @param $params object
     * @return response
     */
    public function addUserForWorkspace($workspace_gid, $params = array(), $options = array()) {
        $path = "/workspaces/{workspace_gid}/addUser";
        $path = str_replace($path,"{workspace_gid}", $workspace_gid);
        return $this->client->post($path, $params, $options);
    }

    /** Get a workspace
     *
     * @param $workspace_gid string:  (required) Globally unique identifier for the workspace or organization.
     * @param $params object
     * @return response
     */
    public function getWorkspace($workspace_gid, $params = array(), $options = array()) {
        $path = "/workspaces/{workspace_gid}";
        $path = str_replace($path,"{workspace_gid}", $workspace_gid);
        return $this->client->get($path, $params, $options);
    }

    /** Get multiple workspaces
     *
     * @param $params object
     * @return response
     */
    public function getWorkspaces($params = array(), $options = array()) {
        $path = "/workspaces";
        return $this->client->getCollection($path, $params, $options);
    }

    /** Remove a user from a workspace or organization
     *
     * @param $workspace_gid string:  (required) Globally unique identifier for the workspace or organization.
     * @param $params object
     * @return response
     */
    public function removeUserForWorkspace($workspace_gid, $params = array(), $options = array()) {
        $path = "/workspaces/{workspace_gid}/removeUser";
        $path = str_replace($path,"{workspace_gid}", $workspace_gid);
        return $this->client->post($path, $params, $options);
    }

    /** Update a workspace
     *
     * @param $workspace_gid string:  (required) Globally unique identifier for the workspace or organization.
     * @param $params object
     * @return response
     */
    public function updateWorkspace($workspace_gid, $params = array(), $options = array()) {
        $path = "/workspaces/{workspace_gid}";
        $path = str_replace($path,"{workspace_gid}", $workspace_gid);
        return $this->client->put($path, $params, $options);
    }
}
