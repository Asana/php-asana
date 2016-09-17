<?php

namespace Asana\Resources\Gen;

/**
 * A _user_ object represents an account in Asana that can be given access to
 * various workspaces, projects, and tasks.
 * 
 * Like other objects in the system, users are referred to by numerical IDs.
 * However, the special string identifier `me` can be used anywhere
 * a user ID is accepted, to refer to the current authenticated user.
*/
class UsersBase
{
    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Returns the full user record for the currently authenticated user.
     *
     * @return response
     */
    public function me($params = array(), $options = array())
    {
        return $this->client->get("/users/me", $params, $options);
    }

    /**
     * Returns the full user record for the single user with the provided ID.
     *
     * @param  user An identifier for the user. Can be one of an email address,
     * the globally unique identifier for the user, or the keyword `me`
     * to indicate the current user making the request.
     * @return response
     */
    public function findById($user, $params = array(), $options = array())
    {
        $path = sprintf("/users/%s", $user);
        return $this->client->get($path, $params, $options);
    }

    /**
     * Returns the user records for all users in the specified workspace or
     * organization.
     *
     * @param  workspace The workspace in which to get users.
     * @return response
     */
    public function findByWorkspace($workspace, $params = array(), $options = array())
    {
        $path = sprintf("/workspaces/%s/users", $workspace);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Returns the user records for all users in all workspaces and organizations
     * accessible to the authenticated user. Accepts an optional workspace ID
     * parameter.
     *
     * @return response
     */
    public function findAll($params = array(), $options = array())
    {
        return $this->client->getCollection("/users", $params, $options);
    }
}