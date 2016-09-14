<?php

namespace Asana\Resources\Gen;

/**
 * The _task_ is the basic object around which many operations in Asana are
 * centered. In the Asana application, multiple tasks populate the middle pane
 * according to some view parameters, and the set of selected tasks determines
 * the more detailed information presented in the details pane.
*/
class TasksBase
{
    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Creating a new task is as easy as POSTing to the `/tasks` endpoint
     * with a data block containing the fields you'd like to set on the task.
     * Any unspecified fields will take on default values.
     * 
     * Every task is required to be created in a specific workspace, and this
     * workspace cannot be changed once set. The workspace need not be set
     * explicitly if you specify `projects` or a `parent` task instead.
     * 
     * `projects` can be a comma separated list of projects, or just a single
     * project the task should belong to.
     *
     * @return response
     */
    public function create($params = array(), $options = array())
    {
        return $this->client->post("/tasks", $params, $options);
    }

    /**
     * Creating a new task is as easy as POSTing to the `/tasks` endpoint
     * with a data block containing the fields you'd like to set on the task.
     * Any unspecified fields will take on default values.
     * 
     * Every task is required to be created in a specific workspace, and this
     * workspace cannot be changed once set. The workspace need not be set
     * explicitly if you specify a `project` or a `parent` task instead.
     *
     * @param  workspace The workspace to create a task in.
     * @return response
     */
    public function createInWorkspace($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s/tasks", $workspace);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Returns the complete task record for a single task.
     *
     * @param  task The task to get.
     * @return response
     */
    public function findById($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s", $task);
        return $this->client->get($path, $params, $options);
    }

    /**
     * A specific, existing task can be updated by making a PUT request on the
     * URL for that task. Only the fields provided in the `data` block will be
     * updated; any unspecified fields will remain unchanged.
     * 
     * When using this method, it is best to specify only those fields you wish
     * to change, or else you may overwrite changes made by another user since
     * you last retrieved the task.
     * 
     * Returns the complete updated task record.
     *
     * @param  task The task to update.
     * @return response
     */
    public function update($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s", $task);
        return $this->client->put($path, $params, $options);
    }

    /**
     * A specific, existing task can be deleted by making a DELETE request on the
     * URL for that task. Deleted tasks go into the "trash" of the user making
     * the delete request. Tasks can be recovered from the trash within a period
     * of 30 days; afterward they are completely removed from the system.
     * 
     * Returns an empty data record.
     *
     * @param  task The task to delete.
     * @return response
     */
    public function delete($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s", $task);
        return $this->client->delete($path, $params, $options);
    }

    /**
     * Returns the compact task records for all tasks within the given project,
     * ordered by their priority within the project.
     *
     * @param  projectId The project in which to search for tasks.
     * @return response
     */
    public function findByProject($projectId, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s/tasks", $projectId);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Returns the compact task records for all tasks with the given tag.
     *
     * @param  tag The tag in which to search for tasks.
     * @return response
     */
    public function findByTag($tag, $params = array(), $options = array())
    {
        $path = sprintf("/tags/%s/tasks", $tag);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Returns the compact task records for some filtered set of tasks. Use one
     * or more of the parameters provided to filter the tasks returned. You must
     * specify a `project` or `tag` if you do not specify `assignee` and `workspace`.
     *
     * @return response
     */
    public function findAll($params = array(), $options = array())
    {
        return $this->client->getCollection("/tasks", $params, $options);
    }

    /**
     * Adds each of the specified followers to the task, if they are not already
     * following. Returns the complete, updated record for the affected task.
     *
     * @param  task The task to add followers to.
     * @return response
     */
    public function addFollowers($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/addFollowers", $task);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Removes each of the specified followers from the task if they are
     * following. Returns the complete, updated record for the affected task.
     *
     * @param  task The task to remove followers from.
     * @return response
     */
    public function removeFollowers($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/removeFollowers", $task);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Returns a compact representation of all of the projects the task is in.
     *
     * @param  task The task to get projects on.
     * @return response
     */
    public function projects($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/projects", $task);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Adds the task to the specified project, in the optional location
     * specified. If no location arguments are given, the task will be added to
     * the beginning of the project.
     * 
     * `addProject` can also be used to reorder a task within a project that
     * already contains it.
     * 
     * Returns an empty data block.
     *
     * @param  task The task to add to a project.
     * @return response
     */
    public function addProject($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/addProject", $task);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Removes the task from the specified project. The task will still exist
     * in the system, but it will not be in the project anymore.
     * 
     * Returns an empty data block.
     *
     * @param  task The task to remove from a project.
     * @return response
     */
    public function removeProject($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/removeProject", $task);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Returns a compact representation of all of the tags the task has.
     *
     * @param  task The task to get tags on.
     * @return response
     */
    public function tags($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/tags", $task);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Adds a tag to a task. Returns an empty data block.
     *
     * @param  task The task to add a tag to.
     * @return response
     */
    public function addTag($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/addTag", $task);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Removes a tag from the task. Returns an empty data block.
     *
     * @param  task The task to remove a tag from.
     * @return response
     */
    public function removeTag($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/removeTag", $task);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Returns a compact representation of all of the subtasks of a task.
     *
     * @param  task The task to get the subtasks of.
     * @return response
     */
    public function subtasks($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/subtasks", $task);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Creates a new subtask and adds it to the parent task. Returns the full record
     * for the newly created subtask.
     *
     * @param  task The task to add a subtask to.
     * @return response
     */
    public function addSubtask($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/subtasks", $task);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Returns a compact representation of all of the stories on the task.
     *
     * @param  task The task containing the stories to get.
     * @return response
     */
    public function stories($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/stories", $task);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Adds a comment to a task. The comment will be authored by the
     * currently authenticated user, and timestamped when the server receives
     * the request.
     * 
     * Returns the full record for the new story added to the task.
     *
     * @param  task Globally unique identifier for the task.
     * @return response
     */
    public function addComment($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/stories", $task);
        return $this->client->post($path, $params, $options);
    }
}
