<?php

namespace Asana\Resources\Gen;

/**
 * A _workspace_ is the highest-level organizational unit in Asana. All projects
 * and tasks have an associated workspace.
 * 
 * An _organization_ is a special kind of workspace that represents a company.
 * In an organization, you can group your projects into teams. You can read
 * more about how organizations work on the Asana Guide.
 * To tell if your workspace is an organization or not, check its
 * `is_organization` property.
 * 
 * Over time, we intend to migrate most workspaces into organizations and to
 * release more organization-specific functionality. We may eventually deprecate
 * using workspace-based APIs for organizations. Currently, and until after
 * some reasonable grace period following any further announcements, you can
 * still reference organizations in any `workspace` parameter.
*/
class WorkspacesBase
{
    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Returns the full workspace record for a single workspace.
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
     * @param  workspace The workspace or organization to invite the user to.
     * @return response
     */
    public function removeUser($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s/removeUser", $workspace);
        return $this->client->post($path, $params, $options);
    }
}
