<?php

namespace Asana\Resources\Gen;

class ProjectStatusesBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Create a project status
     *
     * @param string $project_gid  (required) Globally unique identifier for the project.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function createProjectStatusForProject($project_gid, $params = array(), $options = array()) {
        $path = "/projects/{project_gid}/project_statuses";
        $path = str_replace($path,"{project_gid}", $project_gid);
        return $this->client->post($path, $params, $options);
    }

    /** Delete a project status
     *
     * @param string $project_status_path_gid  (required) The project status update to get.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function deleteProjectStatus($project_status_path_gid, $params = array(), $options = array()) {
        $path = "/project_statuses/{project_status_gid}";
        $path = str_replace($path,"{project_status_path_gid}", $project_status_path_gid);
        return $this->client->delete($path, $params, $options);
    }

    /** Get a project status
     *
     * @param string $project_status_path_gid  (required) The project status update to get.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getProjectStatus($project_status_path_gid, $params = array(), $options = array()) {
        $path = "/project_statuses/{project_status_gid}";
        $path = str_replace($path,"{project_status_path_gid}", $project_status_path_gid);
        return $this->client->get($path, $params, $options);
    }

    /** Get statuses from a project
     *
     * @param string $project_gid  (required) Globally unique identifier for the project.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getProjectStatusesForProject($project_gid, $params = array(), $options = array()) {
        $path = "/projects/{project_gid}/project_statuses";
        $path = str_replace($path,"{project_gid}", $project_gid);
        return $this->client->getCollection($path, $params, $options);
    }
}
