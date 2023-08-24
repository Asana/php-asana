<?php

namespace Asana\Resources;

use Asana\Resources\Gen\PortfoliosBase;

#[\AllowDynamicProperties]
class Portfolios extends PortfoliosBase
{
    /**
     * Creates a new portfolio in the given workspace with the supplied name.
     *
     * Note that portfolios created in the Asana UI may have some state
     * (like the "Priority" custom field) which is automatically added to the
     * portfolio when it is created. Portfolios created via our API will **not**
     * be created with the same initial state to allow integrations to create
     * their own starting state on a portfolio.
     *
     * @deprecated replace with createPortfolio
     *
     * @return response
     */
    public function create($params = array(), $options = array())
    {
        return $this->client->post("/portfolios", $params, $options);
    }

    /**
     * Returns the complete record for a single portfolio.
     *
     * @deprecated replace with getPortfolio
     *
     * @param  portfolio The portfolio to get.
     * @return response
     */
    public function findById($portfolio, $params = array(), $options = array())
    {
        $path = sprintf("/portfolios/%s", $portfolio);
        return $this->client->get($path, $params, $options);
    }

    /**
     * An existing portfolio can be updated by making a PUT request on the
     * URL for that portfolio. Only the fields provided in the `data` block will be
     * updated; any unspecified fields will remain unchanged.
     *
     * Returns the complete updated portfolio record.
     *
     * @deprecated replace with updatePortfolio
     *
     * @param  portfolio The portfolio to update.
     * @return response
     */
    public function update($portfolio, $params = array(), $options = array())
    {
        $path = sprintf("/portfolios/%s", $portfolio);
        return $this->client->put($path, $params, $options);
    }

    /**
     * An existing portfolio can be deleted by making a DELETE request
     * on the URL for that portfolio.
     *
     * Returns an empty data record.
     *
     * @deprecated replace with deletePortfolio
     *
     * @param  portfolio The portfolio to delete.
     * @return response
     */
    public function delete($portfolio, $params = array(), $options = array())
    {
        $path = sprintf("/portfolios/%s", $portfolio);
        return $this->client->delete($path, $params, $options);
    }

    /**
     * Returns a list of the portfolios in compact representation that are owned
     * by the current API user.
     *
     * @deprecated replace with getPortfolios
     *
     * @return response
     */
    public function findAll($params = array(), $options = array())
    {
        return $this->client->getCollection("/portfolios", $params, $options);
    }

    /**
     * Get a list of the items in compact form in a portfolio.
     *
     * @deprecated replace with getItemsForPortfolio
     *
     * @param  portfolio The portfolio from which to get the list of items.
     * @return response
     */
    public function getItems($portfolio, $params = array(), $options = array())
    {
        $path = sprintf("/portfolios/%s/items", $portfolio);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Add an item to a portfolio.
     *
     * Returns an empty data block.
     *
     * @deprecated replace with addItemForPortfolio
     *
     * @param  portfolio The portfolio to which to add an item.
     * @return response
     */
    public function addItem($portfolio, $params = array(), $options = array())
    {
        $path = sprintf("/portfolios/%s/addItem", $portfolio);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Remove an item to a portfolio.
     *
     * Returns an empty data block.
     *
     * @deprecated replace with removeItemForPortfolio
     *
     * @param  portfolio The portfolio from which to remove the item.
     * @return response
     */
    public function removeItem($portfolio, $params = array(), $options = array())
    {
        $path = sprintf("/portfolios/%s/removeItem", $portfolio);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Adds the specified list of users as members of the portfolio. Returns the updated portfolio record.
     *
     * @deprecated replace with addMembersForPortfolio
     *
     * @param  portfolio The portfolio to add members to.
     * @return response
     */
    public function addMembers($portfolio, $params = array(), $options = array())
    {
        $path = sprintf("/portfolios/%s/addMembers", $portfolio);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Removes the specified list of members from the portfolio. Returns the updated portfolio record.
     *
     * @deprecated replace with removeMembersForPortfolio
     *
     * @param  portfolio The portfolio to remove members from.
     * @return response
     */
    public function removeMembers($portfolio, $params = array(), $options = array())
    {
        $path = sprintf("/portfolios/%s/removeMembers", $portfolio);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Get the custom field settings on a portfolio.
     *
     * @deprecated replace with CustomFields.getCustomFieldSettingsForPortfolio
     *
     * @param  portfolio The portfolio from which to get the custom field settings.
     * @return response
     */
    public function customFieldSettings($portfolio, $params = array(), $options = array())
    {
        $path = sprintf("/portfolios/%s/custom_field_settings", $portfolio);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Create a new custom field setting on the portfolio. Returns the full
     * record for the new custom field setting.
     *
     * @deprecated replace with addCustomFieldSettingForPortfolio
     *
     * @param  portfolio The portfolio onto which to add the custom field.
     * @return response
     */
    public function addCustomFieldSetting($portfolio, $params = array(), $options = array())
    {
        $path = sprintf("/portfolios/%s/addCustomFieldSetting", $portfolio);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Remove a custom field setting on the portfolio. Returns an empty data
     * block.
     *
     * @deprecated replace with removeCustomFieldSettingForPortfolio
     *
     * @param  portfolio The portfolio from which to remove the custom field.
     * @return response
     */
    public function removeCustomFieldSetting($portfolio, $params = array(), $options = array())
    {
        $path = sprintf("/portfolios/%s/removeCustomFieldSetting", $portfolio);
        return $this->client->post($path, $params, $options);
    }
}
