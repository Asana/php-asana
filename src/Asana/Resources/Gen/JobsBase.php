<?php

namespace Asana\Resources\Gen;

class JobsBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Get a job by id
     *
     * @param string $job_gid  (required) Globally unique identifier for the job.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getJob($job_gid, $params = array(), $options = array()) {
        $path = "/jobs/{job_gid}";
        $path = str_replace("{job_gid}", $job_gid, $path);
        return $this->client->get($path, $params, $options);
    }
}
