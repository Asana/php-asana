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

    /** Set dependencies for a task
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function addDependenciesForTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/addDependencies";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    /** Set dependents for a task
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function addDependentsForTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/addDependents";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    /** Add followers to a task
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function addFollowersForTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/addFollowers";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    /** Add a project to a task
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function addProjectForTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/addProject";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    /** Add a tag to a task
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function addTagForTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/addTag";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    /** Create a subtask
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function createSubtaskForTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/subtasks";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    /** Create a task
     *
     * @param $params object
     * @return response
     */
    public function createTask($params = array(), $options = array()) {
        $path = "/tasks";
        return $this->client->post($path, $params, $options);
    }

    /** Delete a task
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function deleteTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->delete($path, $params, $options);
    }

    /** Duplicate a task
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function duplicateTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/duplicate";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    /** Get dependencies from a task
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function getDependenciesForTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/dependencies";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get dependents from a task
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function getDependentsForTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/dependents";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get subtasks from a task
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function getSubtasksForTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/subtasks";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get a task
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function getTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->get($path, $params, $options);
    }

    /** Get multiple tasks
     *
     * @param $params object
     * @return response
     */
    public function getTasks($params = array(), $options = array()) {
        $path = "/tasks";
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get tasks from a project
     *
     * @param $project_gid string:  (required) Globally unique identifier for the project.
     * @param $params object
     * @return response
     */
    public function getTasksForProject($project_gid, $params = array(), $options = array()) {
        $path = "/projects/{project_gid}/tasks";
        $path = str_replace($path,"{project_gid}", $project_gid);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get tasks from a section
     *
     * @param $section_gid string:  (required) The globally unique identifier for the section.
     * @param $params object
     * @return response
     */
    public function getTasksForSection($section_gid, $params = array(), $options = array()) {
        $path = "/sections/{section_gid}/tasks";
        $path = str_replace($path,"{section_gid}", $section_gid);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get tasks from a tag
     *
     * @param $tag_gid string:  (required) Globally unique identifier for the tag.
     * @param $params object
     * @return response
     */
    public function getTasksForTag($tag_gid, $params = array(), $options = array()) {
        $path = "/tags/{tag_gid}/tasks";
        $path = str_replace($path,"{tag_gid}", $tag_gid);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get tasks from a user task list
     *
     * @param $user_task_list_gid string:  (required) Globally unique identifier for the user task list.
     * @param $params object
     * @return response
     */
    public function getTasksForUserTaskList($user_task_list_gid, $params = array(), $options = array()) {
        $path = "/user_task_lists/{user_task_list_gid}/tasks";
        $path = str_replace($path,"{user_task_list_gid}", $user_task_list_gid);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Unlink dependencies from a task
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function removeDependenciesForTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/removeDependencies";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    /** Unlink dependents from a task
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function removeDependentsForTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/removeDependents";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    /** Remove followers from a task
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function removeFollowerForTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/removeFollowers";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    /** Remove a project from a task
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function removeProjectForTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/removeProject";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    /** Remove a tag from a task
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function removeTagForTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/removeTag";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    /** Search tasks in a workspace
     *
     * @param $workspace_gid string:  (required) Globally unique identifier for the workspace or organization.
     * @param $params object
     * @return response
     */
    public function searchTasksForWorkspace($workspace_gid, $params = array(), $options = array()) {
        $path = "/workspaces/{workspace_gid}/tasks/search";
        $path = str_replace($path,"{workspace_gid}", $workspace_gid);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Set the parent of a task
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function setParentForTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/setParent";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    /** Update a task
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function updateTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->put($path, $params, $options);
    }
}
