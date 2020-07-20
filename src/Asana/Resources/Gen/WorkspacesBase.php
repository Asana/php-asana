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
     * @param string $workspace_gid  (required) Globally unique identifier for the workspace or organization.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function addUserForWorkspace($workspace_gid, $params = array(), $options = array()) {
        $path = "/workspaces/{workspace_gid}/addUser";
        $path = str_replace("{workspace_gid}", $workspace_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Get a workspace
     *
     * @param string $workspace_gid  (required) Globally unique identifier for the workspace or organization.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getWorkspace($workspace_gid, $params = array(), $options = array()) {
        $path = "/workspaces/{workspace_gid}";
        $path = str_replace("{workspace_gid}", $workspace_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Get multiple workspaces
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getWorkspaces($params = array(), $options = array()) {
        $path = "/workspaces";
        return $this->client->getCollection($path, $params, $options);
    }

    /** Remove a user from a workspace or organization
     *
     * @param string $workspace_gid  (required) Globally unique identifier for the workspace or organization.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function removeUserForWorkspace($workspace_gid, $params = array(), $options = array()) {
        $path = "/workspaces/{workspace_gid}/removeUser";
        $path = str_replace("{workspace_gid}", $workspace_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Update a workspace
     *
     * @param string $workspace_gid  (required) Globally unique identifier for the workspace or organization.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function updateWorkspace($workspace_gid, $params = array(), $options = array()) {
        $path = "/workspaces/{workspace_gid}";
        $path = str_replace("{workspace_gid}", $workspace_gid, $path);
        return $this->client->put($path, $params, $options);
    }
}
