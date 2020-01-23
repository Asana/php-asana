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

    public function createCommentStory($task_gid, $params = array(), $options = array()) {
        /** Create a comment on a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/stories";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }

    public function deleteStory($story_gid, $params = array(), $options = array()) {
        /** Delete a story
         *
         * @param $story_gid string:  (required) Globally unique identifier for the story.
         * @param $params : 
         * @return response
         */
        $path = "/stories/{story_gid}";
        $path = str_replace($path,"{story_gid}", $story_gid);
        return $this->client->delete($path, $params, $options);
    }

    public function getStory($story_gid, $params = array(), $options = array()) {
        /** Get a story
         *
         * @param $story_gid string:  (required) Globally unique identifier for the story.
         * @param $params : 
         * @return response
         */
        $path = "/stories/{story_gid}";
        $path = str_replace($path,"{story_gid}", $story_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getTaskStories($task_gid, $params = array(), $options = array()) {
        /** Get stories from a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/stories";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->get($path, $params, $options);
    }

    public function updateStory($story_gid, $params = array(), $options = array()) {
        /** Update a story
         *
         * @param $story_gid string:  (required) Globally unique identifier for the story.
         * @param $params : 
         * @return response
         */
        $path = "/stories/{story_gid}";
        $path = str_replace($path,"{story_gid}", $story_gid);
        return $this->client->put($path, $params, $options);
    }
}
