<?php

namespace Asana\Resources\Gen;

/**
 * Custom fields are applied to a particular project or portfolio with the
 * Custom Field Settings resource. This resource both represents the
 * many-to-many join of the Custom Field and Project or Portfolio as well as
 * stores information that is relevant to that particular pairing; for instance,
 * the `is_important` property determines some possible application-specific
 * handling of that custom field and parent.
*/
class CustomFieldSettingsBase
{
    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Returns a list of all of the custom fields settings on a project.
     *
     * @param  project The ID of the project for which to list custom field settings
     * @return response
     */
    public function findByProject($project, $params = array(), $options = array())
    {
        $path = sprintf("/projects/%s/custom_field_settings", $project);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Returns a list of all of the custom fields settings on a portfolio.
     *
     * @param  portfolio The ID of the portfolio for which to list custom field settings
     * @return response
     */
    public function findByPortfolio($portfolio, $params = array(), $options = array())
    {
        $path = sprintf("/portfolios/%s/custom_field_settings", $portfolio);
        return $this->client->getCollection($path, $params, $options);
    }
}
