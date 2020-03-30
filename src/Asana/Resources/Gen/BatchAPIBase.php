<?php

namespace Asana\Resources\Gen;

class BatchAPIBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Submit parallel requests
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function createBatchRequest($params = array(), $options = array()) {
        $path = "/batch";
        return $this->client->post($path, $params, $options);
    }
}
