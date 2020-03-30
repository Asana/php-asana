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

    /** Get a workspace membership
     *
     * @param string $workspace_membership_gid  (required)
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getWorkspaceMembership($workspace_membership_gid, $params = array(), $options = array()) {
        $path = "/workspace_memberships/{workspace_membership_gid}";
        $path = str_replace("{workspace_membership_gid}", $workspace_membership_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Get workspace memberships for a user
     *
     * @param string $user_gid  (required) A string identifying a user. This can either be the string \"me\", an email, or the gid of a user.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getWorkspaceMembershipsForUser($user_gid, $params = array(), $options = array()) {
        $path = "/users/{user_gid}/workspace_memberships";
        $path = str_replace("{user_gid}", $user_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get the workspace memberships for a workspace
     *
     * @param string $workspace_gid  (required) Globally unique identifier for the workspace or organization.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getWorkspaceMembershipsForWorkspace($workspace_gid, $params = array(), $options = array()) {
        $path = "/workspaces/{workspace_gid}/workspace_memberships";
        $path = str_replace("{workspace_gid}", $workspace_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }
}
