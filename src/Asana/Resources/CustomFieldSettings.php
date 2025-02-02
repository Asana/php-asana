<?php

namespace Asana\Resources;

use Asana\Resources\Gen\CustomFieldSettingsBase;

#[\AllowDynamicProperties]
class CustomFieldSettings extends CustomFieldSettingsBase
{
    /**
     * Returns a list of all of the custom fields settings on a project.
     *
     * @deprecated replace with getCustomFieldSettingsForProject
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
     * @deprecated replace with getCustomFieldSettingsForPortfolio
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
