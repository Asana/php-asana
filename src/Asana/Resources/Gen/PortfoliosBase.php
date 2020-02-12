<?php

namespace Asana\Resources\Gen;

class PortfoliosBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Add a custom field to a portfolio
     *
     * @param string $portfolio_gid  (required) Globally unique identifier for the portfolio.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function addCustomFieldSettingForPortfolio($portfolio_gid, $params = array(), $options = array()) {
        $path = "/portfolios/{portfolio_gid}/addCustomFieldSetting";
        $path = str_replace("{portfolio_gid}", $portfolio_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Add a portfolio item
     *
     * @param string $portfolio_gid  (required) Globally unique identifier for the portfolio.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function addItemForPortfolio($portfolio_gid, $params = array(), $options = array()) {
        $path = "/portfolios/{portfolio_gid}/addItem";
        $path = str_replace("{portfolio_gid}", $portfolio_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Add users to a portfolio
     *
     * @param string $portfolio_gid  (required) Globally unique identifier for the portfolio.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function addMembersForPortfolio($portfolio_gid, $params = array(), $options = array()) {
        $path = "/portfolios/{portfolio_gid}/addMembers";
        $path = str_replace("{portfolio_gid}", $portfolio_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Create a portfolio
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function createPortfolio($params = array(), $options = array()) {
        $path = "/portfolios";
        return $this->client->post($path, $params, $options);
    }

    /** Delete a portfolio
     *
     * @param string $portfolio_gid  (required) Globally unique identifier for the portfolio.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function deletePortfolio($portfolio_gid, $params = array(), $options = array()) {
        $path = "/portfolios/{portfolio_gid}";
        $path = str_replace("{portfolio_gid}", $portfolio_gid, $path);
        return $this->client->delete($path, $params, $options);
    }

    /** Get portfolio items
     *
     * @param string $portfolio_gid  (required) Globally unique identifier for the portfolio.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getItemsForPortfolio($portfolio_gid, $params = array(), $options = array()) {
        $path = "/portfolios/{portfolio_gid}/items";
        $path = str_replace("{portfolio_gid}", $portfolio_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get a portfolio
     *
     * @param string $portfolio_gid  (required) Globally unique identifier for the portfolio.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getPortfolio($portfolio_gid, $params = array(), $options = array()) {
        $path = "/portfolios/{portfolio_gid}";
        $path = str_replace("{portfolio_gid}", $portfolio_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Get multiple portfolios
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getPortfolios($params = array(), $options = array()) {
        $path = "/portfolios";
        return $this->client->getCollection($path, $params, $options);
    }

    /** Remove a custom field from a portfolio
     *
     * @param string $portfolio_gid  (required) Globally unique identifier for the portfolio.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function removeCustomFieldSettingForPortfolio($portfolio_gid, $params = array(), $options = array()) {
        $path = "/portfolios/{portfolio_gid}/removeCustomFieldSetting";
        $path = str_replace("{portfolio_gid}", $portfolio_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Remove a portfolio item
     *
     * @param string $portfolio_gid  (required) Globally unique identifier for the portfolio.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function removeItemForPortfolio($portfolio_gid, $params = array(), $options = array()) {
        $path = "/portfolios/{portfolio_gid}/removeItem";
        $path = str_replace("{portfolio_gid}", $portfolio_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Remove users from a portfolio
     *
     * @param string $portfolio_gid  (required) Globally unique identifier for the portfolio.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function removeMembersForPortfolio($portfolio_gid, $params = array(), $options = array()) {
        $path = "/portfolios/{portfolio_gid}/removeMembers";
        $path = str_replace("{portfolio_gid}", $portfolio_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Update a portfolio
     *
     * @param string $portfolio_gid  (required) Globally unique identifier for the portfolio.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function updatePortfolio($portfolio_gid, $params = array(), $options = array()) {
        $path = "/portfolios/{portfolio_gid}";
        $path = str_replace("{portfolio_gid}", $portfolio_gid, $path);
        return $this->client->put($path, $params, $options);
    }
}
