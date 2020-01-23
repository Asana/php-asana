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

    public function createOrganizationExport($params = array(), $options = array()) {
        /** Create an organization export request
         *
         * @param $params : 
         * @return response
         */
        $path = "/organization_exports";
        return $this->client->post($path, $params, $options);
    }

    public function getOrganizationExport($organization_export_gid, $params = array(), $options = array()) {
        /** Get details on an org export request
         *
         * @param $organization_export_gid string:  (required) Globally unique identifier for the organization export.
         * @param $params : 
         * @return response
         */
        $path = "/organization_exports/{organization_export_gid}";
        $path = str_replace($path,"{organization_export_gid}", $organization_export_gid);
        return $this->client->get($path, $params, $options);
    }
}
