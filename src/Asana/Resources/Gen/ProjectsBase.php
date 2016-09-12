<?php

namespace Asana\Resources\Gen;

/**
 * A _project_ represents a prioritized list of tasks in Asana. It exists in a
 * single workspace or organization and is accessible to a subset of users in
 * that workspace or organization, depending on its permissions.
 * 
 * Projects in organizations are shared with a single team. You cannot currently
 * change the team of a project via the API. Non-organization workspaces do not
 * have teams and so you should not specify the team of project in a
 * regular workspace.
*/
class ProjectsBase
{
    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Creates a new project in a workspace or team.
     * 
     * Every project is required to be created in a specific workspace or
     * organization, and this cannot be changed once set. Note that you can use
     * the `workspace` parameter regardless of whether or not it is an
     * organization.
     * 
     * If the workspace for your project _is_ an organization, you must also
     * supply a `team` to share the project with.
     * 
     * Returns the full record of the newly created project.
     *
     * @return response
     */
    public function create($params = array(), $options = array())
    {
        return $this->client->post("/projects", $params, $options);
    }

    /**
     * If the workspace for your project _is_ an organization, you must also
     * supply a `team` to share the project with.
     * 
     * Returns the full record of the newly created project.
     *
     * @param  workspace The workspace or organization to create the project in.
     * @return response
     */
    public function createInWorkspace($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s/projects", $workspace);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Creates a project shared with the given team.
     * 
     * Returns the full record of the newly created project.
     *
     * @param  team The team to create the project in.
     * @return response
     */
    public function createInTeam($team, $params = array(), $options = array())
    {
        $path = sprintf("/teams/%s/projects", $team);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Returns the complete project record for a single project.
     *
     * @param  project The project to get.
     * @return response
     */
    public function findById($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s", $project);
        return $this->client->get($path, $params, $options);
    }

    /**
     * A specific, existing project can be updated by making a PUT request on the
     * URL for that project. Only the fields provided in the `data` block will be
     * updated; any unspecified fields will remain unchanged.
     * 
     * When using this method, it is best to specify only those fields you wish
     * to change, or else you may overwrite changes made by another user since
     * you last retrieved the task.
     * 
     * Returns the complete updated project record.
     *
     * @param  project The project to update.
     * @return response
     */
    public function update($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s", $project);
        return $this->client->put($path, $params, $options);
    }

    /**
     * A specific, existing project can be deleted by making a DELETE request
     * on the URL for that project.
     * 
     * Returns an empty data record.
     *
     * @param  project The project to delete.
     * @return response
     */
    public function delete($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s", $project);
        return $this->client->delete($path, $params, $options);
    }

    /**
     * Returns the compact project records for some filtered set of projects.
     * Use one or more of the parameters provided to filter the projects returned.
     *
     * @return response
     */
    public function findAll($params = array(), $options = array())
    {
        return $this->client->getCollection("/projects", $params, $options);
    }

    /**
     * Returns the compact project records for all projects in the workspace.
     *
     * @param  workspace The workspace or organization to find projects in.
     * @return response
     */
    public function findByWorkspace($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s/projects", $workspace);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Returns the compact project records for all projects in the team.
     *
     * @param  team The team to find projects in.
     * @return response
     */
    public function findByTeam($team, $params = array(), $options = array())
    {
        $path = sprintf("/teams/%s/projects", $team);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Returns compact records for all sections in the specified project.
     *
     * @param  project The project to get sections from.
     * @return response
     */
    public function sections($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s/sections", $project);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Returns the compact task records for all tasks within the given project,
     * ordered by their priority within the project. Tasks can exist in more than one project at a time.
     *
     * @param  project The project in which to search for tasks.
     * @return response
     */
    public function tasks($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s/tasks", $project);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Adds the specified list of users as followers to the project. Followers are a subset of members, therefore if
     * the users are not already members of the project they will also become members as a result of this operation.
     * Returns the updated project record.
     *
     * @param  project The project to add followers to.
     * @return response
     */
    public function addFollowers($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s/addFollowers", $project);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Removes the specified list of users from following the project, this will not affect project membership status.
     * Returns the updated project record.
     *
     * @param  project The project to remove followers from.
     * @return response
     */
    public function removeFollowers($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s/removeFollowers", $project);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Adds the specified list of users as members of the project. Returns the updated project record.
     *
     * @param  project The project to add members to.
     * @return response
     */
    public function addMembers($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s/addMembers", $project);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Removes the specified list of members from the project. Returns the updated project record.
     *
     * @param  project The project to remove members from.
     * @return response
     */
    public function removeMembers($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s/removeMembers", $project);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Create a new custom field setting on the project.
     *
     * @param  project The project to associate the custom field with
     * @return response
     */
    public function addCustomFieldSetting($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s/addCustomFieldSetting", $project);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Remove a custom field setting on the project.
     *
     * @param  project The project to associate the custom field with
     * @return response
     */
    public function removeCustomFieldSetting($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s/removeCustomFieldSetting", $project);
        return $this->client->post($path, $params, $options);
    }
}
