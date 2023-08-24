<?php

namespace Asana\Resources;

use Asana\Resources\Gen\PortfolioMembershipsBase;

#[\AllowDynamicProperties]
class PortfolioMemberships extends PortfolioMembershipsBase
{
    /**
     * Returns the compact portfolio membership records for the portfolio. You must
     * specify `portfolio`, `portfolio` and `user`, or `workspace` and `user`.
     *
     * @deprecated replace with getPortfolioMemberships
     *
     * @return response
     */
    public function findAll($params = array(), $options = array())
    {
        return $this->client->getCollection("/portfolio_memberships", $params, $options);
    }

    /**
     * Returns the compact portfolio membership records for the portfolio.
     *
     * @deprecated replace with getPortfolioMembershipsForPortfolio
     *
     * @param  portfolio The portfolio for which to fetch memberships.
     * @return response
     */
    public function findByPortfolio($portfolio, $params = array(), $options = array())
    {
        $path = sprintf("/portfolios/%s/portfolio_memberships", $portfolio);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Returns the portfolio membership record.
     *
     * @deprecated replace with getPortfolioMembership
     *
     * @param  portfolio_membership Globally unique identifier for the portfolio membership.
     * @return response
     */
    public function findById($portfolioMembership, $params = array(), $options = array())
    {
        $path = sprintf("/portfolio_memberships/%s", $portfolioMembership);
        return $this->client->get($path, $params, $options);
    }
}
