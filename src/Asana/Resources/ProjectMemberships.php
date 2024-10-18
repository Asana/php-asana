<?php

namespace Asana\Resources;

use Asana\Resources\Gen\ProjectMembershipsBase;

#[\AllowDynamicProperties]
class ProjectMemberships extends ProjectMembershipsBase
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
     * @deprecated replace with getProjectMembershipsForProject
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
     * @deprecated replace with getProjectMembership
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
