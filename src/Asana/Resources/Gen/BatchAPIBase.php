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
     * @param $params object
     * @return response
     */
    public function createBatchRequestAction($params = array(), $options = array()) {
        $path = "/batch";
        return $this->client->post($path, $params, $options);
    }
}
