<?php

namespace Asana\Resources;

use Asana\Resources\Gen\OrganizationExportsBase;

#[\AllowDynamicProperties]
class OrganizationExports extends OrganizationExportsBase
{
    /**
     * Returns details of a previously-requested Organization export.
     *
     * @deprecated replace with getOrganizationExport
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
     * @deprecated replace with createOrganizationExport
     *
     * @return response
     */
    public function create($params = array(), $options = array())
    {
        return $this->client->post("/organization_exports", $params, $options);
    }
}
