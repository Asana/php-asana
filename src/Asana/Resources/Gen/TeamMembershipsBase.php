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

    public function getTeamMembership($team_membership_path_gid, $params = array(), $options = array()) {
        /** Get a team membership
         *
         * @param $team_membership_path_gid string:  (required)
         * @param $params : 
         * @return response
         */
        $path = "/team_memberships/{team_membership_gid}";
        $path = str_replace($path,"{team_membership_path_gid}", $team_membership_path_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getTeamMemberships($params = array(), $options = array()) {
        /** Get team memberships
         *
         * @param $params : 
         * @return response
         */
        $path = "/team_memberships";
        return $this->client->get($path, $params, $options);
    }

    public function getTeamMembershipsForTeam($team_gid, $params = array(), $options = array()) {
        /** Get memberships from a team
         *
         * @param $team_gid string:  (required) Globally unique identifier for the team.
         * @param $params : 
         * @return response
         */
        $path = "/teams/{team_gid}/team_memberships";
        $path = str_replace($path,"{team_gid}", $team_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getTeamMembershipsForUser($user_gid, $params = array(), $options = array()) {
        /** Get memberships from a user
         *
         * @param $user_gid string:  (required) Globally unique identifier for the user.
         * @param $params : 
         * @return response
         */
        $path = "/users/{user_gid}/team_memberships";
        $path = str_replace($path,"{user_gid}", $user_gid);
        return $this->client->get($path, $params, $options);
    }
}
