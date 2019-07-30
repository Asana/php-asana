<?php

namespace Asana\Resources;

use Asana\Resources\Gen\TagsBase;

class Tags extends TagsBase
{
    /**
     * Returns the compact task records for all tasks with the given tag.
     * Tasks can have more than one tag at a time.
     *
     * @param  tag The tag to fetch tasks from.
     * @return response
     */
    public function getTasksWithTag($tag, $params = array(), $options = array())
    {
        $path = sprintf("/tags/%s/tasks", $tag);
        return $this->client->getCollection($path, $params, $options);
    }
}
