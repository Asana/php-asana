<?php

namespace Asana\Resources\Gen;

class AttachmentsBase {

    public $client;

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Delete an attachment
     *
     * @param string $attachment_gid  (required) Globally unique identifier for the attachment.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function deleteAttachment($attachment_gid, $params = array(), $options = array()) {
        $path = "/attachments/{attachment_gid}";
        $path = str_replace("{attachment_gid}", $attachment_gid, $path);
        return $this->client->delete($path, $params, $options);
    }

    /** Get an attachment
     *
     * @param string $attachment_gid  (required) Globally unique identifier for the attachment.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getAttachment($attachment_gid, $params = array(), $options = array()) {
        $path = "/attachments/{attachment_gid}";
        $path = str_replace("{attachment_gid}", $attachment_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Get attachments from an object
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getAttachmentsForObject($params = array(), $options = array()) {
        $path = "/attachments";
        return $this->client->getCollection($path, $params, $options);
    }
}
