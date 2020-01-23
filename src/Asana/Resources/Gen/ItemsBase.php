<?php

namespace Asana\Resources\Gen;

class ItemsBase {

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
}
