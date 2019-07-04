<?php

namespace Asana\Resources\Gen;

/**
 * Custom Fields store the metadata that is used in order to add user-specified
 * information to tasks in Asana. Be sure to reference the [Custom
 * Fields](/developers/documentation/getting-started/custom-fields) developer
 * documentation for more information about how custom fields relate to various
 * resources in Asana.
 * 
 * Users in Asana can [lock custom
 * fields](/guide/help/premium/custom-fields#gl-lock-fields), which will make
 * them read-only when accessed by other users. Attempting to edit a locked
 * custom field will return HTTP error code `403 Forbidden`.
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
     * Creates a new custom field in a workspace. Every custom field is required to be created in a specific workspace, and this workspace cannot be changed once set.
     * 
     * A custom field's `name` must be unique within a workspace and not conflict with names of existing task properties such as 'Due Date' or 'Assignee'. A custom field's `type` must be one of  'text', 'enum', or 'number'.
     * 
     * Returns the full record of the newly created custom field.
     *
     * @return response
     */
    public function create($params = array(), $options = array())
    {
        return $this->client->post("/custom_fields", $params, $options);
    }

    /**
     * Returns the complete definition of a custom field's metadata.
     *
     * @param  custom_field Globally unique identifier for the custom field.
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
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * A specific, existing custom field can be updated by making a PUT request on the URL for that custom field. Only the fields provided in the `data` block will be updated; any unspecified fields will remain unchanged
     * 
     * When using this method, it is best to specify only those fields you wish to change, or else you may overwrite changes made by another user since you last retrieved the custom field.
     * 
     * An enum custom field's `enum_options` cannot be updated with this endpoint. Instead see "Work With Enum Options" for information on how to update `enum_options`.
     * 
     * Locked custom fields can only be updated by the user who locked the field.
     * 
     * Returns the complete updated custom field record.
     *
     * @param  custom_field Globally unique identifier for the custom field.
     * @return response
     */
    public function update($customField, $params = array(), $options = array())
    {
        $path = sprintf("/custom_fields/%s", $customField);
        return $this->client->put($path, $params, $options);
    }

    /**
     * A specific, existing custom field can be deleted by making a DELETE request on the URL for that custom field.
     * 
     * Locked custom fields can only be deleted by the user who locked the field.
     * 
     * Returns an empty data record.
     *
     * @param  custom_field Globally unique identifier for the custom field.
     * @return response
     */
    public function delete($customField, $params = array(), $options = array())
    {
        $path = sprintf("/custom_fields/%s", $customField);
        return $this->client->delete($path, $params, $options);
    }

    /**
     * Creates an enum option and adds it to this custom field's list of enum options. A custom field can have at most 50 enum options (including disabled options). By default new enum options are inserted at the end of a custom field's list.
     * 
     * Locked custom fields can only have enum options added by the user who locked the field.
     * 
     * Returns the full record of the newly created enum option.
     *
     * @param  custom_field Globally unique identifier for the custom field.
     * @return response
     */
    public function createEnumOption($customField, $params = array(), $options = array())
    {
        $path = sprintf("/custom_fields/%s/enum_options", $customField);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Updates an existing enum option. Enum custom fields require at least one enabled enum option.
     * 
     * Locked custom fields can only be updated by the user who locked the field.
     * 
     * Returns the full record of the updated enum option.
     *
     * @param  enum_option Globally unique identifier for the enum option.
     * @return response
     */
    public function updateEnumOption($enumOption, $params = array(), $options = array())
    {
        $path = sprintf("/enum_options/%s", $enumOption);
        return $this->client->put($path, $params, $options);
    }

    /**
     * Moves a particular enum option to be either before or after another specified enum option in the custom field.
     * 
     * Locked custom fields can only be reordered by the user who locked the field.
     *
     * @param  custom_field Globally unique identifier for the custom field.
     * @return response
     */
    public function insertEnumOption($customField, $params = array(), $options = array())
    {
        $path = sprintf("/custom_fields/%s/enum_options/insert", $customField);
        return $this->client->post($path, $params, $options);
    }
}
