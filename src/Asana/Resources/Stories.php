<?php

namespace Asana\Resources;

use Asana\Resources\Gen\StoriesBase;

#[\AllowDynamicProperties]
class Stories extends StoriesBase
{
    /**
     * Returns the compact records for all stories on the task.
     *
     * @deprecated replace with getStoriesForTask
     *
     * @param  task Globally unique identifier for the task.
     * @return response
     */
    public function findByTask($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/stories", $task);
        return $this->client->getCollection($path, $params, $options);
    }

    /**
     * Returns the full record for a single story.
     *
     * @deprecated replace with getStory
     *
     * @param  story Globally unique identifier for the story.
     * @return response
     */
    public function findById($story, $params = array(), $options = array())
    {
        $path = sprintf("/stories/%s", $story);
        return $this->client->get($path, $params, $options);
    }

    /**
     * Adds a comment to a task. The comment will be authored by the
     * currently authenticated user, and timestamped when the server receives
     * the request.
     *
     * Returns the full record for the new story added to the task.
     *
     * @deprecated replace with createStoryForTask
     *
     * @param  task Globally unique identifier for the task.
     * @return response
     */
    public function createOnTask($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/stories", $task);
        return $this->client->post($path, $params, $options);
    }

    /**
     * Updates the story and returns the full record for the updated story.
     * Only comment stories can have their text updated, and only comment stories and
     * attachment stories can be pinned. Only one of `text` and `html_text` can be specified.
     *
     * @deprecated replace with updateStory
     *
     * @param  story Globally unique identifier for the story.
     * @return response
     */
    public function update($story, $params = array(), $options = array())
    {
        $path = sprintf("/stories/%s", $story);
        return $this->client->put($path, $params, $options);
    }

    /**
     * Deletes a story. A user can only delete stories they have created. Returns an empty data record.
     *
     * @deprecated replace with deleteStory
     *
     * @param  story Globally unique identifier for the story.
     * @return response
     */
    public function delete($story, $params = array(), $options = array())
    {
        $path = sprintf("/stories/%s", $story);
        return $this->client->delete($path, $params, $options);
    }
}
