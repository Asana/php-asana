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

    public function getCustomFieldSettingsForPortfolio($portfolio_gid, $params = array(), $options = array()) {
        /** Get a portfolio's custom fields
         *
         * @param $portfolio_gid string:  (required) Globally unique identifier for the portfolio.
         * @param $params : 
         * @return response
         */
        $path = "/portfolios/{portfolio_gid}/custom_field_settings";
        $path = str_replace($path,"{portfolio_gid}", $portfolio_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getCustomFieldSettingsForProject($project_gid, $params = array(), $options = array()) {
        /** Get a project's custom fields
         *
         * @param $project_gid string:  (required) Globally unique identifier for the project.
         * @param $params : 
         * @return response
         */
        $path = "/projects/{project_gid}/custom_field_settings";
        $path = str_replace($path,"{project_gid}", $project_gid);
        return $this->client->get($path, $params, $options);
    }

    public function portfolioAddCustomFieldSetting($portfolio_gid, $params = array(), $options = array()) {
        /** Add a custom field to a portfolio
         *
         * @param $portfolio_gid string:  (required) Globally unique identifier for the portfolio.
         * @param $params : 
         * @return response
         */
        $path = "/portfolios/{portfolio_gid}/addCustomFieldSetting";
        $path = str_replace($path,"{portfolio_gid}", $portfolio_gid);
        return $this->client->post($path, $params, $options);
    }

    public function portfolioRemoveCustomFieldSetting($portfolio_gid, $params = array(), $options = array()) {
        /** Remove a custom field from a portfolio
         *
         * @param $portfolio_gid string:  (required) Globally unique identifier for the portfolio.
         * @param $params : 
         * @return response
         */
        $path = "/portfolios/{portfolio_gid}/removeCustomFieldSetting";
        $path = str_replace($path,"{portfolio_gid}", $portfolio_gid);
        return $this->client->post($path, $params, $options);
    }
}
