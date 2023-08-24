<?php

namespace Asana\Resources;

use Asana\Resources\Gen\WorkspacesBase;

#[\AllowDynamicProperties]
class Workspaces extends WorkspacesBase
{
    /**
     * Returns the full workspace record for a single workspace.
     *
     * @deprecated replace with getWorkspace
     *
     * @param  workspace Globally unique identifier for the workspace or organization.
     * @return response
     */
    public function findById($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s", $workspace);
        return $this->client->get($path, $params, $options);
    }

    /**
     * Returns the compact records for all workspaces visible to the authorized user.
     *
     * @deprecated replace with getWorkspaces
     *
     * @return response
     */
    public function findAll($params = array(), $options = array())
    {
        return $this->client->getCollection("/workspaces", $params, $options);
    }

    /**
     * A specific, existing workspace can be updated by making a PUT request on
     * the URL for that workspace. Only the fields provided in the data block
     * will be updated; any unspecified fields will remain unchanged.
     *
     * Currently the only field that can be modified for a workspace is its `name`.
     *
     * Returns the complete, updated workspace record.
     *
     * @deprecated replace with updateWorkspace
     *
     * @param  workspace The workspace to update.
     * @return response
     */
    public function update($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s", $workspace);
        return $this->client->put($path, $params, $options);
    }

    /**
     * Retrieves objects in the workspace based on an auto-completion/typeahead
     * search algorithm. This feature is meant to provide results quickly, so do
     * not rely on this API to provide extremely accurate search results. The
     * result set is limited to a single page of results with a maximum size,
     * so you won't be able to fetch large numbers of results.
     *
     * @deprecated replace with Typeahead.typeahead
     *
     * @param  workspace The workspace to fetch objects from.
     * @return response
     */
    public function typeahead($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s/typeahead", $workspace);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * The user can be referenced by their globally unique user ID or their email address.
     * Returns the full user record for the invited user.
     *
     * @deprecated replace with addUserForWorkspace
     *
     * @param  workspace The workspace or organization to invite the user to.
     * @return response
     */
    public function addUser($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s/addUser", $workspace);
        return $this->client->post($path, $params, $options);
    }

    /**
     * The user making this call must be an admin in the workspace.
     * Returns an empty data record.
     *
     * @deprecated replace with removeUserForWorkspace
     *
     * @param  workspace The workspace or organization to invite the user to.
     * @return response
     */
    public function removeUser($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s/removeUser", $workspace);
        return $this->client->post($path, $params, $options);
    }
}
