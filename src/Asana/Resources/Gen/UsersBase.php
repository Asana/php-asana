<?php

namespace Asana\Resources\Gen;

class UsersBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Get a user's favorites
     *
     * @param string $user_gid  (required) A string identifying a user. This can either be the string \"me\", an email, or the gid of a user.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getFavoritesForUser($user_gid, $params = array(), $options = array()) {
        $path = "/users/{user_gid}/favorites";
        $path = str_replace("{user_gid}", $user_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get a user
     *
     * @param string $user_gid  (required) A string identifying a user. This can either be the string \"me\", an email, or the gid of a user.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getUser($user_gid, $params = array(), $options = array()) {
        $path = "/users/{user_gid}";
        $path = str_replace("{user_gid}", $user_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Get multiple users
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getUsers($params = array(), $options = array()) {
        $path = "/users";
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get users in a team
     *
     * @param string $team_gid  (required) Globally unique identifier for the team.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getUsersForTeam($team_gid, $params = array(), $options = array()) {
        $path = "/teams/{team_gid}/users";
        $path = str_replace("{team_gid}", $team_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get users in a workspace or organization
     *
     * @param string $workspace_gid  (required) Globally unique identifier for the workspace or organization.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getUsersForWorkspace($workspace_gid, $params = array(), $options = array()) {
        $path = "/workspaces/{workspace_gid}/users";
        $path = str_replace("{workspace_gid}", $workspace_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }
}
