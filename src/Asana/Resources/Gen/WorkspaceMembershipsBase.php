<?php

namespace Asana\Resources\Gen;

class WorkspaceMembershipsBase {

    /**
    * @param Asana/Client client  The client instance
    */
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function getWorkspaceMembership($workspace_membership_path_gid, $params = array(), $options = array()) {
        /** Get a workspace membership
         *
         * @param $workspace_membership_path_gid string:  (required)
         * @param $params : 
         * @return response
         */
        $path = "/workspace_memberships/{workspace_membership_gid}";
        $path = str_replace($path,"{workspace_membership_path_gid}", $workspace_membership_path_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getWorkspaceMembershipsForUser($user_gid, $params = array(), $options = array()) {
        /** Get workspace memberships for a user
         *
         * @param $user_gid string:  (required) Globally unique identifier for the user.
         * @param $params : 
         * @return response
         */
        $path = "/users/{user_gid}/workspace_memberships";
        $path = str_replace($path,"{user_gid}", $user_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getWorkspaceMembershipsForWorkspace($workspace_gid, $params = array(), $options = array()) {
        /** Get the workspace memberships for a workspace
         *
         * @param $workspace_gid string:  (required) Globally unique identifier for the workspace or organization.
         * @param $params : 
         * @return response
         */
        $path = "/workspaces/{workspace_gid}/workspace_memberships";
        $path = str_replace($path,"{workspace_gid}", $workspace_gid);
        return $this->client->get($path, $params, $options);
    }
}
