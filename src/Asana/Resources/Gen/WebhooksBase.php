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

    public function createWebhook($params = array(), $options = array()) {
        /** Establish a webhook
         *
         * @param $params : 
         * @return response
         */
        $path = "/webhooks";
        return $this->client->post($path, $params, $options);
    }

    public function deleteWebhook($webhook_gid, $params = array(), $options = array()) {
        /** Delete a webhook
         *
         * @param $webhook_gid string:  (required) Globally unique identifier for the webhook.
         * @param $params : 
         * @return response
         */
        $path = "/webhooks/{webhook_gid}";
        $path = str_replace($path,"{webhook_gid}", $webhook_gid);
        return $this->client->delete($path, $params, $options);
    }

    public function getWebhook($webhook_gid, $params = array(), $options = array()) {
        /** Get a webhook
         *
         * @param $webhook_gid string:  (required) Globally unique identifier for the webhook.
         * @param $params : 
         * @return response
         */
        $path = "/webhooks/{webhook_gid}";
        $path = str_replace($path,"{webhook_gid}", $webhook_gid);
        return $this->client->get($path, $params, $options);
    }

    public function getWebhooks($params = array(), $options = array()) {
        /** Get multiple webhooks
         *
         * @param $params : 
         * @return response
         */
        $path = "/webhooks";
        return $this->client->get($path, $params, $options);
    }
}
