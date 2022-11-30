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

    public function testAttachmentsGetAttachment()
    {
        $this->dispatcher->registerResponse('/attachments/1', 200, null, '{ "data": "foo" }');

        $result = $this->client->attachments->getAttachment(1);
        $this->assertEquals($result, 'foo');
    }

    public function testCustomFieldsGetCustomField()
    {
        $this->dispatcher->registerResponse('/custom_fields/1', 200, null, '{ "data": "foo" }');

        $result = $this->client->customfields->getCustomField(1);
        $this->assertEquals($result, 'foo');
    }

    public function testProjectsGetProject()
    {
        $this->dispatcher->registerResponse('/projects/1', 200, null, '{ "data": "foo" }');

        $result = $this->client->projects->getProject(1);
        $this->assertEquals($result, 'foo');
    }

    public function testStoriesGetStory()
    {
        $this->dispatcher->registerResponse('/stories/1', 200, null, '{ "data": "foo" }');

        $result = $this->client->stories->getStory(1);
        $this->assertEquals($result, 'foo');
    }

    public function testTagsGetTag()
    {
        $this->dispatcher->registerResponse('/tags/1', 200, null, '{ "data": "foo" }');

        $result = $this->client->tags->getTag(1);
        $this->assertEquals($result, 'foo');
    }

    public function testTasksGetTask()
    {
        $this->dispatcher->registerResponse('/tasks/1', 200, null, '{ "data": "foo" }');

        $result = $this->client->tasks->getTask(1);
        $this->assertEquals($result, 'foo');
    }

    public function testTeamsGetTeam()
    {
        $this->dispatcher->registerResponse('/teams/1', 200, null, '{ "data": "foo" }');

        $result = $this->client->teams->getTeam(1);
        $this->assertEquals($result, 'foo');
    }

    public function testUsersGetUser()
    {
        $this->dispatcher->registerResponse('/users/1', 200, null, '{ "data": "foo" }');

        $result = $this->client->users->getUser(1);
        $this->assertEquals($result, 'foo');
    }

    public function testWorkspacesGetWorkspace()
    {
        $this->dispatcher->registerResponse('/workspaces/1', 200, null, '{ "data": "foo" }');

        $result = $this->client->workspaces->getWorkspace(1);
        $this->assertEquals($result, 'foo');
    }
}
