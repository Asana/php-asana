<?php

namespace Asana\Resources\Gen;

class TimePeriodsBase {

    public $client;

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Get a time period
     *
     * @param string $time_period_gid  (required) Globally unique identifier for the time period.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getTimePeriod($time_period_gid, $params = array(), $options = array()) {
        $path = "/time_periods/{time_period_gid}";
        $path = str_replace("{time_period_gid}", $time_period_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Get time periods
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getTimePeriods($params = array(), $options = array()) {
        $path = "/time_periods";
        return $this->client->getCollection($path, $params, $options);
    }
}
