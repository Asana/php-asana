<?php

namespace Asana\Resources\Gen;

/**
 * An _attachment_ object represents any file attached to a task in Asana,
 * whether it's an uploaded file or one associated via a third-party service
 * such as Dropbox or Google Drive.
*/
class AttachmentsBase
{
    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Returns the full record for a single attachment.
     *
     * @param  attachment Globally unique identifier for the attachment.
     * @return response
     */
    public function findById($attachment, $params = array(), $options = array())
    {
        $path = sprintf("/attachments/%s", $attachment);
        return $this->client->get($path, $params, $options);
    }

    /**
     * Returns the compact records for all attachments on the task.
     *
     * @param  task Globally unique identifier for the task.
     * @return response
     */
    public function findByTask($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%s/attachments", $task);
        return $this->client->getCollection($path, $params, $options);
    }
}
