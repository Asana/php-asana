<?php

namespace Asana\Resources\Gen;

class AttachmentsBase
{
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function findById($attachment, $params = array(), $options = array())
    {
        $path = sprintf("/attachments/%d", $attachment);
        return $this->client->get($path, $params, $options);
    }

    public function findByTask($task, $params = array(), $options = array())
    {
        $path = sprintf("/tasks/%d/attachments", $task);
        return $this->client->getCollection($path, $params, $options);
    }
}