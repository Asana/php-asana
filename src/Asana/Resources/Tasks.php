<?php

namespace Asana\Resources;

use Asana\Resources\Gen\TasksBase;

#[\AllowDynamicProperties]
class Tasks extends TasksBase
{
    public function search($workspace, $params = array(), $options = array())
    {
        return $this->searchInWorkspace($workspace, $params, $options);
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
     * @deprecated replace with createTask
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
     * @deprecated replace with createTaskForWorkspace
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
     * @deprecated replace with getTask
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
     * @deprecated replace with updateTask
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
     * @deprecated replace with deleteTask
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
     * @deprecated replace with getTasksForProject
     *
     * @param  project The project in which to search for tasks.
     * @return response
     */
    public function findByProject($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s/tasks", $project);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Returns the compact task records for all tasks with the given tag.
     *
     * @deprecated replace with getTasksForTag
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
     * <b>Board view only:</b> Returns the compact section records for all tasks within the given section.
     *
     * @deprecated replace with getTasksForSection
     *
     * @param  section The section in which to search for tasks.
     * @return response
     */
    public function findBySection($section, $params = array(), $options = array())
    {
        $path = sprintf("/sections/%s/tasks", $section);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Returns the compact list of tasks in a user's My Tasks list. The returned
     * tasks will be in order within each assignee status group of `Inbox`,
     * `Today`, and `Upcoming`.
     *
     * **Note:** tasks in `Later` have a different ordering in the Asana web app
     * than the other assignee status groups; this endpoint will still return
     * them in list order in `Later` (differently than they show up in Asana,
     * but the same order as in Asana's mobile apps).
     *
     * **Note:** Access control is enforced for this endpoint as with all Asana
     * API endpoints, meaning a user's private tasks will be filtered out if the
     * API-authenticated user does not have access to them.
     *
     * **Note:** Both complete and incomplete tasks are returned by default
     * unless they are filtered out (for example, setting `completed_since=now`
     * will return only incomplete tasks, which is the default view for "My
     * Tasks" in Asana.)
     *
     * @deprecated replace with getTasksForUserTaskList
     *
     * @param  user_task_list The user task list in which to search for tasks.
     * @return response
     */
    public function findByUserTaskList($userTaskList, $params = array(), $options = array())
    {
        $path = sprintf("/user_task_lists/%s/tasks", $userTaskList);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Returns the compact task records for some filtered set of tasks. Use one
     * or more of the parameters provided to filter the tasks returned. You must
     * specify a `project`, `section`, `tag`, or `user_task_list` if you do not
     * specify `assignee` and `workspace`.
     *
     * @deprecated replace with getTasks
     *
     * @return response
     */
    public function findAll($params = array(), $options = array())
    {
        return $this->client->getCollection("/tasks", $params, $options);
    }

    /**
     * The search endpoint allows you to build complex queries to find and fetch exactly the data you need from Asana. For a more comprehensive description of all the query parameters and limitations of this endpoint, see our [long-form documentation](/developers/documentation/getting-started/search-api) for this feature.
     *
     * @deprecated replace with searchTasksForWorkspace
     *
     * @param  workspace The workspace or organization in which to search for tasks.
     * @return response
     */
    public function searchInWorkspace($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s/tasks/search", $workspace);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Returns the compact representations of all of the dependencies of a task.
     *
     * @deprecated replace with getDependenciesForTask
     *
     * @param  task The task to get dependencies on.
     * @return response
     */
    public function dependencies($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/dependencies", $task);
        return $this->client->get($path, $params, $options);
    }

    /**
     * Returns the compact representations of all of the dependents of a task.
     *
     * @deprecated replace with getDependentsForTask
     *
     * @param  task The task to get dependents on.
     * @return response
     */
    public function dependents($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/dependents", $task);
        return $this->client->get($path, $params, $options);
    }

    /**
     * Marks a set of tasks as dependencies of this task, if they are not
     * already dependencies. *A task can have at most 15 dependencies.*
     *
     * @deprecated replace with addDependenciesForTask
     *
     * @param  task The task to add dependencies to.
     * @return response
     */
    public function addDependencies($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/addDependencies", $task);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Marks a set of tasks as dependents of this task, if they are not already
     * dependents. *A task can have at most 30 dependents.*
     *
     * @deprecated replace with addDependentsForTask
     *
     * @param  task The task to add dependents to.
     * @return response
     */
    public function addDependents($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/addDependents", $task);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Unlinks a set of dependencies from this task.
     *
     * @deprecated replace with removeDependenciesForTask
     *
     * @param  task The task to remove dependencies from.
     * @return response
     */
    public function removeDependencies($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/removeDependencies", $task);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Unlinks a set of dependents from this task.
     *
     * @deprecated replace with removeDependentsForTask
     *
     * @param  task The task to remove dependents from.
     * @return response
     */
    public function removeDependents($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/removeDependents", $task);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Adds each of the specified followers to the task, if they are not already
     * following. Returns the complete, updated record for the affected task.
     *
     * @deprecated replace with addFollowersForTask
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
     * @deprecated replace with removeFollowersForTask
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
     * @deprecated replace with Tasks.getProjectsForTask
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
     * the end of the project.
     *
     * `addProject` can also be used to reorder a task within a project or section that
     * already contains it.
     *
     * At most one of `insert_before`, `insert_after`, or `section` should be
     * specified. Inserting into a section in an non-order-dependent way can be
     * done by specifying `section`, otherwise, to insert within a section in a
     * particular place, specify `insert_before` or `insert_after` and a task
     * within the section to anchor the position of this task.
     *
     * Returns an empty data block.
     *
     * @deprecated replace with addProjectForTask
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
     * @deprecated replace with removeProjectForTask
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
     * @deprecated replace with Tags.getTagsForTask
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
     * @deprecated replace with addTagForTask
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
     * @deprecated replace with removeTagForTask
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
     * @deprecated replace with getSubtasksForTask
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
     * @deprecated replace with createSubtaskForTask
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
     * @deprecated replace with Stories.createStoryForTask
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
     * @deprecated replace with Stories.createStoryForTask
     *
     * @param  task Globally unique identifier for the task.
     * @return response
     */
    public function addComment($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/stories", $task);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Insert or reorder tasks in a user's My Tasks list. If the task was not
     * assigned to the owner of the user task list it will be reassigned when
     * this endpoint is called. If neither `insert_before` nor `insert_after`
     * are provided the task will be inserted at the top of the assignee's
     * inbox.
     *
     * Returns an empty data block.
     *
     * @param  user_task_list Globally unique identifier for the user task list.
     * @return response
     */
    public function insertInUserTaskList($userTaskList, $params = array(), $options = array())
    {
        $path = sprintf("/user_task_lists/%s/tasks/insert", $userTaskList);
        return $this->client->post($path, $params, $options);
    }
}
