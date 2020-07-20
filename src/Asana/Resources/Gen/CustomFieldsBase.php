<?php

namespace Asana\Resources\Gen;

class CustomFieldsBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Create a custom field
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function createCustomField($params = array(), $options = array()) {
        $path = "/custom_fields";
        return $this->client->post($path, $params, $options);
    }

    /** Create an enum option
     *
     * @param string $custom_field_gid  (required) Globally unique identifier for the custom field.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function createEnumOptionForCustomField($custom_field_gid, $params = array(), $options = array()) {
        $path = "/custom_fields/{custom_field_gid}/enum_options";
        $path = str_replace("{custom_field_gid}", $custom_field_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Delete a custom field
     *
     * @param string $custom_field_gid  (required) Globally unique identifier for the custom field.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function deleteCustomField($custom_field_gid, $params = array(), $options = array()) {
        $path = "/custom_fields/{custom_field_gid}";
        $path = str_replace("{custom_field_gid}", $custom_field_gid, $path);
        return $this->client->delete($path, $params, $options);
    }

    /** Get a custom field
     *
     * @param string $custom_field_gid  (required) Globally unique identifier for the custom field.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getCustomField($custom_field_gid, $params = array(), $options = array()) {
        $path = "/custom_fields/{custom_field_gid}";
        $path = str_replace("{custom_field_gid}", $custom_field_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Get a workspace's custom fields
     *
     * @param string $workspace_gid  (required) Globally unique identifier for the workspace or organization.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getCustomFieldsForWorkspace($workspace_gid, $params = array(), $options = array()) {
        $path = "/workspaces/{workspace_gid}/custom_fields";
        $path = str_replace("{workspace_gid}", $workspace_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Reorder a custom field's enum
     *
     * @param string $custom_field_gid  (required) Globally unique identifier for the custom field.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function insertEnumOptionForCustomField($custom_field_gid, $params = array(), $options = array()) {
        $path = "/custom_fields/{custom_field_gid}/enum_options/insert";
        $path = str_replace("{custom_field_gid}", $custom_field_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Update a custom field
     *
     * @param string $custom_field_gid  (required) Globally unique identifier for the custom field.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function updateCustomField($custom_field_gid, $params = array(), $options = array()) {
        $path = "/custom_fields/{custom_field_gid}";
        $path = str_replace("{custom_field_gid}", $custom_field_gid, $path);
        return $this->client->put($path, $params, $options);
    }

    /** Update an enum option
     *
     * @param string $enum_option_gid  (required) Globally unique identifier for the enum option.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function updateEnumOption($enum_option_gid, $params = array(), $options = array()) {
        $path = "/enum_options/{enum_option_gid}";
        $path = str_replace("{enum_option_gid}", $enum_option_gid, $path);
        return $this->client->put($path, $params, $options);
    }
}
