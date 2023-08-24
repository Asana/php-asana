<?php

namespace Asana\Resources;

use Asana\Resources\Gen\UserTaskListsBase;

#[\AllowDynamicProperties]
class UserTaskLists extends UserTaskListsBase
{
    /**
     * Returns the full record for the user task list for the given user
     *
     * @deprecated replace with getUserTaskListForUser
     *
     * @param  user An identifier for the user. Can be one of an email address,
     * the globally unique identifier for the user, or the keyword `me`
     * to indicate the current user making the request.
     * @return response
     */
    public function findByUser($user, $params = array(), $options = array())
    {
        $path = sprintf("/users/%s/user_task_list", $user);
        return $this->client->get($path, $params, $options);
    }

    /**
     * Returns the full record for a user task list.
     *
     * @deprecated replace with getUserTaskList
     *
     * @param  user_task_list Globally unique identifier for the user task list.
     * @return response
     */
    public function findById($userTaskList, $params = array(), $options = array())
    {
        $path = sprintf("/user_task_lists/%s", $userTaskList);
        return $this->client->get($path, $params, $options);
    }

    /**
     * Returns the compact list of tasks in a user's My Tasks list. The returned
     * tasks will be in order within each assignee status group of `Inbox`,
     * `Today`, and `Upcoming`.
     *
     * **Note:** tasks in `Later` have a different ordering in the Asana web app
     * than the other assignee status groups; this endpoint will still return
     * them in list order in `Later` (differently than they show up in Asana,
     * but the same order as in Asana's mobile apps).
     *
     * **Note:** Access control is enforced for this endpoint as with all Asana
     * API endpoints, meaning a user's private tasks will be filtered out if the
     * API-authenticated user does not have access to them.
     *
     * **Note:** Both complete and incomplete tasks are returned by default
     * unless they are filtered out (for example, setting `completed_since=now`
     * will return only incomplete tasks, which is the default view for "My
     * Tasks" in Asana.)
     *
     * @deprecated replace with Tasks.getTasksForUserTaskList
     *
     * @param  user_task_list The user task list in which to search for tasks.
     * @return response
     */
    public function tasks($userTaskList, $params = array(), $options = array())
    {
        $path = sprintf("/user_task_lists/%s/tasks", $userTaskList);
        return $this->client->getCollection($path, $params, $options);
    }
}
