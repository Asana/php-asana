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

    public function addTaskToSection($section_gid, $params = array(), $options = array()) {
        /** Add task to section
         *
         * @param $section_gid string:  (required) The globally unique identifier for the section.
         * @param $params : 
         * @return response
         */
        $path = "/sections/{section_gid}/addTask";
        $path = str_replace($path,"{section_gid}", $section_gid);
        return $this->client->post($path, $params, $options);
    }

    public function createSectionInProject($project_gid, $params = array(), $options = array()) {
        /** Create a section in a project
         *
         * @param $project_gid string:  (required) Globally unique identifier for the project.
         * @param $params : 
         * @return response
         */
        $path = "/projects/{project_gid}/sections";
        $path = str_replace($path,"{project_gid}", $project_gid);
        return $this->client->post($path, $params, $options);
    }

    public function deleteSection($section_gid, $params = array(), $options = array()) {
        /** Delete a section
         *
         * @param $section_gid string:  (required) The globally unique identifier for the section.
         * @param $params : 
         * @return response
         */
        $path = "/sections/{section_gid}";
        $path = str_replace($path,"{section_gid}", $section_gid);
        return $this->client->delete($path, $params, $options);
    }

    public function getSection($section_gid, $params = array(), $options = array()) {
        /** Get a section
         *
         * @param $section_gid string:  (required) The globally unique identifier for the section.
         * @param $params : 
         * @return response
         */
        $path = "/sections/{section_gid}";
        $path = str_replace($path,"{section_gid}", $section_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getSectionsInProject($project_gid, $params = array(), $options = array()) {
        /** Get sections in a project
         *
         * @param $project_gid string:  (required) Globally unique identifier for the project.
         * @param $params : 
         * @return response
         */
        $path = "/projects/{project_gid}/sections";
        $path = str_replace($path,"{project_gid}", $project_gid);
        return $this->client->get($path, $params, $options);
    }

    public function moveSection($project_gid, $params = array(), $options = array()) {
        /** Move sections
         *
         * @param $project_gid string:  (required) Globally unique identifier for the project.
         * @param $params : 
         * @return response
         */
        $path = "/projects/{project_gid}/sections/insert";
        $path = str_replace($path,"{project_gid}", $project_gid);
        return $this->client->post($path, $params, $options);
    }

    public function updateSection($section_gid, $params = array(), $options = array()) {
        /** Update a section
         *
         * @param $section_gid string:  (required) The globally unique identifier for the section.
         * @param $params : 
         * @return response
         */
        $path = "/sections/{section_gid}";
        $path = str_replace($path,"{section_gid}", $section_gid);
        return $this->client->put($path, $params, $options);
    }
}
