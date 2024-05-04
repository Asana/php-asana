<?php

namespace Asana\Resources\Gen;

class StatusUpdatesBase {

    public $client;

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Create a status update
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function createStatusForObject($params = array(), $options = array()) {
        $path = "/status_updates";
        return $this->client->post($path, $params, $options);
    }

    /** Delete a status update
     *
     * @param string $status_gid  (required) The status update to get.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function deleteStatus($status_gid, $params = array(), $options = array()) {
        $path = "/status_updates/{status_gid}";
        $path = str_replace("{status_gid}", $status_gid, $path);
        return $this->client->delete($path, $params, $options);
    }

    /** Get a status update
     *
     * @param string $status_gid  (required) The status update to get.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getStatus($status_gid, $params = array(), $options = array()) {
        $path = "/status_updates/{status_gid}";
        $path = str_replace("{status_gid}", $status_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Get status updates from an object
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getStatusesForObject($params = array(), $options = array()) {
        $path = "/status_updates";
        return $this->client->getCollection($path, $params, $options);
    }
}
