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
     * @param string $team_membership_gid  (required)
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getTeamMembership($team_membership_gid, $params = array(), $options = array()) {
        $path = "/team_memberships/{team_membership_gid}";
        $path = str_replace("{team_membership_gid}", $team_membership_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Get team memberships
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getTeamMemberships($params = array(), $options = array()) {
        $path = "/team_memberships";
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get memberships from a team
     *
     * @param string $team_gid  (required) Globally unique identifier for the team.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getTeamMembershipsForTeam($team_gid, $params = array(), $options = array()) {
        $path = "/teams/{team_gid}/team_memberships";
        $path = str_replace("{team_gid}", $team_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get memberships from a user
     *
     * @param string $user_gid  (required) A string identifying a user. This can either be the string \"me\", an email, or the gid of a user.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getTeamMembershipsForUser($user_gid, $params = array(), $options = array()) {
        $path = "/users/{user_gid}/team_memberships";
        $path = str_replace("{user_gid}", $user_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }
}
