<?php

namespace Asana\Resources\Gen;

/**
 * With the introduction of "comment-only" projects in Asana, a user's membership
 * in a project comes with associated permissions. These permissions (whether a
 * user has full access to the project or comment-only access) are accessible
 * through the project memberships endpoints described here.
*/
class ProjectMembershipsBase
{
    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Returns the compact project membership records for the project.
     *
     * @param  project The project for which to fetch memberships.
     * @return response
     */
    public function findByProject($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s/project_memberships", $project);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Returns the project membership record.
     *
     * @param  project_membership Globally unique identifier for the project membership.
     * @return response
     */
    public function findById($projectMembership, $params = array(), $options = array())
    {
        $path = sprintf("/project_memberships/%s", $projectMembership);
        return $this->client->get($path, $params, $options);
    }
}
