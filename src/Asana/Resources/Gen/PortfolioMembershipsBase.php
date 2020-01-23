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

    public function getPortfolioMembership($portfolio_membership_path_gid, $params = array(), $options = array()) {
        /** Get a portfolio membership
         *
         * @param $portfolio_membership_path_gid string:  (required)
         * @param $params : 
         * @return response
         */
        $path = "/portfolio_memberships/{portfolio_membership_gid}";
        $path = str_replace($path,"{portfolio_membership_path_gid}", $portfolio_membership_path_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getPortfolioMemberships($params = array(), $options = array()) {
        /** Get multiple portfolio memberships
         *
         * @param $params : 
         * @return response
         */
        $path = "/portfolio_memberships";
        return $this->client->get($path, $params, $options);
    }

    public function getPortfolioMembershipsForPortfolio($portfolio_gid, $params = array(), $options = array()) {
        /** Get memberships from a portfolio
         *
         * @param $portfolio_gid string:  (required) Globally unique identifier for the portfolio.
         * @param $params : 
         * @return response
         */
        $path = "/portfolios/{portfolio_gid}/portfolio_memberships";
        $path = str_replace($path,"{portfolio_gid}", $portfolio_gid);
        return $this->client->get($path, $params, $options);
    }
}
