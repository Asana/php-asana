<?php

namespace Asana\Resources\Gen;

/**
 * Custom Fields store the metadata that is used in order to add user-specified
 * information to tasks in Asana. Be sure to reference the [Custom
 * Fields](/developers/documentation/getting-started/custom-fields) developer
 * documentation for more information about how custom fields relate to various
 * resources in Asana.
*/
class CustomFieldsBase
{
    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Returns the complete definition of a custom field's metadata.
     *
     * @param  custom-field Globally unique identifier for the custom field.
     * @return response
     */
    public function findById($customField, $params = array(), $options = array())
    {
        $path = sprintf("/custom_fields/%s", $customField);
        return $this->client->get($path, $params, $options);
    }

    /**
     * Returns a list of the compact representation of all of the custom fields in a workspace.
     *
     * @param  workspace The workspace or organization to find custom field definitions in.
     * @return response
     */
    public function findByWorkspace($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s/custom_fields", $workspace);
        return $this->client->get($path, $params, $options);
    }
}
