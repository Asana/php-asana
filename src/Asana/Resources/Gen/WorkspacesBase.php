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

    public function addUserToWorkspace($workspace_gid, $params = array(), $options = array()) {
        /** Add a user to a workspace or organization
         *
         * @param $workspace_gid string:  (required) Globally unique identifier for the workspace or organization.
         * @param $params : 
         * @return response
         */
        $path = "/workspaces/{workspace_gid}/addUser";
        $path = str_replace($path,"{workspace_gid}", $workspace_gid);
        return $this->client->post($path, $params, $options);
    }

    public function getAllWorkspaces($params = array(), $options = array()) {
        /** Get multiple workspaces
         *
         * @param $params : 
         * @return response
         */
        $path = "/workspaces";
        return $this->client->get($path, $params, $options);
    }

    public function getWorkspace($workspace_gid, $params = array(), $options = array()) {
        /** Get a workspace
         *
         * @param $workspace_gid string:  (required) Globally unique identifier for the workspace or organization.
         * @param $params : 
         * @return response
         */
        $path = "/workspaces/{workspace_gid}";
        $path = str_replace($path,"{workspace_gid}", $workspace_gid);
        return $this->client->get($path, $params, $options);
    }

    public function removeUserToWorkspace($workspace_gid, $params = array(), $options = array()) {
        /** Remove a user from a workspace or organization
         *
         * @param $workspace_gid string:  (required) Globally unique identifier for the workspace or organization.
         * @param $params : 
         * @return response
         */
        $path = "/workspaces/{workspace_gid}/removeUser";
        $path = str_replace($path,"{workspace_gid}", $workspace_gid);
        return $this->client->post($path, $params, $options);
    }

    public function updateWorkspace($workspace_gid, $params = array(), $options = array()) {
        /** Update a workspace
         *
         * @param $workspace_gid string:  (required) Globally unique identifier for the workspace or organization.
         * @param $params : 
         * @return response
         */
        $path = "/workspaces/{workspace_gid}";
        $path = str_replace($path,"{workspace_gid}", $workspace_gid);
        return $this->client->put($path, $params, $options);
    }
}
