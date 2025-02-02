<?php

namespace Asana\Resources;

use Asana\Resources\Gen\ProjectStatusesBase;

#[\AllowDynamicProperties]
class ProjectStatuses extends ProjectStatusesBase
{
    public function create($project, $params = array(), $options = array())
    {
        return $this->createInProject($project, $params, $options);
    }

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Creates a new status update on the project.
     *
     * Returns the full record of the newly created project status update.
     *
     * @deprecated replace with createProjectStatusForProject
     *
     * @param  project The project on which to create a status update.
     * @return response
     */
    public function createInProject($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s/project_statuses", $project);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Returns the compact project status update records for all updates on the project.
     *
     * @deprecated replace with getProjectStatusesForProject
     *
     * @param  project The project to find status updates for.
     * @return response
     */
    public function findByProject($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s/project_statuses", $project);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Returns the complete record for a single status update.
     *
     * @deprecated replace with getProjectStatus
     *
     * @param  project-status The project status update to get.
     * @return response
     */
    public function findById($projectStatus, $params = array(), $options = array())
    {
        $path = sprintf("/project_statuses/%s", $projectStatus);
        return $this->client->get($path, $params, $options);
    }

    /**
     * Deletes a specific, existing project status update.
     *
     * Returns an empty data record.
     *
     * @deprecated replace with deleteProjectStatus
     *
     * @param  project-status The project status update to delete.
     * @return response
     */
    public function delete($projectStatus, $params = array(), $options = array())
    {
        $path = sprintf("/project_statuses/%s", $projectStatus);
        return $this->client->delete($path, $params, $options);
    }
}
