<?php

namespace Asana\Resources\Gen;

class AttachmentsBase {

    /**
    * @param Asana/Client client  The client instance
    */
    public function __construct($client)
    {
        $this->client = $client;
    }

    public function deleteAttachment($attachment_gid, $params = array(), $options = array()) {
        /** Delete an attachment
         *
         * @param $attachment_gid string:  (required) Globally unique identifier for the attachment.
         * @param $params : 
         * @return response
         */
        $path = "/attachments/{attachment_gid}";
        $path = str_replace($path,"{attachment_gid}", $attachment_gid);
        return $this->client->delete($path, $params, $options);
    }

    public function getAttachment($attachment_gid, $params = array(), $options = array()) {
        /** Get an attachment
         *
         * @param $attachment_gid string:  (required) Globally unique identifier for the attachment.
         * @param $params : 
         * @return response
         */
        $path = "/attachments/{attachment_gid}";
        $path = str_replace($path,"{attachment_gid}", $attachment_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getAttachmentsForTask($task_gid, $params = array(), $options = array()) {
        /** Get attachments for a task
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/attachments";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->get($path, $params, $options);
    }

    public function uploadAttachmentToTask($task_gid, $params = array(), $options = array()) {
        /** Upload an attachment
         *
         * @param $task_gid string:  (required) The task to operate on.
         * @param $params : 
         * @return response
         */
        $path = "/tasks/{task_gid}/attachments";
        $path = str_replace($path,"{task_gid}", $task_gid);
        return $this->client->post($path, $params, $options);
    }
}
