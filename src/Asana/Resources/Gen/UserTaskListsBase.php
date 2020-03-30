<?php

namespace Asana\Resources\Gen;

class UserTaskListsBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Get a user task list
     *
     * @param string $user_task_list_gid  (required) Globally unique identifier for the user task list.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getUserTaskList($user_task_list_gid, $params = array(), $options = array()) {
        $path = "/user_task_lists/{user_task_list_gid}";
        $path = str_replace("{user_task_list_gid}", $user_task_list_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Get a user's task list
     *
     * @param string $user_gid  (required) A string identifying a user. This can either be the string \"me\", an email, or the gid of a user.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getUserTaskListForUser($user_gid, $params = array(), $options = array()) {
        $path = "/users/{user_gid}/user_task_list";
        $path = str_replace("{user_gid}", $user_gid, $path);
        return $this->client->get($path, $params, $options);
    }
}
