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

    public function createProjectStatus($project_gid, $params = array(), $options = array()) {
        /** Create a project status
         *
         * @param $project_gid string:  (required) Globally unique identifier for the project.
         * @param $params : 
         * @return response
         */
        $path = "/projects/{project_gid}/project_statuses";
        $path = str_replace($path,"{project_gid}", $project_gid);
        return $this->client->post($path, $params, $options);
    }

    public function deleteProductStatus($project_status_path_gid, $params = array(), $options = array()) {
        /** Delete a project status
         *
         * @param $project_status_path_gid string:  (required) The project status update to get.
         * @param $params : 
         * @return response
         */
        $path = "/project_statuses/{project_status_gid}";
        $path = str_replace($path,"{project_status_path_gid}", $project_status_path_gid);
        return $this->client->delete($path, $params, $options);
    }

    public function getProductStatus($project_status_path_gid, $params = array(), $options = array()) {
        /** Get a project status
         *
         * @param $project_status_path_gid string:  (required) The project status update to get.
         * @param $params : 
         * @return response
         */
        $path = "/project_statuses/{project_status_gid}";
        $path = str_replace($path,"{project_status_path_gid}", $project_status_path_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getProductStatuses($project_gid, $params = array(), $options = array()) {
        /** Get statuses from a project
         *
         * @param $project_gid string:  (required) Globally unique identifier for the project.
         * @param $params : 
         * @return response
         */
        $path = "/projects/{project_gid}/project_statuses";
        $path = str_replace($path,"{project_gid}", $project_gid);
        return $this->client->get($path, $params, $options);
    }
}
