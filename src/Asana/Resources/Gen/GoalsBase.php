<?php

namespace Asana\Resources\Gen;

class GoalsBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Add a collaborator to a goal
     *
     * @param string $goal_gid  (required) Globally unique identifier for the goal.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function addFollowers($goal_gid, $params = array(), $options = array()) {
        $path = "/goals/{goal_gid}/addFollowers";
        $path = str_replace("{goal_gid}", $goal_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Add a subgoal to a parent goal
     *
     * @param string $goal_gid  (required) Globally unique identifier for the goal.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function addSubgoal($goal_gid, $params = array(), $options = array()) {
        $path = "/goals/{goal_gid}/addSubgoal";
        $path = str_replace("{goal_gid}", $goal_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Add a project/portfolio as supporting work for a goal.
     *
     * @param string $goal_gid  (required) Globally unique identifier for the goal.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function addSupportingWorkForGoal($goal_gid, $params = array(), $options = array()) {
        $path = "/goals/{goal_gid}/addSupportingWork";
        $path = str_replace("{goal_gid}", $goal_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Create a goal
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function createGoal($params = array(), $options = array()) {
        $path = "/goals";
        return $this->client->post($path, $params, $options);
    }

    /** Create a goal metric
     *
     * @param string $goal_gid  (required) Globally unique identifier for the goal.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function createGoalMetric($goal_gid, $params = array(), $options = array()) {
        $path = "/goals/{goal_gid}/setMetric";
        $path = str_replace("{goal_gid}", $goal_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Delete a goal
     *
     * @param string $goal_gid  (required) Globally unique identifier for the goal.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function deleteGoal($goal_gid, $params = array(), $options = array()) {
        $path = "/goals/{goal_gid}";
        $path = str_replace("{goal_gid}", $goal_gid, $path);
        return $this->client->delete($path, $params, $options);
    }

    /** Get a goal
     *
     * @param string $goal_gid  (required) Globally unique identifier for the goal.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getGoal($goal_gid, $params = array(), $options = array()) {
        $path = "/goals/{goal_gid}";
        $path = str_replace("{goal_gid}", $goal_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Get goals
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getGoals($params = array(), $options = array()) {
        $path = "/goals";
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get parent goals from a goal
     *
     * @param string $goal_gid  (required) Globally unique identifier for the goal.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getParentGoalsForGoal($goal_gid, $params = array(), $options = array()) {
        $path = "/goals/{goal_gid}/parentGoals";
        $path = str_replace("{goal_gid}", $goal_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get subgoals from a goal
     *
     * @param string $goal_gid  (required) Globally unique identifier for the goal.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getSubgoalsForGoal($goal_gid, $params = array(), $options = array()) {
        $path = "/goals/{goal_gid}/subgoals";
        $path = str_replace("{goal_gid}", $goal_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Remove a collaborator from a goal
     *
     * @param string $goal_gid  (required) Globally unique identifier for the goal.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function removeFollowers($goal_gid, $params = array(), $options = array()) {
        $path = "/goals/{goal_gid}/removeFollowers";
        $path = str_replace("{goal_gid}", $goal_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Remove a subgoal from a goal
     *
     * @param string $goal_gid  (required) Globally unique identifier for the goal.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function removeSubgoal($goal_gid, $params = array(), $options = array()) {
        $path = "/goals/{goal_gid}/removeSubgoal";
        $path = str_replace("{goal_gid}", $goal_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Remove a project/portfolio as supporting work for a goal.
     *
     * @param string $goal_gid  (required) Globally unique identifier for the goal.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function removeSupportingWorkForGoal($goal_gid, $params = array(), $options = array()) {
        $path = "/goals/{goal_gid}/removeSupportingWork";
        $path = str_replace("{goal_gid}", $goal_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Get supporting work from a goal
     *
     * @param string $goal_gid  (required) Globally unique identifier for the goal.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function supportingWork($goal_gid, $params = array(), $options = array()) {
        $path = "/goals/{goal_gid}/supportingWork";
        $path = str_replace("{goal_gid}", $goal_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Update a goal
     *
     * @param string $goal_gid  (required) Globally unique identifier for the goal.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function updateGoal($goal_gid, $params = array(), $options = array()) {
        $path = "/goals/{goal_gid}";
        $path = str_replace("{goal_gid}", $goal_gid, $path);
        return $this->client->put($path, $params, $options);
    }

    /** Update a goal metric
     *
     * @param string $goal_gid  (required) Globally unique identifier for the goal.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function updateGoalMetric($goal_gid, $params = array(), $options = array()) {
        $path = "/goals/{goal_gid}/setMetricCurrentValue";
        $path = str_replace("{goal_gid}", $goal_gid, $path);
        return $this->client->post($path, $params, $options);
    }
}
