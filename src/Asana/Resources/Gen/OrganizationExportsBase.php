<?php

namespace Asana\Resources\Gen;

/**
 * An _organization_export_ object represents a request to export the complete data of an Organization
 * in JSON format.
 * 
 * To export an Organization using this API:
 * 
 * * Create an `organization_export` [request](#create) and store the id that is returned.\
 * * Request the `organization_export` every few minutes, until the `state` field contains 'finished'.\
 * * Download the file located at the URL in the `download_url` field.
 * 
 * Exports can take a long time, from several minutes to a few hours for large Organizations.
 * 
 * **Note:** These endpoints are only available to [Service Accounts](/guide/help/premium/service-accounts)
 * of an [Enterprise](/enterprise) Organization.
*/
class OrganizationExportsBase
{
    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Returns details of a previously-requested Organization export.
     *
     * @param  organization_export Globally unique identifier for the Organization export.
     * @return response
     */
    public function findById($organizationExport, $params = array(), $options = array())
    {
        $path = sprintf("/organization_exports/%s", $organizationExport);
        return $this->client->get($path, $params, $options);
    }

    /**
     * This method creates a request to export an Organization. Asana will complete the export at some
     * point after you create the request.
     *
     * @return response
     */
    public function create($params = array(), $options = array())
    {
        return $this->client->post("/organization_exports", $params, $options);
    }
}
