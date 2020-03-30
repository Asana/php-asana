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
     * @param string $task_gid  (required) The task to operate on.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function createStoryForTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/stories";
        $path = str_replace("{task_gid}", $task_gid, $path);
        return $this->client->post($path, $params, $options);
    }

    /** Delete a story
     *
     * @param string $story_gid  (required) Globally unique identifier for the story.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function deleteStory($story_gid, $params = array(), $options = array()) {
        $path = "/stories/{story_gid}";
        $path = str_replace("{story_gid}", $story_gid, $path);
        return $this->client->delete($path, $params, $options);
    }

    /** Get stories from a task
     *
     * @param string $task_gid  (required) The task to operate on.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getStoriesForTask($task_gid, $params = array(), $options = array()) {
        $path = "/tasks/{task_gid}/stories";
        $path = str_replace("{task_gid}", $task_gid, $path);
        return $this->client->getCollection($path, $params, $options);
    }

    /** Get a story
     *
     * @param string $story_gid  (required) Globally unique identifier for the story.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getStory($story_gid, $params = array(), $options = array()) {
        $path = "/stories/{story_gid}";
        $path = str_replace("{story_gid}", $story_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Update a story
     *
     * @param string $story_gid  (required) Globally unique identifier for the story.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function updateStory($story_gid, $params = array(), $options = array()) {
        $path = "/stories/{story_gid}";
        $path = str_replace("{story_gid}", $story_gid, $path);
        return $this->client->put($path, $params, $options);
    }
}
