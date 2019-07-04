<?php

namespace Asana\Resources\Gen;

/**
 * A _project status_ is an update on the progress of a particular project, and is sent out to all project
 * followers when created. These updates include both text describing the update and a color code intended to
 * represent the overall state of the project: "green" for projects that are on track, "yellow" for projects
 * at risk, and "red" for projects that are behind.
 * 
 * Project statuses can be created and deleted, but not modified.
*/
class ProjectStatusesBase
{
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
     * @param  project-status The project status update to delete.
     * @return response
     */
    public function delete($projectStatus, $params = array(), $options = array())
    {
        $path = sprintf("/project_statuses/%s", $projectStatus);
        return $this->client->delete($path, $params, $options);
    }
}
