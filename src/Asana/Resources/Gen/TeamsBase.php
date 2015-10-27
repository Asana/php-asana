<?php

namespace Asana\Resources\Gen;

/**
 * A _team_ is used to group related projects and people together within an
 * organization. Each project in an organization is associated with a team.
*/
class TeamsBase
{
    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Returns the full record for a single team.
     *
     * @param  team Globally unique identifier for the team.
     * @return response
     */
    public function findById($team, $params = array(), $options = array())
    {
        $path = sprintf("/teams/%s", $team);
        return $this->client->get($path, $params, $options);
    }

    /**
     * Returns the compact records for all teams in the organization visible to
     * the authorized user.
     *
     * @param  organization Globally unique identifier for the workspace or organization.
     * @return response
     */
    public function findByOrganization($organization, $params = array(), $options = array())
    {
        $path = sprintf("/organizations/%s/teams", $organization);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Returns the compact records for all users that are members of the team.
     *
     * @param  team Globally unique identifier for the team.
     * @return response
     */
    public function users($team, $params = array(), $options = array())
    {
        $path = sprintf("/teams/%s/users", $team);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * The user making this call must be a member of the team in order to add others.
     * The user to add must exist in the same organization as the team in order to be added.
     * The user to add can be referenced by their globally unique user ID or their email address.
     * Returns the full user record for the added user.
     *
     * @param  team Globally unique identifier for the team.
     * @return response
     */
    public function addUser($team, $params = array(), $options = array())
    {
        $path = sprintf("/teams/%s/addUser", $team);
        return $this->client->post($path, $params, $options);
    }

    /**
     * The user to remove can be referenced by their globally unique user ID or their email address.
     * Removes the user from the specified team. Returns an empty data record.
     *
     * @param  team Globally unique identifier for the team.
     * @return response
     */
    public function removeUser($team, $params = array(), $options = array())
    {
        $path = sprintf("/teams/%s/removeUser", $team);
        return $this->client->post($path, $params, $options);
    }
}