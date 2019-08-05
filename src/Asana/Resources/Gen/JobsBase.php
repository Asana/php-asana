<?php

namespace Asana\Resources\Gen;

/**
 * A _job_ represents a process that handles asynchronous work.
 * 
 * Jobs are created when an endpoint requests an action that will be handled asynchronously.
 * Such as project or task duplication.
*/
class JobsBase
{
    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Returns the complete job record for a single job.
     *
     * @param  job The job to get.
     * @return response
     */
    public function findById($job, $params = array(), $options = array())
    {
        $path = sprintf("/jobs/%s", $job);
        return $this->client->get($path, $params, $options);
    }
}
