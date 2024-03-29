<?php

namespace Asana;

use Asana\Test\AsanaTest;
use Asana\Errors\Error;
use Asana\Errors\ServerError;
use PHPUnit\Framework\Error\Warning;

class ClientTest extends Test\AsanaTest
{
    var $errors = array();

    public function testClientGet()
    {
        $this->dispatcher->registerResponse('/users/me', 200, null, '{ "data": "foo" }');

        $result = $this->client->users->getUser('me');
        $this->assertEquals($result, 'foo');
    }

    public function testNotAuthorized()
    {
        $this->expectException(Errors\NoAuthorizationError::class);

        $this->dispatcher->registerResponse('/users/me', 401, null, '{ "errors": [{ "message": "Not Authorized" }]}');

        $this->client->users->getUser('me');
    }

    public function testInvalidRequest()
    {
        $this->expectException(Errors\InvalidRequestError::class);

        $this->dispatcher->registerResponse('/tasks?limit=50', 400, null, '{ "errors": [{ "message": "Missing input" }] }');

        $this->client->tasks->getTasks(null, array('iterator_type' => false));
    }

    public function testServerError()
    {
        $this->expectException(Errors\ServerError::class);

        $res = '{ "errors": [ { "message": "Server Error", "phrase": "6 sad squid snuggle softly" } ] }';
        $this->dispatcher->registerResponse('/users/me', 500, null, $res);

        $this->client->users->getUser('me');
    }

    public function testNotFound()
    {
        $this->expectException(Errors\NotFoundError::class);

        $res = '{ "errors": [ { "message": "user: Unknown object: 1234" } ] }';
        $this->dispatcher->registerResponse('/users/1234', 404, null, $res);

        $this->client->users->getUser(1234);
    }

    public function testForbidden()
    {
        $this->expectException(Errors\ForbiddenError::class);

        $res = '{ "errors": [ { "message": "user: Forbidden" } ] }';
        $this->dispatcher->registerResponse('/users/1234', 403, null, $res);

        $this->client->users->getUser(1234);
    }

    public function testOptionPretty()
    {
        $this->dispatcher->registerResponse('/users/me?opt_pretty=true', 200, null, '{ "data": "foo" }');

        $this->assertEquals($this->client->users->getUser('me', null, array('pretty' => true)), 'foo');
    }

    public function testOptionFields()
    {
        $this->dispatcher->registerResponse('/tasks/1224?opt_fields=name%2Cnotes', 200, null, '{ "data": "foo" }');

        $result = $this->client->tasks->getTask(1224, null, array("fields" => array('name','notes')));
        $this->assertEquals($result, 'foo');
    }

    public function testOptionExpand()
    {
        $req = '{ "data": { "assignee": 1234 }, "options": { "expand" : ["projects"] } }';
        $this->dispatcher->registerResponse('/tasks/1001', 200, null, '{ "data": "foo" }');

        $result = $this->client->tasks->updateTask(1001, array('assignee' => 1234), array('expand' => array('projects')));
        $this->assertEquals($result, 'foo');
        $this->assertEquals(json_decode($this->dispatcher->calls[0]['request']->payload), json_decode($req));
    }

    public function testPagination()
    {
        $res = '{
            "data": [
                { "id": 1000, "name": "Task 1" }
            ],
            "next_page": {
                "offset": "ABCDEF",
                "path": "/tasks?project=1337&limit=5&offset=ABCDEF",
                "uri": "https://app.asana.com/api/1.0/tasks?project=1337&limit=5&offset=ABCDEF"
            }
        }';
        $this->dispatcher->registerResponse('/projects/1337/tasks?limit=5&offset=ABCDEF', 200, null, $res);

