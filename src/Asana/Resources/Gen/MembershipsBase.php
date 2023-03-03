<?php

namespace Asana\Resources\Gen;

class MembershipsBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Create a membership
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function createMembership($params = array(), $options = array()) {
        $path = "/memberships";
        return $this->client->post($path, $params, $options);
    }

    /** Delete a membership
     *
     * @param string $membership_gid  (required) Globally unique identifier for the membership.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function deleteMembership($membership_gid, $params = array(), $options = array()) {
        $path = "/memberships/{membership_gid}";
        $path = str_replace("{membership_gid}", $membership_gid, $path);
        return $this->client->delete($path, $params, $options);
    }

    /** Get multiple memberships
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getMemberships($params = array(), $options = array()) {
        $path = "/memberships";
        return $this->client->getCollection($path, $params, $options);
    }

    /** Update a membership
     *
     * @param string $membership_gid  (required) Globally unique identifier for the membership.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function updateMembership($membership_gid, $params = array(), $options = array()) {
        $path = "/memberships/{membership_gid}";
        $path = str_replace("{membership_gid}", $membership_gid, $path);
        return $this->client->put($path, $params, $options);
    }
}
