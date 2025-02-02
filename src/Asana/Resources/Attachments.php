<?php

namespace Asana\Resources;

use Asana\Resources\Gen\AttachmentsBase;

#[\AllowDynamicProperties]
class Attachments extends AttachmentsBase
{
    public function createOnTask($task, $content, $filename, $contentType, $options = array())
    {
        $path = sprintf("/tasks/%s/attachments", $task);
        $options['files'] = array('file' => array($content, $filename, $contentType));
        return $this->client->request('POST', $path, $options);
    }

    /** Upload an attachment
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function createAttachmentForObject($content, $filename, $contentType, $options = array())
    {
        $path = "/attachments";
        $options['files'] = array('file' => array($content, $filename, $contentType));
        return $this->client->request('POST', $path, $options);
    }

    /**
     * Returns the full record for a single attachment.
     *
     * @deprecated replace with getAttachment
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
     * @deprecated replace with getAttachmentsForTask
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
