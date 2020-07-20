<?php

namespace Asana\Resources\Gen;

class EventsBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Get events on a resource
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getEvents($params = array(), $options = array()) {
        $path = "/events";
        return $this->client->getCollection($path, $params, $options);
    }
}
