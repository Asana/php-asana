<?php

namespace Asana\Resources\Gen;

class OrganizationExportsBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Create an organization export request
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function createOrganizationExport($params = array(), $options = array()) {
        $path = "/organization_exports";
        return $this->client->post($path, $params, $options);
    }

    /** Get details on an org export request
     *
     * @param string $organization_export_gid  (required) Globally unique identifier for the organization export.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getOrganizationExport($organization_export_gid, $params = array(), $options = array()) {
        $path = "/organization_exports/{organization_export_gid}";
        $path = str_replace("{organization_export_gid}", $organization_export_gid, $path);
        return $this->client->get($path, $params, $options);
    }
}
