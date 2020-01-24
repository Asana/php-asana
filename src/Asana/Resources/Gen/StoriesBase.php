<?php

namespace Asana\Resources\Gen;

class StoriesBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Create a story on a task
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function createStoryForTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/stories";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    /** Delete a story
     *
     * @param $story_gid string:  (required) Globally unique identifier for the story.
     * @param $params object
     * @return response
     */
    public function deleteStory($story_gid, $params = array(), $options = array()) {
        $path = "/stories/{story_gid}";
        $path = str_replace($path,"{story_gid}", $story_gid);
        return $this->client->delete($path, $params, $options);
    }

    /** Get stories from a task
     *
     * @param $task_gid string:  (required) The task to operate on.
     * @param $params object
     * @return response
     */
    public function getStoriesForTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/stories";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get a story
     *
     * @param $story_gid string:  (required) Globally unique identifier for the story.
     * @param $params object
     * @return response
     */
    public function getStory($story_gid, $params = array(), $options = array()) {
        $path = "/stories/{story_gid}";
        $path = str_replace($path,"{story_gid}", $story_gid);
        return $this->client->get($path, $params, $options);
    }

    /** Update a story
     *
     * @param $story_gid string:  (required) Globally unique identifier for the story.
     * @param $params object
     * @return response
     */
    public function updateStory($story_gid, $params = array(), $options = array()) {
        $path = "/stories/{story_gid}";
        $path = str_replace($path,"{story_gid}", $story_gid);
        return $this->client->put($path, $params, $options);
    }
}
