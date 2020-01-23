<?php

namespace Asana\Resources\Gen;

class TasksBase {

    /**
    * @param Asana/Client client  The client instance
    */
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function addFollowerToTask($task_gid, $params = array(), $options = array()) {
        /** Add followers to a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/addFollowers";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    public function addProjectToTask($task_gid, $params = array(), $options = array()) {
        /** Add a project to a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/addProject";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    public function addTagToTask($task_gid, $params = array(), $options = array()) {
        /** Add a tag to a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/addTag";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    public function addTaskDependencies($task_gid, $params = array(), $options = array()) {
        /** Set dependencies for a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/addDependencies";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    public function addTaskDependents($task_gid, $params = array(), $options = array()) {
        /** Set dependents for a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/addDependents";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    public function changeSubtaskParent($task_gid, $params = array(), $options = array()) {
        /** Change the parent of a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/setParent";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    public function createSubtask($task_gid, $params = array(), $options = array()) {
        /** Create a subtask
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/subtasks";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    public function createTask($params = array(), $options = array()) {
        /** Create a task
         *
         * @param $params : 
         * @return response
         */
        $path = "/tasks";
        return $this->client->post($path, $params, $options);
    }

    public function deleteTask($task_gid, $params = array(), $options = array()) {
        /** Delete a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->delete($path, $params, $options);
    }

    public function duplicateTask($task_gid, $params = array(), $options = array()) {
        /** Duplicate a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/duplicate";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    public function getProjectTasks($project_gid, $params = array(), $options = array()) {
        /** Get tasks from a project
         *
         * @param $project_gid string:  (required) Globally unique identifier for the project.
         * @param $params : 
         * @return response
         */
        $path = "/projects/{project_gid}/tasks";
        $path = str_replace($path,"{project_gid}", $project_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getSectionTasks($section_gid, $params = array(), $options = array()) {
        /** Get tasks from a section
         *
         * @param $section_gid string:  (required) The globally unique identifier for the section.
         * @param $params : 
         * @return response
         */
        $path = "/sections/{section_gid}/tasks";
        $path = str_replace($path,"{section_gid}", $section_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getSubTasks($task_gid, $params = array(), $options = array()) {
        /** Get subtasks from a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/subtasks";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getTagTasks($tag_gid, $params = array(), $options = array()) {
        /** Get tasks from a tag
         *
         * @param $tag_gid string:  (required) Globally unique identifier for the tag.
         * @param $params : 
         * @return response
         */
        $path = "/tags/{tag_gid}/tasks";
        $path = str_replace($path,"{tag_gid}", $tag_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getTask($task_gid, $params = array(), $options = array()) {
        /** Get a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getTaskDependencies($task_gid, $params = array(), $options = array()) {
        /** Get dependencies from a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/dependencies";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getTaskDependents($task_gid, $params = array(), $options = array()) {
        /** Get dependents from a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/dependents";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getWorkspaceTasksSearch($workspace_gid, $params = array(), $options = array()) {
        /** Search tasks in a workspace
         *
         * @param $workspace_gid string:  (required) Globally unique identifier for the workspace or organization.
         * @param $params : 
         * @return response
         */
        $path = "/workspaces/{workspace_gid}/tasks/search";
        $path = str_replace($path,"{workspace_gid}", $workspace_gid);
        return $this->client->get($path, $params, $options);
    }

    public function queryTasks($params = array(), $options = array()) {
        /** Get multiple tasks
         *
         * @param $params : 
         * @return response
         */
        $path = "/tasks";
        return $this->client->get($path, $params, $options);
    }

    public function removeFollowerToTask($task_gid, $params = array(), $options = array()) {
        /** Remove followers from a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/removeFollowers";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    public function removeProjectFromTask($task_gid, $params = array(), $options = array()) {
        /** Remove a project from a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/removeProject";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    public function removeTagFromTask($task_gid, $params = array(), $options = array()) {
        /** Remove a tag from a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/removeTag";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    public function removeTaskDependencies($task_gid, $params = array(), $options = array()) {
        /** Unlink dependencies from a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/removeDependencies";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    public function removeTaskDependents($task_gid, $params = array(), $options = array()) {
        /** Unlink dependents from a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/removeDependents";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    public function updateTask($task_gid, $params = array(), $options = array()) {
        /** Update a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->put($path, $params, $options);
    }
}
