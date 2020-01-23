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

    public function addEnumOption($custom_field_gid, $params = array(), $options = array()) {
        /** Create an enum option
         *
         * @param $custom_field_gid string:  (required) Globally unique identifier for the custom field.
         * @param $params : 
         * @return response
         */
        $path = "/custom_fields/{custom_field_gid}/enum_options";
        $path = str_replace($path,"{custom_field_gid}", $custom_field_gid);
        return $this->client->post($path, $params, $options);
    }

    public function createCustomField($params = array(), $options = array()) {
        /** Create a custom field
         *
         * @param $params : 
         * @return response
         */
        $path = "/custom_fields";
        return $this->client->post($path, $params, $options);
    }

    public function deleteCustomField($custom_field_gid, $params = array(), $options = array()) {
        /** Delete a custom field
         *
         * @param $custom_field_gid string:  (required) Globally unique identifier for the custom field.
         * @param $params : 
         * @return response
         */
        $path = "/custom_fields/{custom_field_gid}";
        $path = str_replace($path,"{custom_field_gid}", $custom_field_gid);
        return $this->client->delete($path, $params, $options);
    }

    public function getCustomField($custom_field_gid, $params = array(), $options = array()) {
        /** Get a custom field
         *
         * @param $custom_field_gid string:  (required) Globally unique identifier for the custom field.
         * @param $params : 
         * @return response
         */
        $path = "/custom_fields/{custom_field_gid}";
        $path = str_replace($path,"{custom_field_gid}", $custom_field_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getCustomFieldsInWorkspace($workspace_gid, $params = array(), $options = array()) {
        /** Get a workspace's custom fields
         *
         * @param $workspace_gid string:  (required) Globally unique identifier for the workspace or organization.
         * @param $params : 
         * @return response
         */
        $path = "/workspaces/{workspace_gid}/custom_fields";
        $path = str_replace($path,"{workspace_gid}", $workspace_gid);
        return $this->client->get($path, $params, $options);
    }

    public function reorderEnumOption($custom_field_gid, $params = array(), $options = array()) {
        /** Reorder a custom field's enum
         *
         * @param $custom_field_gid string:  (required) Globally unique identifier for the custom field.
         * @param $params : 
         * @return response
         */
        $path = "/custom_fields/{custom_field_gid}/enum_options/insert";
        $path = str_replace($path,"{custom_field_gid}", $custom_field_gid);
        return $this->client->post($path, $params, $options);
    }

    public function updateCustomField($custom_field_gid, $params = array(), $options = array()) {
        /** Update a custom field
         *
         * @param $custom_field_gid string:  (required) Globally unique identifier for the custom field.
         * @param $params : 
         * @return response
         */
        $path = "/custom_fields/{custom_field_gid}";
        $path = str_replace($path,"{custom_field_gid}", $custom_field_gid);
        return $this->client->put($path, $params, $options);
    }

    public function updateEnumOption($enum_option_gid, $params = array(), $options = array()) {
        /** Update an enum option
         *
         * @param $enum_option_gid string:  (required) Globally unique identifier for the enum option.
         * @param $params : 
         * @return response
         */
        $path = "/enum_options/{enum_option_gid}";
        $path = str_replace($path,"{enum_option_gid}", $enum_option_gid);
        return $this->client->put($path, $params, $options);
    }
}
