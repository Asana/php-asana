<?php

namespace Asana\Resources\Gen;

class ProjectBriefsBase {

    public $client;

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Create a project brief
     *
     * @param string $project_gid  (required) Globally unique identifier for the project.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function createProjectBrief($project_gid, $params = array(), $options = array()) {
        $path = "/projects/{project_gid}/project_briefs";
        $path = str_replace("{project_gid}", $project_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Delete a project brief
     *
     * @param string $project_brief_gid  (required) Globally unique identifier for the project brief.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function deleteProjectBrief($project_brief_gid, $params = array(), $options = array()) {
        $path = "/project_briefs/{project_brief_gid}";
        $path = str_replace("{project_brief_gid}", $project_brief_gid, $path);
        return $this->client->delete($path, $params, $options);
    }

    /** Get a project brief
     *
     * @param string $project_brief_gid  (required) Globally unique identifier for the project brief.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getProjectBrief($project_brief_gid, $params = array(), $options = array()) {
        $path = "/project_briefs/{project_brief_gid}";
        $path = str_replace("{project_brief_gid}", $project_brief_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Update a project brief
     *
     * @param string $project_brief_gid  (required) Globally unique identifier for the project brief.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function updateProjectBrief($project_brief_gid, $params = array(), $options = array()) {
        $path = "/project_briefs/{project_brief_gid}";
        $path = str_replace("{project_brief_gid}", $project_brief_gid, $path);
        return $this->client->put($path, $params, $options);
    }
}
