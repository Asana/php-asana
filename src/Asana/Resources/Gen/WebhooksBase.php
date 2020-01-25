<?php

namespace Asana\Resources\Gen;

class WebhooksBase {

    /**
     * @param Asana/Client client  The client instance
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /** Establish a webhook
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function createWebhook($params = array(), $options = array()) {
        $path = "/webhooks";
        return $this->client->post($path, $params, $options);
    }

    /** Delete a webhook
     *
     * @param string $webhook_gid  (required) Globally unique identifier for the webhook.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function deleteWebhook($webhook_gid, $params = array(), $options = array()) {
        $path = "/webhooks/{webhook_gid}";
        $path = str_replace("{webhook_gid}", $webhook_gid, $path);
        return $this->client->delete($path, $params, $options);
    }

    /** Get a webhook
     *
     * @param string $webhook_gid  (required) Globally unique identifier for the webhook.
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getWebhook($webhook_gid, $params = array(), $options = array()) {
        $path = "/webhooks/{webhook_gid}";
        $path = str_replace("{webhook_gid}", $webhook_gid, $path);
        return $this->client->get($path, $params, $options);
    }

    /** Get multiple webhooks
     *
     * @param array $params
     * @param array $options
     * @return response
     */
    public function getWebhooks($params = array(), $options = array()) {
        $path = "/webhooks";
        return $this->client->getCollection($path, $params, $options);
    }
}
