<?php

namespace Asana\Resources;

use Asana\Resources\Gen\WebhooksBase;

#[\AllowDynamicProperties]
class Webhooks extends WebhooksBase
{
    /**
     * Establishing a webhook is a two-part process. First, a simple HTTP POST
     * similar to any other resource creation. Since you could have multiple
     * webhooks we recommend specifying a unique local id for each target.
     *
     * Next comes the confirmation handshake. When a webhook is created, we will
     * send a test POST to the `target` with an `X-Hook-Secret` header as
     * described in the
     * [Resthooks Security documentation](http://resthooks.org/docs/security/).
     * The target must respond with a `200 OK` and a matching `X-Hook-Secret`
     * header to confirm that this webhook subscription is indeed expected.
     *
     * If you do not acknowledge the webhook's confirmation handshake it will
     * fail to setup, and you will receive an error in response to your attempt
     * to create it. This means you need to be able to receive and complete the
     * webhook *while* the POST request is in-flight.
     *
     * @deprecated replace with createWebhook
     *
     * @return response
     */
    public function create($params = array(), $options = array())
    {
        return $this->client->post("/webhooks", $params, $options);
    }

    /**
     * Returns the compact representation of all webhooks your app has
     * registered for the authenticated user in the given workspace.
     *
     * @deprecated replace with getWebhooks
     *
     * @return response
     */
    public function getAll($params = array(), $options = array())
    {
        return $this->client->getCollection("/webhooks", $params, $options);
    }

    /**
     * Returns the full record for the given webhook.
     *
     * @deprecated replace with getWebhook
     *
     * @param  webhook The webhook to get.
     * @return response
     */
    public function getById($webhook, $params = array(), $options = array())
    {
        $path = sprintf("/webhooks/%s", $webhook);
        return $this->client->get($path, $params, $options);
    }

    /**
     * This method permanently removes a webhook. Note that it may be possible
     * to receive a request that was already in flight after deleting the
     * webhook, but no further requests will be issued.
     *
     * @deprecated replace with deleteWebhook
     *
     * @param  webhook The webhook to delete.
     * @return response
     */
    public function deleteById($webhook, $params = array(), $options = array())
    {
        $path = sprintf("/webhooks/%s", $webhook);
        return $this->client->delete($path, $params, $options);
    }
}
