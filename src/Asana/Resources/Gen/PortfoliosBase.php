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

    public function addPortfolioItem($portfolio_gid, $params = array(), $options = array()) {
        /** Add a portfolio item
         *
         * @param $portfolio_gid string:  (required) Globally unique identifier for the portfolio.
         * @param $params : 
         * @return response
         */
        $path = "/portfolios/{portfolio_gid}/addItem";
        $path = str_replace($path,"{portfolio_gid}", $portfolio_gid);
        return $this->client->post($path, $params, $options);
    }

    public function addPortfolioMembers($portfolio_gid, $params = array(), $options = array()) {
        /** Add users to a portfolio
         *
         * @param $portfolio_gid string:  (required) Globally unique identifier for the portfolio.
         * @param $params : 
         * @return response
         */
        $path = "/portfolios/{portfolio_gid}/addMembers";
        $path = str_replace($path,"{portfolio_gid}", $portfolio_gid);
        return $this->client->post($path, $params, $options);
    }

    public function createPortfolio($params = array(), $options = array()) {
        /** Create a portfolio
         *
         * @param $params : 
         * @return response
         */
        $path = "/portfolios";
        return $this->client->post($path, $params, $options);
    }

    public function deletePortfolio($portfolio_gid, $params = array(), $options = array()) {
        /** Delete a portfolio
         *
         * @param $portfolio_gid string:  (required) Globally unique identifier for the portfolio.
         * @param $params : 
         * @return response
         */
        $path = "/portfolios/{portfolio_gid}";
        $path = str_replace($path,"{portfolio_gid}", $portfolio_gid);
        return $this->client->delete($path, $params, $options);
    }

    public function getPortfolio($portfolio_gid, $params = array(), $options = array()) {
        /** Get a portfolio
         *
         * @param $portfolio_gid string:  (required) Globally unique identifier for the portfolio.
         * @param $params : 
         * @return response
         */
        $path = "/portfolios/{portfolio_gid}";
        $path = str_replace($path,"{portfolio_gid}", $portfolio_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getPortfolioItems($portfolio_gid, $params = array(), $options = array()) {
        /** Get portfolio items
         *
         * @param $portfolio_gid string:  (required) Globally unique identifier for the portfolio.
         * @param $params : 
         * @return response
         */
        $path = "/portfolios/{portfolio_gid}/items";
        $path = str_replace($path,"{portfolio_gid}", $portfolio_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getPortfolios($params = array(), $options = array()) {
        /** Get multiple portfolios
         *
         * @param $params : 
         * @return response
         */
        $path = "/portfolios";
        return $this->client->get($path, $params, $options);
    }

    public function removePortfolioItem($portfolio_gid, $params = array(), $options = array()) {
        /** Remove a portfolio item
         *
         * @param $portfolio_gid string:  (required) Globally unique identifier for the portfolio.
         * @param $params : 
         * @return response
         */
        $path = "/portfolios/{portfolio_gid}/removeItem";
        $path = str_replace($path,"{portfolio_gid}", $portfolio_gid);
        return $this->client->post($path, $params, $options);
    }

    public function removePortfolioMembers($portfolio_gid, $params = array(), $options = array()) {
        /** Remove users from a portfolio
         *
         * @param $portfolio_gid string:  (required) Globally unique identifier for the portfolio.
         * @param $params : 
         * @return response
         */
        $path = "/portfolios/{portfolio_gid}/removeMembers";
        $path = str_replace($path,"{portfolio_gid}", $portfolio_gid);
        return $this->client->post($path, $params, $options);
    }

    public function updateportfolio($portfolio_gid, $params = array(), $options = array()) {
        /** Update a portfolio
         *
         * @param $portfolio_gid string:  (required) Globally unique identifier for the portfolio.
         * @param $params : 
         * @return response
         */
        $path = "/portfolios/{portfolio_gid}";
        $path = str_replace($path,"{portfolio_gid}", $portfolio_gid);
        return $this->client->put($path, $params, $options);
    }
}
