<?php

namespace Asana\Resources\Gen;

class ProjectsBase {

    /**
    * @param Asana/Client client  The client instance
    */
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function createProject($params = array(), $options = array()) {
        /** Create a project
         *
         * @param $params : 
         * @return response
         */
        $path = "/projects";
        return $this->client->post($path, $params, $options);
    }

    public function createProjectsInWorkspace($workspace_gid, $params = array(), $options = array()) {
        /** Create a project in a workspace
         *
         * @param $workspace_gid string:  (required) Globally unique identifier for the workspace or organization.
         * @param $params : 
         * @return response
         */
        $path = "/workspaces/{workspace_gid}/projects";
        $path = str_replace($path,"{workspace_gid}", $workspace_gid);
        return $this->client->post($path, $params, $options);
    }

    public function createProjectsWithTeam($team_gid, $params = array(), $options = array()) {
        /** Create a project in a team
         *
         * @param $team_gid string:  (required) Globally unique identifier for the team.
         * @param $params : 
         * @return response
         */
        $path = "/teams/{team_gid}/projects";
        $path = str_replace($path,"{team_gid}", $team_gid);
        return $this->client->post($path, $params, $options);
    }

    public function deleteProject($project_gid, $params = array(), $options = array()) {
        /** Delete a project
         *
         * @param $project_gid string:  (required) Globally unique identifier for the project.
         * @param $params : 
         * @return response
         */
        $path = "/projects/{project_gid}";
        $path = str_replace($path,"{project_gid}", $project_gid);
        return $this->client->delete($path, $params, $options);
    }

    public function duplicateProject($project_gid, $params = array(), $options = array()) {
        /** Duplicate a project
         *
         * @param $project_gid string:  (required) Globally unique identifier for the project.
         * @param $params : 
         * @return response
         */
        $path = "/projects/{project_gid}/duplicate";
        $path = str_replace($path,"{project_gid}", $project_gid);
        return $this->client->post($path, $params, $options);
    }

    public function getProject($project_gid, $params = array(), $options = array()) {
        /** Get a project
         *
         * @param $project_gid string:  (required) Globally unique identifier for the project.
         * @param $params : 
         * @return response
         */
        $path = "/projects/{project_gid}";
        $path = str_replace($path,"{project_gid}", $project_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getProjectTaskCounts($project_gid, $params = array(), $options = array()) {
        /** Get task count of a project
         *
         * @param $project_gid string:  (required) Globally unique identifier for the project.
         * @param $params : 
         * @return response
         */
        $path = "/projects/{project_gid}/task_counts";
        $path = str_replace($path,"{project_gid}", $project_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getProjects($params = array(), $options = array()) {
        /** Get multiple projects
         *
         * @param $params : 
         * @return response
         */
        $path = "/projects";
        return $this->client->get($path, $params, $options);
    }

    public function getProjectsInTeam($team_gid, $params = array(), $options = array()) {
        /** Get a team's projects
         *
         * @param $team_gid string:  (required) Globally unique identifier for the team.
         * @param $params : 
         * @return response
         */
        $path = "/teams/{team_gid}/projects";
        $path = str_replace($path,"{team_gid}", $team_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getProjectsInWorkspace($workspace_gid, $params = array(), $options = array()) {
        /** Get all projects in a workspace
         *
         * @param $workspace_gid string:  (required) Globally unique identifier for the workspace or organization.
         * @param $params : 
         * @return response
         */
        $path = "/workspaces/{workspace_gid}/projects";
        $path = str_replace($path,"{workspace_gid}", $workspace_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getTaskProjects($task_gid, $params = array(), $options = array()) {
        /** Get projects a task is in
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/projects";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->get($path, $params, $options);
    }

    public function projectAddCustomFieldSetting($project_gid, $params = array(), $options = array()) {
        /** Add a custom field to a project
         *
         * @param $project_gid string:  (required) Globally unique identifier for the project.
         * @param $params : 
         * @return response
         */
        $path = "/projects/{project_gid}/addCustomFieldSetting";
        $path = str_replace($path,"{project_gid}", $project_gid);
        return $this->client->post($path, $params, $options);
    }

    public function projectRemoveCustomFieldSetting($project_gid, $params = array(), $options = array()) {
        /** Remove a custom field from a project
         *
         * @param $project_gid string:  (required) Globally unique identifier for the project.
         * @param $params : 
         * @return response
         */
        $path = "/projects/{project_gid}/removeCustomFieldSetting";
        $path = str_replace($path,"{project_gid}", $project_gid);
        return $this->client->post($path, $params, $options);
    }

    public function updateProject($project_gid, $params = array(), $options = array()) {
        /** Update a project
         *
         * @param $project_gid string:  (required) Globally unique identifier for the project.
         * @param $params : 
         * @return response
         */
        $path = "/projects/{project_gid}";
        $path = str_replace($path,"{project_gid}", $project_gid);
        return $this->client->put($path, $params, $options);
    }
}
