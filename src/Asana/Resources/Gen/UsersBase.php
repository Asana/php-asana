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

    public function getAllUsers($params = array(), $options = array()) {
        /** Get multiple users
         *
         * @param $params : 
         * @return response
         */
        $path = "/users";
        return $this->client->get($path, $params, $options);
    }

    public function getUser($user_gid, $params = array(), $options = array()) {
        /** Get a user
         *
         * @param $user_gid string:  (required) Globally unique identifier for the user.
         * @param $params : 
         * @return response
         */
        $path = "/users/{user_gid}";
        $path = str_replace($path,"{user_gid}", $user_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getUserFavorites($user_gid, $params = array(), $options = array()) {
        /** Get a user's favorites
         *
         * @param $user_gid string:  (required) Globally unique identifier for the user.
         * @param $params : 
         * @return response
         */
        $path = "/users/{user_gid}/favorites";
        $path = str_replace($path,"{user_gid}", $user_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getUsersForTeam($team_gid, $params = array(), $options = array()) {
        /** Get users in a team
         *
         * @param $team_gid string:  (required) Globally unique identifier for the team.
         * @param $params : 
         * @return response
         */
        $path = "/teams/{team_gid}/users";
        $path = str_replace($path,"{team_gid}", $team_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getUsersInWorkspace($workspace_gid, $params = array(), $options = array()) {
        /** Get users in a workspace or organization
         *
         * @param $workspace_gid string:  (required) Globally unique identifier for the workspace or organization.
         * @param $params : 
         * @return response
         */
        $path = "/workspaces/{workspace_gid}/users";
        $path = str_replace($path,"{workspace_gid}", $workspace_gid);
        return $this->client->get($path, $params, $options);
    }
}
