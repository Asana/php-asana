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

    public function batchRequest($params = array(), $options = array()) {
        /** Submit parallel requests
         *
         * @param $params : 
         * @return response
         */
        $path = "/batch";
        return $this->client->post($path, $params, $options);
    }
}
