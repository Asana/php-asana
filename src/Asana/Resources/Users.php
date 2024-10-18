<?php

namespace Asana\Resources;

use Asana\Resources\Gen\UsersBase;

#[\AllowDynamicProperties]
class Users extends UsersBase
{
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
     * @deprecated replace with getUser
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
     * Returns all of a user's favorites in the given workspace, of the given type.
     * Results are given in order (The same order as Asana's sidebar).
     *
     * @deprecated replace with getFavoritesForUser
     *
     * @param  user An identifier for the user. Can be one of an email address,
     * the globally unique identifier for the user, or the keyword `me`
     * to indicate the current user making the request.
     * @return response
     */
    public function getUserFavorites($user, $params = array(), $options = array())
    {
        $path = sprintf("/users/%s/favorites", $user);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Returns the user records for all users in the specified workspace or
     * organization.
     *
     * @deprecated replace with getUsersForWorkspace
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
     * @deprecated replace with getUsers
     *
     * @return response
     */
    public function findAll($params = array(), $options = array())
    {
        return $this->client->getCollection("/users", $params, $options);
    }
}
