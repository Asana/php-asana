<?php

namespace Asana\Resources\Gen;

class ProjectMembershipsBase {

    /**
    * @param Asana/Client client  The client instance
    */
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function getProjectMembership($project_membership_path_gid, $params = array(), $options = array()) {
        /** Get a project membership
         *
         * @param $project_membership_path_gid string:  (required)
         * @param $params : 
         * @return response
         */
        $path = "/project_memberships/{project_membership_gid}";
        $path = str_replace($path,"{project_membership_path_gid}", $project_membership_path_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getProjectMembershipsForProject($project_gid, $params = array(), $options = array()) {
        /** Get memberships from a project
         *
         * @param $project_gid string:  (required) Globally unique identifier for the project.
         * @param $params : 
         * @return response
         */
        $path = "/projects/{project_gid}/project_memberships";
        $path = str_replace($path,"{project_gid}", $project_gid);
        return $this->client->get($path, $params, $options);
    }
}
