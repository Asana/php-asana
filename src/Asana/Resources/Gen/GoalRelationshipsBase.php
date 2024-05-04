<?php

namespace Asana\Resources\Gen;

class GoalRelationshipsBase {

    public $client;

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Add a supporting goal relationship
     *
     * @param string $goal_gid  (required) Globally unique identifier for the goal.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function addSupportingRelationship($goal_gid, $params = array(), $options = array()) {
        $path = "/goals/{goal_gid}/addSupportingRelationship";
        $path = str_replace("{goal_gid}", $goal_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Get a goal relationship
     *
     * @param string $goal_relationship_gid  (required) Globally unique identifier for the goal relationship.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getGoalRelationship($goal_relationship_gid, $params = array(), $options = array()) {
        $path = "/goal_relationships/{goal_relationship_gid}";
        $path = str_replace("{goal_relationship_gid}", $goal_relationship_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Get goal relationships
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getGoalRelationships($params = array(), $options = array()) {
        $path = "/goal_relationships";
        return $this->client->getCollection($path, $params, $options);
    }

    /** Removes a supporting goal relationship
     *
     * @param string $goal_gid  (required) Globally unique identifier for the goal.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function removeSupportingRelationship($goal_gid, $params = array(), $options = array()) {
        $path = "/goals/{goal_gid}/removeSupportingRelationship";
        $path = str_replace("{goal_gid}", $goal_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Update a goal relationship
     *
     * @param string $goal_relationship_gid  (required) Globally unique identifier for the goal relationship.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function updateGoalRelationship($goal_relationship_gid, $params = array(), $options = array()) {
        $path = "/goal_relationships/{goal_relationship_gid}";
        $path = str_replace("{goal_relationship_gid}", $goal_relationship_gid, $path);
        return $this->client->put($path, $params, $options);
    }
}
