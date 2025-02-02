<?php

namespace Asana\Resources;

use Asana\Resources\Gen\JobsBase;

#[\AllowDynamicProperties]
class Jobs extends JobsBase
{
    /**
     * Returns the complete job record for a single job.
     *
     * @deprecated replace with getJob
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
