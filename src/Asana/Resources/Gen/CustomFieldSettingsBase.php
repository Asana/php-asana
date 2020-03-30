<?php

namespace Asana\Resources\Gen;

class CustomFieldSettingsBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Get a portfolio's custom fields
     *
     * @param string $portfolio_gid  (required) Globally unique identifier for the portfolio.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getCustomFieldSettingsForPortfolio($portfolio_gid, $params = array(), $options = array()) {
        $path = "/portfolios/{portfolio_gid}/custom_field_settings";
        $path = str_replace("{portfolio_gid}", $portfolio_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get a project's custom fields
     *
     * @param string $project_gid  (required) Globally unique identifier for the project.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getCustomFieldSettingsForProject($project_gid, $params = array(), $options = array()) {
        $path = "/projects/{project_gid}/custom_field_settings";
        $path = str_replace("{project_gid}", $project_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }
}
