<?php

namespace Asana\Resources\Gen;

class PortfolioMembershipsBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Get a portfolio membership
     *
     * @param string $portfolio_membership_gid  (required)
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getPortfolioMembership($portfolio_membership_gid, $params = array(), $options = array()) {
        $path = "/portfolio_memberships/{portfolio_membership_gid}";
        $path = str_replace("{portfolio_membership_gid}", $portfolio_membership_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Get multiple portfolio memberships
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getPortfolioMemberships($params = array(), $options = array()) {
        $path = "/portfolio_memberships";
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get memberships from a portfolio
     *
     * @param string $portfolio_gid  (required) Globally unique identifier for the portfolio.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getPortfolioMembershipsForPortfolio($portfolio_gid, $params = array(), $options = array()) {
        $path = "/portfolios/{portfolio_gid}/portfolio_memberships";
        $path = str_replace("{portfolio_gid}", $portfolio_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }
}
