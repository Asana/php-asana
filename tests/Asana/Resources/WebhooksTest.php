<?php

namespace Asana;

use Asana\Test\AsanaTest;

class WebhooksTest extends Test\AsanaTest
{
    private $data = array(
      'id' => 222,
      'resource' => array(
        'id' => 111,
        'name' => 'the resource'
      ),
      'target' => 'https://foo/123',
      'active' => true
    );

    private function verifyWebhookData($webhook)
    {
        $this->assertEquals($webhook->id, $this->data['id']);
        $this->assertEquals((array)$webhook->resource, $this->data['resource']);
        $this->assertEquals($webhook->target, $this->data['target']);
        $this->assertEquals($webhook->active, $this->data['active']);
    }

    public function testWebhooksCreate()
    {
        $this->dispatcher->registerResponse('/webhooks', 200, null, '{ "data": ' . json_encode($this->data) . ' }');

        $result = $this->client->webhooks->create(array('resource' => 111, 'target' => 'https://foo/123'));
        $this->verifyWebhookData($result);
    }

    public function testWebhooksGetAll()
    {
        $this->dispatcher->registerResponse('/webhooks?limit=50&workspace=1337', 200, null, '{ "data": [' . json_encode($this->data) . '] }');

        $result = $this->client->webhooks->getAll(array("workspace" => 1337));
        foreach ($result as $res) {
          $this->verifyWebhookData($res);
        }
    }

    public function testWebhooksGetById()
    {
        $this->dispatcher->registerResponse('/webhooks/222', 200, null, '{ "data": ' . json_encode($this->data) . ' }');

        $result = $this->client->webhooks->getById(222);
        $this->verifyWebhookData($result, $this->data);
    }

    public function testWebhooksDeleteById()
    {
        $this->dispatcher->registerResponse('/webhooks/222', 200, null, '{ "data": {} }');

        $result = $this->client->webhooks->deleteById(222);
        $this->assertEmpty((array)$result);
    }
}
