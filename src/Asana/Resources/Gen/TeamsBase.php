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
     * @param $team_gid string:  (required) Globally unique identifier for the team.
     * @param $params object
     * @return response
     */
    public function addUserForTeam($team_gid, $params = array(), $options = array()) {
        $path = "/teams/{team_gid}/addUser";
        $path = str_replace($path,"{team_gid}", $team_gid);
        return $this->client->post($path, $params, $options);
    }

    /** Get a team
     *
     * @param $team_gid string:  (required) Globally unique identifier for the team.
     * @param $params object
     * @return response
     */
    public function getTeam($team_gid, $params = array(), $options = array()) {
        $path = "/teams/{team_gid}";
        $path = str_replace($path,"{team_gid}", $team_gid);
        return $this->client->get($path, $params, $options);
    }

    /** Get teams in an organization
     *
     * @param $workspace_gid string:  (required) Globally unique identifier for the workspace or organization.
     * @param $params object
     * @return response
     */
    public function getTeamsForOrganization($workspace_gid, $params = array(), $options = array()) {
        $path = "/organizations/{workspace_gid}/teams";
        $path = str_replace($path,"{workspace_gid}", $workspace_gid);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get teams for a user
     *
     * @param $user_gid string:  (required) Globally unique identifier for the user.
     * @param $params object
     * @return response
     */
    public function getTeamsForUser($user_gid, $params = array(), $options = array()) {
        $path = "/users/{user_gid}/teams";
        $path = str_replace($path,"{user_gid}", $user_gid);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Remove a user from a team
     *
     * @param $team_gid string:  (required) Globally unique identifier for the team.
     * @param $params object
     * @return response
     */
    public function removeUserForTeam($team_gid, $params = array(), $options = array()) {
        $path = "/teams/{team_gid}/removeUser";
        $path = str_replace($path,"{team_gid}", $team_gid);
        return $this->client->post($path, $params, $options);
    }
}
