<?php

namespace Asana\Resources\Gen;

class TeamsBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Add a user to a team
     *
     * @param string $team_gid  (required) Globally unique identifier for the team.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function addUserForTeam($team_gid, $params = array(), $options = array()) {
        $path = "/teams/{team_gid}/addUser";
        $path = str_replace("{team_gid}", $team_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Get a team
     *
     * @param string $team_gid  (required) Globally unique identifier for the team.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getTeam($team_gid, $params = array(), $options = array()) {
        $path = "/teams/{team_gid}";
        $path = str_replace("{team_gid}", $team_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Get teams in an organization
     *
     * @param string $workspace_gid  (required) Globally unique identifier for the workspace or organization.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getTeamsForOrganization($workspace_gid, $params = array(), $options = array()) {
        $path = "/organizations/{workspace_gid}/teams";
        $path = str_replace("{workspace_gid}", $workspace_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get teams for a user
     *
     * @param string $user_gid  (required) A string identifying a user. This can either be the string \"me\", an email, or the gid of a user.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getTeamsForUser($user_gid, $params = array(), $options = array()) {
        $path = "/users/{user_gid}/teams";
        $path = str_replace("{user_gid}", $user_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Remove a user from a team
     *
     * @param string $team_gid  (required) Globally unique identifier for the team.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function removeUserForTeam($team_gid, $params = array(), $options = array()) {
        $path = "/teams/{team_gid}/removeUser";
        $path = str_replace("{team_gid}", $team_gid, $path);
        return $this->client->post($path, $params, $options);
    }
}
