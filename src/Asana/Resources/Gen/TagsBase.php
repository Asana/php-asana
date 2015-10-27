<?php

namespace Asana\Resources\Gen;

/**
 * A _tag_ is a label that can be attached to any task in Asana. It exists in a
 * single workspace or organization.
 * 
 * Tags have some metadata associated with them, but it is possible that we will
 * simplify them in the future so it is not encouraged to rely too heavily on it.
 * Unlike projects, tags do not provide any ordering on the tasks they
 * are associated with.
*/
class TagsBase
{
    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Creates a new tag in a workspace or organization.
     * 
     * Every tag is required to be created in a specific workspace or
     * organization, and this cannot be changed once set. Note that you can use
     * the `workspace` parameter regardless of whether or not it is an
     * organization.
     * 
     * Returns the full record of the newly created tag.
     *
     * @return response
     */
    public function create($params = array(), $options = array())
    {
        return $this->client->post("/tags", $params, $options);
    }

    /**
     * Creates a new tag in a workspace or organization.
     * 
     * Every tag is required to be created in a specific workspace or
     * organization, and this cannot be changed once set. Note that you can use
     * the `workspace` parameter regardless of whether or not it is an
     * organization.
     * 
     * Returns the full record of the newly created tag.
     *
     * @param  workspace The workspace or organization to create the tag in.
     * @return response
     */
    public function createInWorkspace($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s/tags", $workspace);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Returns the complete tag record for a single tag.
     *
     * @param  tag The tag to get.
     * @return response
     */
    public function findById($tag, $params = array(), $options = array())
    {
        $path = sprintf("/tags/%s", $tag);
        return $this->client->get($path, $params, $options);
    }

    /**
     * Updates the properties of a tag. Only the fields provided in the `data`
     * block will be updated; any unspecified fields will remain unchanged.
     * 
     * When using this method, it is best to specify only those fields you wish
     * to change, or else you may overwrite changes made by another user since
     * you last retrieved the task.
     * 
     * Returns the complete updated tag record.
     *
     * @param  tag The tag to update.
     * @return response
     */
    public function update($tag, $params = array(), $options = array())
    {
        $path = sprintf("/tags/%s", $tag);
        return $this->client->put($path, $params, $options);
    }

    /**
     * A specific, existing tag can be deleted by making a DELETE request
     * on the URL for that tag.
     * 
     * Returns an empty data record.
     *
     * @param  tag The tag to delete.
     * @return response
     */
    public function delete($tag, $params = array(), $options = array())
    {
        $path = sprintf("/tags/%s", $tag);
        return $this->client->delete($path, $params, $options);
    }

    /**
     * Returns the compact tag records for some filtered set of tags.
     * Use one or more of the parameters provided to filter the tags returned.
     *
     * @return response
     */
    public function findAll($params = array(), $options = array())
    {
        return $this->client->getCollection("/tags", $params, $options);
    }

    /**
     * Returns the compact tag records for all tags in the workspace.
     *
     * @param  workspace The workspace or organization to find tags in.
     * @return response
     */
    public function findByWorkspace($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s/tags", $workspace);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Returns the compact task records for all tasks with the given tag.
     * Tasks can have more than one tag at a time.
     *
     * @param  tag The tag to fetch tasks from.
     * @return response
     */
    public function getTasksWithTag($tag, $params = array(), $options = array())
    {
        $path = sprintf("/tags/%s/tasks", $tag);
        return $this->client->getCollection($path, $params, $options);
    }
}