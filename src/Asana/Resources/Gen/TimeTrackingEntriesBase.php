<?php

namespace Asana\Resources\Gen;

class TimeTrackingEntriesBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Returns the full record for a single time-tracking entry.
     *
     * @param string $time_tracking_entry_gid  (required) Globally unique identifier for the time-tracking entry.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getTimeTrackingEntry($time_tracking_entry_gid, $params = array(), $options = array())
    {
        $path = "/time_tracking_entries/{time_tracking_entry_gid}";
        $path = str_replace("{time_tracking_entry_gid}", $time_tracking_entry_gid, $path);
        return $this->client->get($path, $params, $options);
    }
}
