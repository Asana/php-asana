<?php

namespace Asana\Resources;

use Asana\Resources\Gen\AttachmentsBase;

class Attachments extends AttachmentsBase
{
    public function createOnTask($task, $content, $filename, $contentType, $options = array())
    {
        $path = sprintf("/tasks/%s/attachments", $task);
        $options['files'] = array('file' => array($content, $filename, $contentType));
        return $this->client->request('POST', $path, $options);
    }
}