        $options = array( 'limit' => 5, 'offset' => 'ABCDEF', 'iterator_type' => false );
        $result = $this->client->tasks->getTasksForProject(1337, null, $options);
        $this->assertEquals($result, json_decode($res));
    }

    public function testItemIteratorItemLimitLessThanItems()
    {
        $res = '{
            "data": ["a", "b"],
            "next_page": { "offset": "a", "path": "/projects/1337/tasks?limit=2&offset=a" }
        }';
        $this->dispatcher->registerResponse('/projects/1337/tasks?limit=2', 200, null, $res);

        $options = array('item_limit' => 2, 'page_size' => 2, 'iterator_type' => 'items');
        $iterator = $this->client->tasks->getTasksForProject(1337, null, $options);
        $iterator->rewind();
        $this->assertEquals($iterator->valid(), true);
        $this->assertEquals($iterator->current(), 'a');
        $iterator->next();
        $this->assertEquals($iterator->valid(), true);
        $this->assertEquals($iterator->current(), 'b');
        $iterator->next();
        $this->assertEquals($iterator->valid(), false);
    }

    public function testItemIteratorItemLimitEqualItems()
    {
        $res = '{
            "data": ["a", "b"], 
            "next_page": { "offset": "a", "path": "/projects/1337/tasks?limit=2&offset=a" }
        }';
        $this->dispatcher->registerResponse('/projects/1337/tasks?limit=2', 200, null, $res);
        $res = '{ "data": ["c"], "next_page": null }';
        $this->dispatcher->registerResponse('/projects/1337/tasks?limit=1&offset=a', 200, null, $res);

        $options = array('item_limit' => 3, 'page_size' => 2, 'iterator_type' => 'items');
        $iterator = $this->client->tasks->getTasksForProject(1337, null, $options);
        $iterator->rewind();
        $this->assertEquals($iterator->valid(), true);
        $this->assertEquals($iterator->current(), 'a');
        $iterator->next();
        $this->assertEquals($iterator->valid(), true);
        $this->assertEquals($iterator->current(), 'b');
        $iterator->next();
        $this->assertEquals($iterator->valid(), true);
        $this->assertEquals($iterator->current(), 'c');
        $iterator->next();
        $this->assertEquals($iterator->valid(), false);
    }

    public function testItemIteratorItemLimitGreaterThanItems()
    {
        $res = '{
            "data": ["a", "b"],
            "next_page": { "offset": "a", "path": "/projects/1337/tasks?limit=2&offset=a" }
        }';
        $this->dispatcher->registerResponse('/projects/1337/tasks?limit=2', 200, null, $res);
        $res = '{ "data": ["c"], "next_page": null }';
        $this->dispatcher->registerResponse('/projects/1337/tasks?limit=2&offset=a', 200, null, $res);

        $options = array('item_limit' => 4, 'page_size' => 2, 'iterator_type' => 'items');
        $iterator = $this->client->tasks->getTasksForProject(1337, null, $options);
        $iterator->rewind();
        $this->assertEquals($iterator->valid(), true);
        $this->assertEquals($iterator->current(), 'a');
        $iterator->next();
        $this->assertEquals($iterator->valid(), true);
        $this->assertEquals($iterator->current(), 'b');
        $iterator->next();
        $this->assertEquals($iterator->valid(), true);
        $this->assertEquals($iterator->current(), 'c');
        $iterator->next();
        $this->assertEquals($iterator->valid(), false);
    }

    public function testItemIteratorPreserveOptFields()
    {
        $res = '{
            "data": ["a", "b"],
            "next_page": { "offset": "a", "path": "/projects/1337/tasks?limit=2&offset=a" }
        }';
        $this->dispatcher->registerResponse('/projects/1337/tasks?limit=2&opt_fields=foo', 200, null, $res);
        $res = '{ "data": ["c"], "next_page": null }';
        $this->dispatcher->registerResponse('/projects/1337/tasks?limit=1&offset=a&opt_fields=foo', 200, null, $res);

        $options = array('fields' => array('foo'), 'item_limit' => 3, 'page_size' => 2, 'iterator_type' => 'items');
        $iterator = $this->client->tasks->getTasksForProject(1337, null, $options);
        $iterator->rewind();
        $this->assertEquals($iterator->valid(), true);
        $this->assertEquals($iterator->current(), 'a');
        $iterator->next();
        $this->assertEquals($iterator->valid(), true);
        $this->assertEquals($iterator->current(), 'b');
        $iterator->next();
        $this->assertEquals($iterator->valid(), true);
        $this->assertEquals($iterator->current(), 'c');
        $iterator->next();
        $this->assertEquals($iterator->valid(), false);
    }

    public function testRateLimiting()
    {
        global $sleepCalls;
        $res = array(
            array(429, array('Retry-After' => '0.1' ), '{}'),
            array(200, null, '{ "data": "me" }')
        );
        $this->dispatcher->registerResponse(
            '/users/me',
            function () use (&$res) {
                return array_shift($res);
            }
        );

        $result = $this->client->users->getUser('me');
        $this->assertEquals($result, 'me');
        $this->assertEquals(count($this->dispatcher->calls), 2);
        $this->assertEquals($sleepCalls, array(0.1));
    }

    public function testRateLimitedTwice()
    {
        global $sleepCalls;
        $res = array(
            array(429, array('Retry-After' => '0.1' ), '{}'),
            array(429, array('Retry-After' => '0.1' ), '{}'),
            array(200, null, '{ "data": "me" }')
        );
        $this->dispatcher->registerResponse(
            '/users/me',
            function () use (&$res) {
                return array_shift($res);
            }
        );

        $result = $this->client->users->getUser('me');
        $this->assertEquals($result, 'me');
        $this->assertEquals(count($this->dispatcher->calls), 3);
        $this->assertEquals($sleepCalls, array(0.1, 0.1));
    }

    public function testServerErrorRetry()
    {
        global $sleepCalls;
        $res = array(
            array(500, null, '{}'),
            array(200, null, '{ "data": "me" }')
        );
        $this->dispatcher->registerResponse(
            '/users/me',
            function () use (&$res) {
                return array_shift($res);
            }
        );

        $result = $this->client->users->getUser('me', null, array('max_retries' => 1));
        $this->assertEquals(count($this->dispatcher->calls), 2);
        $this->assertEquals($sleepCalls, array(1.0));
    }

    public function testServerErrorRetryBackoff()
    {
        global $sleepCalls;
        $res = array(
            array(500, null, '{}'),
            array(500, null, '{}'),
            array(500, null, '{}'),
            array(200, null, '{ "data": "me" }')
        );
        $this->dispatcher->registerResponse(
            '/users/me',
            function () use (&$res) {
                return array_shift($res);
            }
        );

        $result = $this->client->users->getUser('me');
        $this->assertEquals(count($this->dispatcher->calls), 4);
        $this->assertEquals($sleepCalls, array(1.0, 2.0, 4.0));
    }

    public function testGetNamedParameters()
    {
        $res = '{ "data": "foo" }';
        $this->dispatcher->registerResponse('/tasks?limit=50&workspace=14916&assignee=me', 200, null, $res);

        $options = array('iterator_type' => false);
        $result = $this->client->tasks->getTasks(array('workspace' => 14916, 'assignee' => 'me'), $options);
        $this->assertEquals($result, json_decode('{ "data": "foo" }'));
    }

    public function testPostNamedParameters()
    {
        $req = '{
            "data": {
                "assignee": 1235,
                "followers": [5678],
                "name": "Hello, world."
            }
        }';
        $this->dispatcher->registerResponse('/tasks', 201, null, '{ "data": "foo" }');

        $result = $this->client->tasks->createTask(
            array('assignee' => 1235, 'followers' => array(5678), 'name' => "Hello, world.")
        );
        $this->assertEquals($result, 'foo');
        $this->assertEquals(json_decode($this->dispatcher->calls[0]['request']->payload), json_decode($req));
    }

    public function testPutNamedParameters()
    {
        $req = '{
            "data": {
                "assignee": 1235,
                "followers": [5678],
                "name": "Hello, world."
            }
        }';
        $this->dispatcher->registerResponse('/tasks/1001', 200, null, '{ "data": "foo" }');

        $result = $this->client->tasks->updateTask(
            1001,
            array('assignee' => 1235, 'followers' => array(5678), 'name' => "Hello, world.")
        );
        $this->assertEquals($result, 'foo');
        $this->assertEquals(json_decode($this->dispatcher->calls[0]['request']->payload), json_decode($req));
    }

    public function testAsanaChangeHeaderNone()
    {
        $this->errors = array();
        set_error_handler(array($this,'handleError'));

        $this->dispatcher->registerResponse('/tasks/1001',
            200,
            null,
            '{ "data": "foo" }');

        $this->client->tasks->updateTask(
            1001,
            array('assignee' => 1235, 'followers' => array(5678), 'name' => "Hello, world.")
        );

        $this->assertEquals(0, count($this->errors));
    }

    public function testAsanaChangeHeaderEnable()
    {
        $this->errors = array();
        set_error_handler(array($this,'handleError'));

        $this->dispatcher->registerResponse('/tasks/1001',
            200,
            array('asana-change' => 'name=string_ids;info=something;affected=true'),
            '{ "data": "foo" }');

        $this->client->tasks->updateTask(
            1001,
            array('assignee' => 1235, 'followers' => array(5678), 'name' => "Hello, world."),
            array('headers' => array('asana-enable' => 'string_ids'))
        );

        $this->assertEquals(0, count($this->errors));
    }

    public function testAsanaChangeHeaderDisable()
    {
        $this->errors = array();
        set_error_handler(array($this,'handleError'));

        $this->dispatcher->registerResponse('/tasks/1001',
            200,
            array('asana-change' => 'name=string_ids;info=something;affected=true'),
            '{ "data": "foo" }');

        $this->client->tasks->updateTask(
            1001,
            array('assignee' => 1235, 'followers' => array(5678), 'name' => "Hello, world."),
            array('headers' => array('asana-disable' => 'string_ids'))
        );

        $this->assertEquals(0, count($this->errors));
    }

    public function testAsanaChangeHeaderSingle()
    {
        $this->errors = array();
        set_error_handler(array($this,'handleError'));

        $this->dispatcher->registerResponse('/tasks/1001',
            200,
            array('asana-change' => 'name=string_ids;info=something;affected=true'),
            '{ "data": "foo" }');

        $this->client->tasks->updateTask(
            1001,
            array('assignee' => 1235, 'followers' => array(5678), 'name' => "Hello, world.")
        );

        $this->assertEquals(1, count($this->errors));
    }

    public function testAsanaChangeHeaderMultiple()
    {
        $this->errors = array();
        set_error_handler(array($this,'handleError'));

        $this->dispatcher->registerResponse('/tasks/1001',
            200,
            array('asana-change' => 'name=string_ids;info=something;affected=true,name=new_sections;info=something;affected=true'),
            '{ "data": "foo" }');

        $this->client->tasks->updateTask(
            1001,
            array('assignee' => 1235, 'followers' => array(5678), 'name' => "Hello, world.")
        );

        $this->assertEquals(2, count($this->errors));
    }

    public function handleError($n, $m, $f, $l) {
        array_push($this->errors, array($n, $m, $f, $l));
    }
}
