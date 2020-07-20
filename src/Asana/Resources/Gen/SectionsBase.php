<?php

namespace Asana\Resources\Gen;

class SectionsBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Add task to section
     *
     * @param string $section_gid  (required) The globally unique identifier for the section.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function addTaskForSection($section_gid, $params = array(), $options = array()) {
        $path = "/sections/{section_gid}/addTask";
        $path = str_replace("{section_gid}", $section_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Create a section in a project
     *
     * @param string $project_gid  (required) Globally unique identifier for the project.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function createSectionForProject($project_gid, $params = array(), $options = array()) {
        $path = "/projects/{project_gid}/sections";
        $path = str_replace("{project_gid}", $project_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Delete a section
     *
     * @param string $section_gid  (required) The globally unique identifier for the section.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function deleteSection($section_gid, $params = array(), $options = array()) {
        $path = "/sections/{section_gid}";
        $path = str_replace("{section_gid}", $section_gid, $path);
        return $this->client->delete($path, $params, $options);
    }

    /** Get a section
     *
     * @param string $section_gid  (required) The globally unique identifier for the section.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getSection($section_gid, $params = array(), $options = array()) {
        $path = "/sections/{section_gid}";
        $path = str_replace("{section_gid}", $section_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Get sections in a project
     *
     * @param string $project_gid  (required) Globally unique identifier for the project.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getSectionsForProject($project_gid, $params = array(), $options = array()) {
        $path = "/projects/{project_gid}/sections";
        $path = str_replace("{project_gid}", $project_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Move or Insert sections
     *
     * @param string $project_gid  (required) Globally unique identifier for the project.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function insertSectionForProject($project_gid, $params = array(), $options = array()) {
        $path = "/projects/{project_gid}/sections/insert";
        $path = str_replace("{project_gid}", $project_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Update a section
     *
     * @param string $section_gid  (required) The globally unique identifier for the section.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function updateSection($section_gid, $params = array(), $options = array()) {
        $path = "/sections/{section_gid}";
        $path = str_replace("{section_gid}", $section_gid, $path);
        return $this->client->put($path, $params, $options);
    }
}
