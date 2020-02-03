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

    /** Get a project membership
     *
     * @param string $project_membership_gid  (required)
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getProjectMembership($project_membership_gid, $params = array(), $options = array()) {
        $path = "/project_memberships/{project_membership_gid}";
        $path = str_replace("{project_membership_gid}", $project_membership_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Get memberships from a project
     *
     * @param string $project_gid  (required) Globally unique identifier for the project.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getProjectMembershipsForProject($project_gid, $params = array(), $options = array()) {
        $path = "/projects/{project_gid}/project_memberships";
        $path = str_replace("{project_gid}", $project_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }
}
