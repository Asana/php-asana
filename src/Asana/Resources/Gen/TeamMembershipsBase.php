<?php

namespace Asana\Resources\Gen;

class TeamMembershipsBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Get a team membership
     *
     * @param $team_membership_path_gid string:  (required)
     * @param $params object
     * @return response
     */
    public function getTeamMembership($team_membership_path_gid, $params = array(), $options = array()) {
        $path = "/team_memberships/{team_membership_gid}";
        $path = str_replace($path,"{team_membership_path_gid}", $team_membership_path_gid);
        return $this->client->get($path, $params, $options);
    }

    /** Get team memberships
     *
     * @param $params object
     * @return response
     */
    public function getTeamMemberships($params = array(), $options = array()) {
        $path = "/team_memberships";
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get memberships from a team
     *
     * @param $team_gid string:  (required) Globally unique identifier for the team.
     * @param $params object
     * @return response
     */
    public function getTeamMembershipsForTeam($team_gid, $params = array(), $options = array()) {
        $path = "/teams/{team_gid}/team_memberships";
        $path = str_replace($path,"{team_gid}", $team_gid);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get memberships from a user
     *
     * @param $user_gid string:  (required) Globally unique identifier for the user.
     * @param $params object
     * @return response
     */
    public function getTeamMembershipsForUser($user_gid, $params = array(), $options = array()) {
        $path = "/users/{user_gid}/team_memberships";
        $path = str_replace($path,"{user_gid}", $user_gid);
        return $this->client->getCollection($path, $params, $options);
    }
}
