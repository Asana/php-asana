<?php

namespace Asana\Resources\Gen;

class ProjectTemplatesBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Get a project template
     *
     * @param string $project_template_gid  (required) Globally unique identifier for the project template.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getProjectTemplate($project_template_gid, $params = array(), $options = array()) {
        $path = "/project_templates/{project_template_gid}";
        $path = str_replace("{project_template_gid}", $project_template_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Get multiple project templates
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getProjectTemplates($params = array(), $options = array()) {
        $path = "/project_templates";
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get a team's project templates
     *
     * @param string $team_gid  (required) Globally unique identifier for the team.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getProjectTemplatesForTeam($team_gid, $params = array(), $options = array()) {
        $path = "/teams/{team_gid}/project_templates";
        $path = str_replace("{team_gid}", $team_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Instantiate a project from a project template
     *
     * @param string $project_template_gid  (required) Globally unique identifier for the project template.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function instantiateProject($project_template_gid, $params = array(), $options = array()) {
        $path = "/project_templates/{project_template_gid}/instantiateProject";
        $path = str_replace("{project_template_gid}", $project_template_gid, $path);
        return $this->client->post($path, $params, $options);
    }
}
