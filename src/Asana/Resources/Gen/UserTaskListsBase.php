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

    public function getUserTaskList($user_task_list_gid, $params = array(), $options = array()) {
        /** Get a user task list
         *
         * @param $user_task_list_gid string:  (required) Globally unique identifier for the user task list.
         * @param $params : 
         * @return response
         */
        $path = "/user_task_list/{user_task_list_gid}";
        $path = str_replace($path,"{user_task_list_gid}", $user_task_list_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getUserTaskListTasks($user_task_list_gid, $params = array(), $options = array()) {
        /** Get tasks from a user task list
         *
         * @param $user_task_list_gid string:  (required) Globally unique identifier for the user task list.
         * @param $params : 
         * @return response
         */
        $path = "/user_task_lists/{user_task_list_gid}/tasks";
        $path = str_replace($path,"{user_task_list_gid}", $user_task_list_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getUsersTaskList($user_gid, $params = array(), $options = array()) {
        /** Get a user's task list
         *
         * @param $user_gid string:  (required) Globally unique identifier for the user.
         * @param $params : 
         * @return response
         */
        $path = "/users/{user_gid}/user_task_list";
        $path = str_replace($path,"{user_gid}", $user_gid);
        return $this->client->get($path, $params, $options);
    }
}
