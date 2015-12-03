<?php

namespace Asana;

use Asana\Test\AsanaTest;

class ResourcesTest extends Test\AsanaTest
{
    private static $RESOURCES = array(
        'attachments',
        'events',
        'projects',
        'stories',
        'tags',
        'tasks',
        'teams',
        'users',
        'workspaces',
        'webhooks'
    );

    public function testResourcesExist()
    {
        foreach (ResourcesTest::$RESOURCES as $name) {
            $this->assertTrue(!!$result = $this->client->{$name});
        }
    }

    public function testAttachmentsFindById()
    {
        $this->dispatcher->registerResponse('/attachments/1', 200, null, '{ "data": "foo" }');

        $result = $this->client->attachments->findById(1);
        $this->assertEquals($result, 'foo');
    }

    public function testProjectsFindById()
    {
        $this->dispatcher->registerResponse('/projects/1', 200, null, '{ "data": "foo" }');

        $result = $this->client->projects->findById(1);
        $this->assertEquals($result, 'foo');
    }

    public function testStoriesFindById()
    {
        $this->dispatcher->registerResponse('/stories/1', 200, null, '{ "data": "foo" }');

        $result = $this->client->stories->findById(1);
        $this->assertEquals($result, 'foo');
    }

    public function testTagsFindById()
    {
        $this->dispatcher->registerResponse('/tags/1', 200, null, '{ "data": "foo" }');

        $result = $this->client->tags->findById(1);
        $this->assertEquals($result, 'foo');
    }

    public function testTasksFindById()
    {
        $this->dispatcher->registerResponse('/tasks/1', 200, null, '{ "data": "foo" }');

        $result = $this->client->tasks->findById(1);
        $this->assertEquals($result, 'foo');
    }

    public function testTeamsFindById()
    {
        $this->dispatcher->registerResponse('/teams/1', 200, null, '{ "data": "foo" }');

        $result = $this->client->teams->findById(1);
        $this->assertEquals($result, 'foo');
    }

    public function testUsersFindById()
    {
        $this->dispatcher->registerResponse('/users/1', 200, null, '{ "data": "foo" }');

        $result = $this->client->users->findById(1);
        $this->assertEquals($result, 'foo');
    }

    public function testWorkspacesFindById()
    {
        $this->dispatcher->registerResponse('/workspaces/1', 200, null, '{ "data": "foo" }');

        $result = $this->client->workspaces->findById(1);
        $this->assertEquals($result, 'foo');
    }
}
