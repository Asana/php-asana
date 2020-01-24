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
     * @param $params object
     * @return response
     */
    public function createOrganizationExport($params = array(), $options = array()) {
        $path = "/organization_exports";
        return $this->client->post($path, $params, $options);
    }

    /** Get details on an org export request
     *
     * @param $organization_export_gid string:  (required) Globally unique identifier for the organization export.
     * @param $params object
     * @return response
     */
    public function getOrganizationExport($organization_export_gid, $params = array(), $options = array()) {
        $path = "/organization_exports/{organization_export_gid}";
        $path = str_replace($path,"{organization_export_gid}", $organization_export_gid);
        return $this->client->get($path, $params, $options);
    }
}
